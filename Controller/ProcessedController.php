<?php

namespace Arii\ATSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ProcessedController extends Controller
{
    protected $images;
    
    public function __construct( )
    {
          $request = Request::createFromGlobals();
          $this->images = $request->getUriForPath('/../bundles/ariicore/images/wa');          
    }

    public function indexAction()
    {
        return $this->render('AriiATSBundle:Processed:index.html.twig');
    }
    
    public function toolbarAction()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        return $this->render('AriiATSBundle:Processed:grid_toolbar.xml.twig',array(), $response );
    }
    
/*
    [EOID] => VA10043wma00
    [STAMP] => 11.08.15
    [EVT_NUM] => 12995586
    [JOID] => 4078
    [JOB_VER] => 4
    [OVER_NUM] => -1
    [JOB_NAME] => LP.DIV.BOX.Journalier
    [BOX_NAME] =>  
    [AUTOSERV] => VA1
    [EVENT] => 122
    [EVENTTXT] => CHK_RUN_WINDOW
    [STATUS] => 0
    [STATUSTXT] => 
    [ALARM] => 0
    [ALARMTXT] => 
    [EVENT_TIME_GMT] => 1439398800
    [EXIT_CODE] => 0
    [QUE_STATUS] => 0
    [QUE_STATUS_STAMP] => 11.08.15
    [RUN_NUM] => 1229671
    [NTRY] => 0
    [TEXT] => 
    [MACHINE] => 
    [GLOBAL_KEY] => 
    [GLOBAL_VALUE] => 
    [WF_JOID] => 1
 */
    public function gridAction($sens='future')
    {
        $sql = $this->container->get('arii_core.sql');                  
        $qry = $sql->Select(array('*'))
                .$sql->From(array('UJO_PROC_EVENTVU'))
                .$sql->Where(array('{start_timestamp}' => 'EVENT_TIME_GMT'))
                .$sql->OrderBy(array('QUE_STATUS_STAMP desc'));
            
        $dhtmlx = $this->container->get('arii_core.dhtmlx');
        $data = $dhtmlx->Connector('data');

        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        $list = '<?xml version="1.0" encoding="UTF-8"?>';
        $list .= "<rows>\n";
        $list .= '<head>
            <afterInit>
                <call command="clearAll"/>
            </afterInit>
        </head>';

        $res = $data->sql->query($qry);
        $autosys = $this->container->get('arii_ats.autosys');
        $date = $this->container->get('arii_core.date');
        $nb = 0;
        while ($line = $data->sql->get_next($res) and ($nb<500))
        {
            $bgcolor = $color = '';
            if ($line['STATUSTXT']!='') 
                list($bgcolor,$color) = list($bgcolor) = $autosys->ColorStatus($line['STATUSTXT']);
            
            $list .= '<row id="'.$line['EOID'].'"';
            if ($color != '')
                $list .= ' style="background-color: '.$bgcolor.'; color: '.$color.'">';
            elseif ($bgcolor != '')
                $list .= ' style="background-color: '.$bgcolor.'">';
            else
            $list .= '>';
            $list .= '<cell>'.$line['AUTOSERV'].'</cell>';             
            $list .= '<cell>'.$line['BOX_NAME'].'</cell>';             
            $list .= '<cell>'.$line['JOB_NAME'].'</cell>';
            $list .= '<cell>'.$line['EVENTTXT'].'</cell>';
            $list .= '<cell>'.$line['STATUSTXT'].'</cell>';
            $list .= '<cell>'.$line['ALARMTXT'].'</cell>';
            $list .= '<cell>'.$date->Time2Local($line['EVENT_TIME_GMT'],$line['AUTOSERV'],true).'</cell>';
            $list .= '<cell>'.$line['TEXT'].'</cell>';
            $list .= '<cell>'.$line['MACHINE'].'</cell>';
            $list .= '<cell>'.$line['EXIT_CODE'].'</cell>';
            $list .= '<cell>'.$line['RUN_NUM'].'</cell>';
            $list .= '<cell>'.$line['NTRY'].'</cell>';
            $list .= '<cell>'.$line['GLOBAL_KEY'].'</cell>';
            $list .= '<cell>'.$line['GLOBAL_VALUE'].'</cell>';
            $list .= '<cell>'.($line['QUE_STATUS']==2?1:0).'</cell>';
            $list .= '</row>';      
            $nb++;
        }
        $list .= "</rows>\n";
        $response->setContent( $list );
        return $response;        
    }

    public function pieAction() {
        $dhtmlx = $this->container->get('arii_core.dhtmlx');
        $data = $dhtmlx->Connector('data');
        // Jobs
        $Fields = array( '{job_name}'   => 'JOB_NAME' );
        
        $sql = $this->container->get('arii_core.sql');
        $qry = $sql->Select(array('EVENTTXT','STATUSTXT','count(JOID) as NB'))
                .$sql->From(array('UJO_PROC_EVENTVU'))
                .$sql->Where(array('{start_timestamp}' => 'EVENT_TIME_GMT'))
                .$sql->GroupBy(array('EVENTTXT','STATUSTXT'));

        $res = $data->sql->query($qry);
        $autosys = $this->container->get('arii_ats.autosys');
        while ($line = $data->sql->get_next($res))
        {            
            if ($line['STATUSTXT'] == '')
                $status = $autosys->Status($line['EVENTTXT']);
            else
                $status = $autosys->Status($line['STATUSTXT']);

            $Status[$status] = $line['NB'];
        }
        $pie = '<data>';
        foreach ($Status as $s=>$nb) {
            list($bgcolor) = $autosys->ColorStatus($s);
            $pie .= '<item id="'.$s.'"><STATUS>'.$s.'</STATUS><JOBS>'.$nb.'</JOBS><COLOR>'.$bgcolor.'</COLOR></item>';
        }
        $pie .= '</data>';
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        $response->setContent( $pie );
        return $response;
    }

}