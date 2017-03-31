<?php

namespace Arii\ATSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GraphvizController extends Controller
{
    private $image_path;
    private $Color = array(
        's' => 'green',
        'f' => 'red',
        'd' => 'blue',
        'n' => 'orange',
        't' => 'purple',
        'e' => 'cyan',
        'B' => 'black'
    );
    
    public function generateAction($output = 'svg',$level=1, 
            $Show = array(            
            'BOX_NAME',
            'COMMAND',
            'STD_IN_FILE',
            'STD_OUT_FILE',
            'STD_ERR_FILE',
            'DAYS_OF_WEEK',
            'RUN_CALENDAR',
            'EXCLUDE_CALENDAR',
            'START_TIMES',
            'START_MINS',
            'RUN_WINDOWS',
            'LAST_START',
            'LAST_END',
            'OWNER',
            'RUN_MACHINE',
            'NEXT_START',
            'PROFILE'
        ) 
    )
    {
        $request = Request::createFromGlobals();
        $return = 0;

        $request = Request::createFromGlobals();
        $joid = $request->query->get( 'id' );

        $Options = array();
        if ($request->query->get( 'output' ) !='') 
            $Options['output'] = $request->query->get( 'output' );
        
        if ($request->query->get( 'level' ) !='') 
            $level = $request->query->get( 'level' );
        if ($request->query->get( 'fields' ) !='') 
            $Show = explode(',',$request->query->get( 'fields' ));
        
        $autosys = $this->container->get('arii_ats.autosys');
        $date = $this->container->get('arii_core.date');        
        
        // Images
        // Localisation des images 
        $root = $this->container->get('kernel')->getRootDir();
        $images = '/bundles/ariiats/images';
        $this->images_path = str_replace('\\','/',$root).'/../web'.$images;
        $images_url = $this->container->get('templating.helper.assets')->getUrl($images);        

        // Jobs concernés
        $sql = $this->container->get('arii_core.sql');                  
        $dhtmlx = $this->container->get('arii_core.dhtmlx');
        
        $data = $dhtmlx->Connector('data');
        
        $digraph = '';
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
                    $digraph .= $this->Node($line,$Show);
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
                
        $graphviz = $this->container->get('arii_core.graphviz');
        $Options = array(
            'output' => $output,
            'images' => $images
        );

        return $graphviz->dot($digraph,$Options);
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
    private function Node($Infos,$Fields=array(),$realtime=false) {
        $Icons = array(            
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
        
        $joid = $Infos['JOID'];
        if ($realtime) {
            $label  = '<TABLE BORDER="1" CELLBORDER="0" CELLSPACING="0" COLOR="grey" BGCOLOR="'.$Infos['BGCOLOR'].'">';
        }
        else {
            if ($Infos['JOB_TYPE']==98)
                $label  = '<TABLE BORDER="1" CELLBORDER="0" CELLSPACING="0" COLOR="grey" BGCOLOR="#CCCCCC">';
            else
                $label  = '<TABLE BORDER="1" CELLBORDER="0" CELLSPACING="0" COLOR="grey" BGCOLOR="#DDDDDD">';
        }
        if ($Infos['JOB_TYPE']==98) {
            $image = 'box';
        }
        else {
            $image = 'cmd';
        }
        if ($realtime) {
            $label .= '<TR><TD ROWSPAN="3"><IMG SRC="'.str_replace('/',DIRECTORY_SEPARATOR,$this->images_path).'/big/'.$image.'.png"/></TD><TD ALIGN="RIGHT">'.$Infos['STATUS_TEXT'].'</TD></TR>';
        }
        else {
            $label .= '<TR><TD ROWSPAN="3"><IMG SRC="'.str_replace('/',DIRECTORY_SEPARATOR,$this->images_path).'/big/'.$image.'.png"/></TD><TD ALIGN="RIGHT"></TD></TR>';
        }
        $label .= '<TR><TD><b>'.$Infos['JOB_NAME'].'</b></TD></TR>';
        $label .= '<TR><TD ALIGN="LEFT">'.$Infos['DESCRIPTION'].'</TD></TR>';
        // Complement
        foreach ($Fields as $k) {
            if (isset($Infos[$k]) and (trim($Infos[$k])!='')) {
                $label .= '<TR><TD>';
                if (isset($Icons[$k])) {
                    $label .= '<IMG SRC="'.str_replace('/',DIRECTORY_SEPARATOR,$this->images_path).'/'.$Icons[$k].'.png"/>';            
                }
                $label .= '</TD><TD ALIGN="LEFT">'. htmlentities($Infos[$k]).'</TD></TR>';            }
        }
        
        $label .= '</TABLE>';        
        return $joid.' [label=<'.$label.'>]'."\n";        
    }
    
    function CleanPath($path) {
        
        $path = str_replace('/','.',$path);
        $path = str_replace('\\','.',$path);
        $path = str_replace('#','.',$path);
        
        // protection des | sur windows
        $path = str_replace('|','^|',$path);       
        
        return $path;
    }
}
