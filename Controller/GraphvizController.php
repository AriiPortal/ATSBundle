<?php

namespace Arii\ATSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GraphvizController extends Controller
{
    private $graphviz_dot;
    private $config;
    private $images_path;
    private $Color = array(
        's' => 'green',
        'f' => 'red',
        'd' => 'blue',
        'n' => 'orange',
        't' => 'purple',
        'e' => 'cyan'
    );
    
    public function generateAction()
    {
        $request = Request::createFromGlobals();
        $return = 0;

        set_time_limit(120);
        $request = Request::createFromGlobals();
        $joid = $request->query->get( 'id' );
                
        // Localisation des images 
        $images = '/bundles/ariicore/images/wa';
        $this->images_path = str_replace('\\','/',$this->get('kernel')->getRootDir()).'/../web'.$images;
        $images_url = $this->container->get('templating.helper.assets')->getUrl($images);
        
        $this->graphviz_dot = $this->container->getParameter('graphviz_dot');

        
        $descriptorspec = array(
            0 => array("pipe", "r"),  // // stdin est un pipe où le processus va lire
            1 => array("pipe", "w"),  // stdout est un pipe où le processus va écrire
            2 => array("pipe", "w") // stderr est un fichier
         );
        $output = 'svg';
        
        $gvz_cmd = '"'.$this->graphviz_dot.'" -T '.$output;       
        $process = proc_open($gvz_cmd, $descriptorspec, $pipes);
        
        $splines = 'polyline';
        $rankdir = 'TB';
        
        $digraph = "digraph ATS {
fontname=arial
fontsize=10
splines=$splines
randkir=$rankdir
node [shape=plaintext,fontname=arial,fontsize=10]
edge [shape=plaintext,fontname=arial,fontsize=10,decorate=true,compound=true]
bgcolor=transparent
";
        $autosys = $this->container->get('arii_ats.autosys');
        
        // Jobs concernés
        $sql = $this->container->get('arii_core.sql');                  
        $dhtmlx = $this->container->get('arii_core.dhtmlx');
        $data = $dhtmlx->Connector('data');
            
        // Job direct
        $qry = $sql->Select(array('*'))
                .$sql->From(array('UJO_JOBST'))
                ." where (JOID=$joid or BOX_JOID=$joid)"
                .$sql->OrderBy(array('JOID'));

        $res = $data->sql->query($qry);
        $Infos = array();
        while ($line = $data->sql->get_next($res))
        {
            $joid = $line['JOID'];
            $Jobs[$joid] = 1;
            $Ver[$joid] = $line['JOB_VER'];
            $box  = $line['BOX_JOID'];
            if ($box!=0) {
                if (isset($Boxes[$box]))
                    $Boxes[$box] .= ",$joid";
                else 
                    $Boxes[$box] = $joid;
                $Jobs[$box] = 1;
            }
            $name = $line['JOB_NAME'];
            $Joid[$name] = $joid;
            if (!isset($Done[$joid])) {
                $status = $autosys->Status($line['STATUS']);
                list($bgcolor,$color) = $autosys->ColorStatus($status);
                $line['COLOR'] = $color;
                $line['BGCOLOR'] = $bgcolor;
                $Infos[$joid] = $line;
                $digraph .= $this->Node($line);
                $Done{$joid}=1;
            }
        }

        // Conditions
        $qry = $sql->Select(array('JOID','COND_JOB_NAME','TYPE','JOB_VER','VALUE'))
                .$sql->From(array('UJO_JOB_COND'))
                ." where JOID in (".implode(',',array_keys($Jobs)).")"
                .$sql->OrderBy(array('JOID'));
        $res = $data->sql->query($qry);
        while ($line = $data->sql->get_next($res))
        {
            $type = $line['TYPE'];
            $joid = $line['JOID'];
            $name = $line['COND_JOB_NAME'];
            $ver = $line['JOB_VER'];
            $value = $line['VALUE'];
            if (isset($Ver[$joid]) and ($Ver[$joid] != $ver)) continue;
            
            switch (strtolower($type)) {
                case 'g':
                    break;
                case 'b':
                    break;
                case 'e':
                    $color=$this->Color[$type];
                    if (isset($Joid[$name])) {
                        $digraph .= $Joid[$name]." -> ".$joid." [style=dotted;color=$color;label=$value]\n";                        
                    }
                    else {
                        $digraph .= "\"$name\" -> ".$joid." [style=dotted;color=$color;label=$value]\n";                        
                    }
                    break;
                default:
                    $color=$this->Color[$type];
                    if (isset($Joid[$name])) {
                        $digraph .= $Joid[$name]." -> ".$joid." [color=$color]\n";                        
                    }
                    else {
                        $digraph .= "\"$name\" -> ".$joid." [color=$color]\n";                        
                    }
            }
        }

        // clusters
        foreach ($Boxes as $box=>$jobs) {
            $digraph .= "subgraph cluster$box {\n";
            $digraph .= "style=filled;\n";
            $digraph .= "color=\"".$Infos[$box]['BGCOLOR']."\";\n";
            $digraph .= "fillcolor=lightgrey;\n";

            # Le noeud de la boite est dans le cluster
            $digraph .= "$box;\n";
            foreach (explode(',',$jobs) as $j) {
                $digraph .= "$j\n";
            }
            $digraph .= "}\n";
        }
        $digraph .= "}";

//        print "<pre>$digraph</pre>";
//        exit();
        if (is_resource($process)) {
            fwrite($pipes[0], $digraph );
            fclose($pipes[0]);

            $out = stream_get_contents($pipes[1]);
            fclose($pipes[1]);

            $err = stream_get_contents($pipes[2]);
            fclose($pipes[2]);

            $return_value = proc_close($process);
            if ($return_value != 0) {
                print "[exit $return_value]<br/>";
                print "$out<br/>";
                print "<font color='red'>$err</font>";
                print "<hr/>";
                print "<pre>$digraph</pre>";
                exit();
            }
        }  
        else {
            print "Ressource !";
            exit();
        }

        if ($output == 'svg') {
            
            header('Content-type: image/svg+xml');
            // integration du script svgpan
            $head = strpos($out,'<g id="graph');
            if (!$head) {                
                print $check;
                print $this->graphviz_dot;
                exit();
            }
            $xml = '<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
<svg style="width: 100%;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1">
<script xlink:href="'.$this->container->get('templating.helper.assets')->getUrl("bundles/ariigraphviz/js/SVGPan.js").'"/>
<g id="viewport"';
            $xml .= substr($out,$head+14);
            print str_replace('xlink:href="'.$this->images_path,'xlink:href="'.$images_url,$xml);
        }
        elseif ($output == 'pdf') {
            header('Content-type: application/pdf');
            print trim($out);
        }
        else {
            header('Content-type: image/'.$output);
            print trim($out);
            exit();
        }
        exit();
    }

