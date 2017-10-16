<?php

namespace Arii\ATSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GraphController extends Controller
{
    private $sql;
    private $data;
    private $Job = [];
    private $Joid = [];
    
    private $Color = array(
        's' => 'green',
        'f' => 'red',
        'd' => 'blue',
        'n' => 'orange',
        't' => 'purple',
        'e' => 'cyan',
        'B' => 'black',
        'g' => 'yellow'
    );
    
    public function generateAction(Request $request, $output = 'svg',$level=1, 
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
        // Jobs concernés
        $sql = $this->container->get('arii_core.sql');                  
        $dhtmlx = $this->container->get('arii_core.dhtmlx');
        $data = $dhtmlx->Connector('data');
        $this->sql = $sql;
        $this->data = $data;
        
        if ($request->query->get( 'id' )!='') {
            $joid = $request->query->get( 'id' ); 
            print "($joid)";
        }
        else {
            $qry = $sql->Select(array('JOID'))
                        .$sql->From(array('UJO_JOBST'))
                        ." where JOB_NAME='".$request->query->get( 'name' )."'";
            $res = $data->sql->query($qry);
            $line = $data->sql->get_next($res);
            $joid = $line['JOID'];         
        }
        
        $Options = array();        
        if ($request->query->get( 'level' ) !='') 
            $level = $request->query->get( 'level' );
                
        $autosys = $this->container->get('arii_ats.autosys');
        $mermaid = $this->container->get('arii_core.mermaid');
        
        // on doit tout dessiner en même temps
        $digraph = $this->BuildGraph($joid,"graph LR\n",$level);
        
        // On ajoute les conditions
        $qry = $sql->Select(array('*'))
                    .$sql->From(array('UJO_JOB_COND'))
                    ." where JOID in (".implode(',',array_keys($this->Joid)).")"
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
//            if (isset($Ver[$joid]) and ($Ver[$joid] != $ver)) continue;
            switch ($line['COND_MODE']) {
                case 1:
                    if (isset($this->Joid[$joid]) and $name!='')
                        $digraph .= "$name-->".$this->Joid[$joid]."\n"; 
                    break;
                case 2:
                    break;
                default:
                    break;
            }            
        }
        $digraph .= "linkStyle stroke:#ff3,stroke-width:4px\n";
        return $mermaid->flowchart($digraph,$Options);
    }

    private function BuildGraph($id,$graph,$level=99) {
        if ($level <= 0) return $graph;
        $level--;

        $qry = $this->sql->Select(array('*'))
                .$this->sql->From(array('UJO_JOBST'))
                ." where (BOX_JOID=$id)";

        $res = $this->data->sql->query($qry);
        while ($line = $this->data->sql->get_next($res))
        {
            $name = $line['JOB_NAME'];
            $joid = $line['JOID'];
            
            // On conserve tous les jobs traités
            $this->Job[$name]=$line;
            $this->Joid[$joid]=$name;
            
            // Si c'est une boite, on appelle tous les jobs de cette boite
            if ($line['JOB_TYPE']==98) {
                $graph .= "subgraph ".$name."\n";
                $graph .= $name."\n";
                $graph .= $line['STATUS']."\n";
                switch($line['STATUS']) {
                    case 5:                        
                        $graph .= "style ".$name." fill:red,stroke:#333,stroke-width:4px\n";
                        break;
                    default:
                        $graph .= "style ".$name." fill:#f9f,stroke:#333,stroke-width:4px\n";
                }
                $graph .= $this->BuildGraph($joid,'',$level);
                $graph .= "end\n";
            }
            else {
                $graph .= $line['JOB_NAME']."\n";
                switch($line['STATUS']) {
                    case 5:                        
                        $graph .= "style ".$name." fill:#ccf,stroke:#f66,stroke-width:2px,stroke-dasharray: 5, 5\n";
                        break;
                    default:
                        $graph .= "style ".$line['JOB_NAME']." fill:#ccf,stroke:#f66,stroke-width:2px,stroke-dasharray: 5, 5\n";
                }
            }
        }
        return $graph;
    }
    
}
