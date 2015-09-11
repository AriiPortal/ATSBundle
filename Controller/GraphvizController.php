<?php

namespace Arii\ATSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GraphvizController extends Controller
{
    private $graphviz_dot;
    private $config;
    private $Color = array(
        's' => 'green', 
        'f' => 'red',
        'd' => 'blue',
        'n' => 'orange'
    );
    
    public function generateAction()
    {
        $request = Request::createFromGlobals();
        $return = 0;

        set_time_limit(120);
        $request = Request::createFromGlobals();
        $joid = $request->query->get( 'id' );
                
        // Localisation des images 
        $images = '/bundles/ariigraphviz/images/silk';
        $images_path = $this->get('kernel')->getRootDir().'/../web'.$images;
        $images_url = $this->container->get('templating.helper.assets')->getUrl($images);        
        
        $this->config = $this->container->getParameter('osjs_config');
        // $this->images = $this->container->getParameter('graphviz_images');
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
fontsize=8
splines=$splines
randkir=$rankdir
node [shape=plaintext,fontname=arial,fontsize=8]
edge [shape=plaintext,fontname=arial,fontsize=8,decorate=true,compound=true]
bgcolor=transparent
";
        
        // Jobs concernés
        $sql = $this->container->get('arii_core.sql');                  
/*        
        $qry = $sql->Select(array('j.JOID','j.BOX_JOID','j.JOB_NAME','j.JOB_TYPE','j.DESCRIPTION','j.AS_APPLIC','j.AS_GROUP',
                                    's.STATUS','s.LAST_START','s.LAST_END','s.EXIT_CODE',
                                    't.LINEAGE','t.DEPTH'))
                .$sql->From(array('UJO_JOB j'))
                .$sql->LeftJoin('UJO_JOB_STATUS s',array('j.JOID','s.JOID'))
                .$sql->LeftJoin('UJO_JOB_TREE t',array('j.JOID','t.JOID'))
                .$sql->Where(
                        array(  'j.IS_ACTIVE' => 1, 
                                '{job_name}' => 'j.JOB_NAME', 
                                '{start_timestamp}'=> 's.LAST_START'))                
                .$sql->OrderBy(array('s.STATUS_TIME desc'));
*/        
        $dhtmlx = $this->container->get('arii_core.dhtmlx');
        $data = $dhtmlx->Connector('data');
/*
        $qry = $sql->Select(array('*'))
                .$sql->From(array('UJO_JOB_TREE'))
                ." where LINEAGE like '%/$joid/%'"
                .$sql->OrderBy(array('JOID'));
        
        $res = $data->sql->query($qry);
        while ($line = $data->sql->get_next($res))
        {  
            $j = $line['JOID'];
            $Jobs{$j}=1;
            $j = $line['PARENT_JOID'];
            $Jobs{$j}=1;
        }
*/        
        // Job direct
        $qry = $sql->Select(array('JOID','BOX_JOID','JOB_NAME','DESCRIPTION','IS_ACTIVE','JOB_VER'))
                .$sql->From(array('UJO_JOB'))
                ." where (JOID=$joid or BOX_JOID=$joid) and IS_ACTIVE=1"
                .$sql->OrderBy(array('JOID'));
        
        $res = $data->sql->query($qry);
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
                $digraph .= "$joid [label=\"$name\"]\n";
                $Done{$joid}=1;
            }
        }

        // Conditions
        $qry = $sql->Select(array('JOID','COND_JOB_NAME','TYPE','JOB_VER'))
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
            if (isset($Ver[$joid]) and ($Ver[$joid] != $ver)) continue;
            
            switch (strtolower($type)) {
                case 'g':
                    break;
                case 'b':
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
            print str_replace('xlink:href="'.$images_path,'xlink:href="'.$images_url,$xml);
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

    public function configAction()
    {
        $request = Request::createFromGlobals();
        // system('C:/xampp/htdocs/Symfony/vendor/graphviz/config.cmd');
        $return = 0;
        $output = "svg";
        if ($request->query->get( 'output' ))
            $output = $request->query->get( 'output' );
        
        $gvz_cmd = $this->container->getParameter('graphviz_config_cmd');
        $config = "c:/arii/enterprises/sos-paris/spoolers";
        $cmd = $gvz_cmd.' "'.$config.'" "'.$output.'"';

   //     print $cmd; exit();
        $base =  $this->container->getParameter('graphviz_base'); 
        if ($output == 'svg') {
            exec($cmd,$out,$return);
            header('Content-type: image/svg+xml');
            foreach ($out as $o) {
                $o = str_replace('xlink:href="../../web','xlink:href="'.$base.'',$o);
                print $o;
            }
        }
        elseif ($output == 'pdf') {
            header('Content-type: application/pdf');
            system($cmd);
        }
        else {
            header('Content-type: image/'.$output);
            system($cmd);
        }
        exit();
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
