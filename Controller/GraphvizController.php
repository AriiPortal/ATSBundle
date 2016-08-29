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
        'e' => 'cyan',
        'B' => 'black'
    );
    
    public function generateAction($output = 'svg',$level=1)
    {
        $request = Request::createFromGlobals();
        $return = 0;

        set_time_limit(120);
        $request = Request::createFromGlobals();
        $joid = $request->query->get( 'id' );

        if ($request->query->get( 'output' ) !='') 
            $output = $request->query->get( 'output' );
        if ($request->query->get( 'level' ) !='') 
            $level = $request->query->get( 'level' );
        
        // Localisation des images 
        $images = '/bundles/ariicore/images/wa';
        $this->images_path = str_replace('\\','/',$this->get('kernel')->getRootDir()).'/../web'.$images;
        $images_url = $this->container->get('templating.helper.assets')->getUrl($images);
        
        $session = $this->container->get('arii_core.session');
        $this->graphviz_dot = $session->get('graphviz_dot');
        
        $descriptorspec = array(
            0 => array("pipe", "r"),  // // stdin est un pipe où le processus va lire
            1 => array("pipe", "w"),  // stdout est un pipe où le processus va écrire
            2 => array("pipe", "w") // stderr est un fichier
         );

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
bgcolor=white
";
        $autosys = $this->container->get('arii_ats.autosys');
        $date = $this->container->get('arii_core.date');        
        
        // Jobs concernés
        $sql = $this->container->get('arii_core.sql');                  
        $dhtmlx = $this->container->get('arii_core.dhtmlx');
        $data = $dhtmlx->Connector('data');

        $Ids = array($joid);
        $Infos = $Boxes = $Jobs = array();
        while ($level>0) {
            // Job direct
            $qry = $sql->Select(array('*'))
                    .$sql->From(array('UJO_JOBST'))
                    ." where (JOID in (".implode(',',$Ids).") or BOX_JOID in (".implode(',',$Ids).")) "
                    .$sql->OrderBy(array('JOID'));

            $res = $data->sql->query($qry);
            $Ids = array();
            while ($line = $data->sql->get_next($res))
            {
                $joid = $line['JOID'];
                $Jobs[$joid] = 1;
                $Ver[$joid] = $line['JOB_VER'];
                $box  = $line['BOX_JOID'];
                // print "(($box -> $joid))";

                if ($box!=0) {
                    if (!isset($Boxes[$box][$joid]))
                        $Boxes[$box][$joid]=$line['JOB_TYPE'];
                    
                    $Jobs[$box] = 1;
                }
                $name = $line['JOB_NAME'];
                $Joid[$name] = $joid;
                if (!isset($Done[$joid])) {
                    $status = $autosys->Status($line['STATUS']);
                    $line['STATUS_TEXT'] = $status;
                    list($bgcolor,$color) = $autosys->ColorStatus($status);
                    $line['COLOR'] = $color;
                    $line['BGCOLOR'] = $bgcolor;
                    
                    // Heures 
                    foreach (array('LAST_START','LAST_END','NEXT_START') as $t ) {
                        $line[$t] = $date->Time2Local($line[$t]);
                    }
                    $Infos[$joid] = $line;
                    $digraph .= $this->Node($line);
                    $Done{$joid}=1;
                    
                    array_push($Ids,$joid);
                }
            }
            $level--;
        }

        // clusters
        foreach ($Boxes as $box=>$jobs) {
            $digraph .= $this->Boxes($box,$Boxes,$Infos);
        }

        if (!empty($Jobs)) {
            // Conditions
            $qry = $sql->Select(array('*'))
                    .$sql->From(array('UJO_JOB_COND'))
                    ." where JOID in (".implode(',',array_keys($Jobs)).")"
                    .$sql->OrderBy(array('JOID'));
            $res = $data->sql->query($qry);
            while ($line = $data->sql->get_next($res))
            {
                $type  = $line['TYPE'];
                $joid  = $line['JOID'];
                $name  = $line['COND_JOB_NAME'];
                $ver   = $line['JOB_VER'];
                $value = $line['VALUE'];
                $lookback = $line['LOOKBACK_SECS'];
                
                switch ($line['COND_MODE']) {
                    case 1:
                        $style = '';
                        break;
                    case 2:
                        $style = 'style=dashed;';
                        break;
                    default:
                        $style = 'style=dotted;';
                        break;
                }
                $operator   = $line['OPERATOR'];
                
                if (isset($Ver[$joid]) and ($Ver[$joid] != $ver)) continue;

                switch (strtolower($type)) {
                    case 'g':
                        $color=$this->Color[$type];
                        if (isset($Joid[$name])) {
                            $digraph .= $Joid[$name]." -> ".$joid." [$style"."label=$value]\n";                        
                        }
                        else {
                            $digraph .= "\"$name\" -> ".$joid." [$style"."label=$value]\n";                        
                        }
                        break;
                    case 'b':
                        break;
                    case 'e':
                        $color=$this->Color[$type];
                        if (isset($Joid[$name])) {
                            $digraph .= $Joid[$name]." -> ".$joid." [$style"."color=$color;label=$value]\n";                        
                        }
                        else {
                            $digraph .= "\"$name\" -> ".$joid." [$style"."color=$color;label=$value]\n";                        
                        }
                        break;
                    default:
                        $color=$this->Color[$type];
                        if (isset($Joid[$name])) {
                            $digraph .= $Joid[$name]." -> ".$joid." [$style"."color=$color]\n";                        
                        }
                        else {
                            $digraph .= "\"$name\" -> ".$joid." [$style"."color=$color]\n";                        
                        }
                }
            }
        }
        $digraph .= "}";

//        print "<pre>$digraph</pre>";
//        exit();
        
        if ($output == 'dot') {
            header('Content-type: text/plain');
            print trim($digraph);
            exit();
        }
        
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

    private function Boxes($box,&$Boxes,$Infos) {
        // deja fait ?
        $cluster = '';
        // boite mais sans information dedans
        if (!isset($Boxes[$box])) {
            $Boxes[$box] = 0;
            return $cluster;
        }
        if ($Boxes[$box]==0) return $cluster;
        
        $cluster .= "subgraph cluster$box {\n";
        $cluster .= "style=filled;\n";
        if (isset($Infos[$box]['BGCOLOR']))
            $cluster .= "color=\"".$Infos[$box]['BGCOLOR']."\";\n";
        $cluster .= "fillcolor=\"#EEEEEE\";\n";

        # Le noeud de la boite est dans le cluster
        $cluster .= "$box;\n";
        foreach ($Boxes[$box] as $j=>$t) {
            // c'est une boite ?
            if ($t==98) {
                $cluster .= $this->Boxes($j,$Boxes,$Infos);
                // Boites traité
                $Boxes[$j] = 0;
            }
            else
                $cluster .= "$j\n";
            // on relie la boite et le job (purement esthétique)
            $cluster .= "$box -> $j [style=invisible,arrowhead=none]\n";
        }

        $cluster .= "}\n";           
        return $cluster;
    }
    private function Node($Infos) {
        $joid = $Infos['JOID'];
        $label  = '<TABLE BORDER="1" CELLBORDER="0" CELLSPACING="0" COLOR="grey" BGCOLOR="'.$Infos['BGCOLOR'].'">';
        if ($Infos['JOB_TYPE']==98) {
            $image = 'box';
        }
        else {
            $image = 'cmd';
        }
        $label .= '<TR><TD ROWSPAN="3"><IMG SRC="'.$this->images_path.'/big/'.$image.'.png"/></TD><TD ALIGN="RIGHT">'.$Infos['STATUS_TEXT'].'</TD></TR>';
        $label .= '<TR><TD><b>'.$Infos['JOB_NAME'].'</b></TD></TR>';
        $label .= '<TR><TD ALIGN="LEFT">'.$Infos['DESCRIPTION'].'</TD></TR>';
        $Def = array(            
            'BOX_NAME'      => 'box',
            'COMMAND'       => 'shell',
            'STD_IN_FILE'   => 'file',
            'STD_OUT_FILE'   => 'file',
            'STD_ERR_FILE'   => 'file',
            'DAYS_OF_WEEK'  => 'date',
            'RUN_CALENDAR'  => 'calendar',
            'EXCLUDE_CALENDAR'  => 'calendar_delete',
            'START_TIMES'   => 'time',
            'START_MINS'    => 'time',
            'RUN_WINDOWS'   => 'run_window',
            'LAST_START'    => 'start',
            'LAST_END'      => 'end',
            'OWNER'         => 'user',
            'RUN_MACHINE'   => 'server',
            'NEXT_START'    => 'next',
            'PROFILE'       => 'profile',
        );
        // Complement
        foreach ($Def as $k=>$v) {
            if (isset($Infos[$k]) and (trim($Infos[$k])!=''))
                $label .= '<TR><TD><IMG SRC="'.$this->images_path.'/'.$v.'.png"/></TD><TD ALIGN="LEFT">'. htmlentities($Infos[$k]).'</TD></TR>';            
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
