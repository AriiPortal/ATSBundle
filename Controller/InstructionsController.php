<?php

namespace Arii\ATSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class InstructionsController extends Controller
{
    protected $images;
    
    public function __construct( )
    {
          $request = Request::createFromGlobals();
          $this->images = $request->getUriForPath('/../bundles/ariicore/images/wa');          
    }

    public function indexAction()
    {
        return $this->render('AriiATSBundle:Events:index.html.twig');
    }
    
    public function toolbarAction()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        return $this->render('AriiATSBundle:Events:grid_toolbar.xml.twig',array(), $response );
    }

    public function gridAction()
    {
        $sql = $this->container->get('arii_core.sql');                  
        $qry = $sql->Select(array('*'))
                .$sql->From(array('UJO_JOBBLOB'));
     //           .$sql->Where(array('JOB_NAME'=> 'SE.ZZZZ.JOB.TestBlob'));
        
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
        while ($line = $data->sql->get_next($res))
        {
            print_r($line);
            continue;
            
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
            $list .= '</row>';      
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
                .$sql->From(array('UJO_EVENTVU'))
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