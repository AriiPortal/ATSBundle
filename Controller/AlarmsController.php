<?php

namespace Arii\ATSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class AlarmsController extends Controller
{
    protected $images;
     
    public function __construct( )
    {
          $request = Request::createFromGlobals();
          $this->images = $request->getUriForPath('/../bundles/ariicore/images/wa');          
    }

    public function indexAction()
    {
        return $this->render('AriiATSBundle:Alarms:index.html.twig');
    }
    
    public function toolbarAction()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        return $this->render('AriiATSBundle:Alarms:grid_toolbar.xml.twig',array(), $response );
    }

    public function grid_menuAction()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        return $this->render('AriiATSBundle:Alarms:grid_menu.xml.twig',array(), $response );
    }

    public function gridAction($only_open=0)
    {
        $request = Request::createFromGlobals();
        if ($request->query->get( 'only_open' )!='')
            $only_open=$request->query->get( 'only_open');

        $sql = $this->container->get('arii_core.sql');
        
        $qry = $sql->Select(
                    array(  'a.EOID','a.ALARM','a.ALARM_TIME','a.JOID','a.EVT_NUM','a.STATE','a.THE_USER','a.STATE_TIME','a.EVENT_COMMENT','a.LEN','a.RESPONSE',
                            'j.JOB_NAME'))                
                .$sql->From(array('UJO_ALARM a'))
                .$sql->LeftJoin('UJO_JOB j',array('a.JOID','j.JOID'))
                  .$sql->Where(array('{start_timestamp}'=> 'a.ALARM_TIME', 'j.IS_ACTIVE' => 1))
                .$sql->OrderBy(array('a.ALARM_TIME desc'));

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
            if ($only_open and ($line['STATE']==45)) continue;
            
            $list .= '<row id="'.$line['EOID'].'"';            
            if ($line['STATE']==43) {
                $list .= ' bgColor="#fbb4ae"';
            }
            elseif ($line['STATE']==44) {
                $list .= ' bgColor="#ffffcc"';
            } 
            else {
                $list .= ' bgColor="#ccebc5"';
            }
            $list .= '>';
            $list .= '<cell>'.$date->Time2Local($line['ALARM_TIME'],'',true).'</cell>';
            $list .= '<cell>'.$autosys->Alarm($line['ALARM']).'</cell>';
            $list .= '<cell>'.$autosys->AlarmState($line['STATE']).'</cell>';
            $list .= '<cell>'.$line['JOB_NAME'].'</cell>';
            $list .= '<cell>'.$line['THE_USER'].'</cell>';
            $list .= '<cell><![CDATA['.$line['EVENT_COMMENT'].']]></cell>';
            $list .= '<cell><![CDATA['.$line['RESPONSE'].']]></cell>';
            $list .= '<cell>'.$line['EVT_NUM'].'</cell>';
            $list .= '</row>'; 
        }
        $list .= "</rows>\n";
        $response->setContent( $list );
        return $response;        
    }

   public function DetailAction()
    {
        $request = Request::createFromGlobals();
        $id = $request->get('id');
        $sql = $this->container->get('arii_core.sql');                  
        $qry = $sql->Select(array('*'))
                .$sql->From(array('UJO_PROC_EVENT'))
                .$sql->Where(array('EOID' => $id));
        
        $dhtmlx = $this->container->get('arii_core.dhtmlx');
        $data = $dhtmlx->Connector('grid');
//        $data->event->attach("beforeRender",array($this,"detail_render"));
        $data->render_sql($qry,'EOID','EVENT,STATUS,GLOBAL_VALUE');
    }

    function detail_render ($data){
        $data->set_value( 'VALUE', $data->get_value('VALUE1').' '.$data->get_value('VALUE2') );
        if ($data->get_value('IS_EDIT')=='Y')
            $data->set_row_color("#00cccc");
    }

    public function pieAction($only_warning=0) {
        $request = Request::createFromGlobals();
        if ($request->query->get( 'only_warning' ))
            $only_warning=$request->query->get( 'only_warning');

        $dhtmlx = $this->container->get('arii_core.dhtmlx');
        $data = $dhtmlx->Connector('data');
                
        // Jobs
        $sql = $this->container->get('arii_core.sql');
        $qry = $sql->Select(array('a.STATE','count(a.EOID) as NB'))
                .$sql->From(array('UJO_ALARM a'))
                .$sql->LeftJoin('UJO_JOB j',array('a.JOID','j.JOID'))
                .$sql->Where(array('{start_timestamp}'=> 'a.ALARM_TIME', 'j.IS_ACTIVE' => 1, '{job_name}'   => 'j.JOB_NAME'))
                .$sql->GroupBy(array('a.STATE'));

        $res = $data->sql->query($qry);
        $autosys = $this->container->get('arii_ats.autosys');
        $Status["OPEN"] = $Status["ACKNOWLEDGED"] = $Status["CLOSED"] = 0;
        while ($line = $data->sql->get_next($res))
        {            
            $status = $autosys->AlarmState($line['STATE']);         
            if ($only_warning and ($status == "CLOSED")) 
                $Status[$status] = 0;
            else
                $Status[$status] = $line['NB'];
        }
        $pie = '<data>';
        
        foreach ($Status as $s=>$nb) {
            list($bgcolor,$color) = $autosys->ColorStatus($s);
            $pie .= '<item id="'.$s.'"><STATUS>'.$s.'</STATUS><JOBS>'.$nb.'</JOBS><COLOR>'.$bgcolor.'</COLOR></item>';
        }
        $pie .= '</data>';
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        $response->setContent( $pie );
        return $response;
    }

}