    private function Node($Infos) {
        $joid = $Infos['JOID'];
        $label  = '<TABLE BORDER="1" CELLBORDER="0" CELLSPACING="0" COLOR="grey" BGCOLOR="'.$Infos['BGCOLOR'].'">';
        if ($Infos['JOB_TYPE']==98) {
            $label .= '<TR><TD><IMG SRC="'.$this->images_path.'/bricks.png"/></TD><TD>'.$Infos['JOB_NAME'].'</TD></TR>';
            $label .= '<TR><TD></TD><TD ALIGN="LEFT">'.$Infos['DESCRIPTION'].'</TD></TR>';
        }
        else {
            $label .= '<TR><TD><IMG SRC="'.$this->images_path.'/job.png"/></TD><TD>'.$Infos['JOB_NAME'].'</TD></TR>';
            $label .= '<TR><TD></TD><TD ALIGN="LEFT">'.$Infos['DESCRIPTION'].'</TD></TR>';
            $label .= '<TR><TD><IMG SRC="'.$this->images_path.'/shell.png"/></TD><TD><![CDATA['.$Infos['COMMAND'].']]></TD></TR>';
        }
        $label .= '</TABLE>';        
        return $joid.' [label=<'.$label.'>]'."\n";        
    }
    
    function CleanPath($path) {
        
        // bidouille en attendant la fin de l'étude
/*        if (substr($path,0,4)=='live') 
            $path = substr($path,4);
        elseif (substr($path,0,6)=='remote') 
            $path = substr($path,6);
        elseif (substr($path,0,5)=='cache') 
            $path = substr($path,5);
*/      
        $path = str_replace('/','.',$path);
        $path = str_replace('\\','.',$path);
        $path = str_replace('#','.',$path);
        
        // protection des | sur windows
        $path = str_replace('|','^|',$path);       
        
        return $path;
    }
}
