<?php

namespace Arii\ATSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class CalendarsController extends Controller
{
    protected $images;
     
    public function __construct( )
    {
          $request = Request::createFromGlobals();
          $this->images = $request->getUriForPath('/../bundles/ariicore/images/wa');          
    }

    public function timelineAction()
    {
        $session = $this->container->get('arii_core.session');
        
        // Une date peut etre passe en get
        $request = Request::createFromGlobals();
        if ($request->query->get( 'ref_date' )) {
            $ref_date   = $request->query->get( 'ref_date' );
            $session->setRefDate( $ref_date );
        } else {
            $ref_date   = $session->getRefDate();
        }
        $Timeline['ref_date'] = $ref_date;
        
        $past   = $session->getRefPast();
        $future = $session->getRefFuture();
        
        // On prend 24 fuseaux entre maintenant et le passe
        // on trouve le step en minute
        $step = ($future-$past)*2.5; // heure * 60 minutes / 24 fuseaux
        $Timeline['step'] = $step;
        $Timeline['step'] = 60;
        // on recalcule la date courante moins la plage de passé 
        $year = substr($ref_date, 0, 4);
        $month = substr($ref_date, 5, 2);
        $day = substr($ref_date, 8, 2);
        
        $start = substr($session->getPast(),11,2);
        $Timeline['start'] = (60/$step)*$start;
        $Timeline['js_date'] = $year.','.($month - 1).','.$day;
        $Timeline['start'] = 0;
        $refresh = $session->GetRefresh();
        
        // Liste des spoolers pour cette plage
        
        $dhtmlx = $this->container->get('arii_core.dhtmlx');
        $data = $dhtmlx->Connector('data');
        
        $sql = $this->container->get('arii_core.sql');
        $Fields = array (
            '{spooler}'    => 'SPOOLER_ID',
            '{start_time}' => 'START_TIME',
            '{end_time}'   => 'END_TIME' );

        $qry = $sql->Select(array('DISTINCT SPOOLER_ID')) 
                .$sql->From(array('SCHEDULER_ORDER_HISTORY'))
                .$sql->Where($Fields)
                .$sql->OrderBy(array('SPOOLER_ID'));

        return $this->render('AriiATSBundle:Calendars:timeline.html.twig', array('refresh' => $refresh, 'Timeline' => $Timeline ) );
    }
    
    public function calendarAction() {
        
        $request = Request::createFromGlobals();
        $calendar =$request->query->get( 'calendar');

        $sql = $this->container->get('arii_core.sql');
        
        $qry = $sql->Select( array(  'NAME',"TO_CHAR(DAY, 'YYYY-MM-DD HH24:MI') as DAY" ))                
                .$sql->From(array('UJO_CALENDAR'));
        if ($calendar!='' ) {
            $qry .= $sql->Where(array('NAME'=>$calendar));            
        }

        $dhtmlx = $this->container->get('arii_core.dhtmlx');
        $data = $dhtmlx->Connector('data');
        $res = $data->sql->query($qry);
        $autosys = $this->container->get('arii_ats.autosys');
        $date = $this->container->get('arii_core.date');
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        $list = '<?xml version="1.0" encoding="UTF-8"?>';
        $list .= "<data>\n";
        while ($line = $data->sql->get_next($res))
        {
            $list .= '<event>
        <text><![CDATA['.$line['NAME'].']]></text>
        <start_date>'.$line['DAY'].'</start_date>
        <end_date>'.$line['DAY'].'</end_date>
    </event>';
        }
        $list .= "</data>\n";
        $response->setContent( $list );
        return $response;        
    }

    public function listAction() {
        $sql = $this->container->get('arii_core.sql');                  
        $qry = $sql->Select(array('NAME',"max_date(DAY) as MAX_DAY",'count(DAY) as COUNT_DAY'))
                .$sql->From(array('UJO_CALENDAR'))
                .$sql->GroupBy(array('NAME'))
                .$sql->OrderBy(array('NAME'));

        $dhtmlx = $this->container->get('arii_core.dhtmlx');
        $data = $dhtmlx->Connector('grid');
        $data->event->attach("beforeRender",array($this,"calendar_render"));
        $data->render_sql($qry,'NAME','NAME,MAX_DAY,COUNT_DAY');        
    }
    
    public function calendar_render($data) {
        $max_day = $data->get_value('MAX_DAY');
        $year = substr($max_day,0,4);
        $month = substr($max_day,5,2);
        $day = substr($max_day,7,2);
        $max = mktime(0,0,0,$month,$day,$year);
        if (time()>$max) 
            $data->set_row_color("#fbb4ae");                    
        elseif (time()>$max-3600*24*90)
            $data->set_row_color("#ffffcc");        
        else 
            $data->set_row_color("#ccebc5");        
    }
    
    public function toolbarAction()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        return $this->render('AriiATSBundle:Calendars:grid_toolbar.xml.twig',array(), $response );
    }

    public function jobsAction() {
        $request = Request::createFromGlobals();
        $calendar = $request->query->get( 'calendar' );
            
        $sql = $this->container->get('arii_core.sql');                  
        $qry = $sql->Select(array('JOB_NAME','LAST_END','NEXT_START','DESCRIPTION'))
                .$sql->From(array('UJO_JOBST'));
        if ($calendar != '') {
            $qry .= $sql->Where(array('{job_name}' => 'JOB_NAME', 'RUN_CALENDAR' => $calendar));
        }  
        $qry .= $sql->OrderBy(array('JOB_NAME'));

        $dhtmlx = $this->container->get('arii_core.dhtmlx');
        $data = $dhtmlx->Connector('grid');
        $data->event->attach("beforeRender",array($this,"jobs_render"));
        $data->render_sql($qry,'JOB_NAME','JOB_NAME,LAST_END,NEXT_START,DESCRIPTION');        
    }

    public function excludejobsAction() {
        $request = Request::createFromGlobals();
        $calendar = $request->query->get( 'calendar' );
            
        $sql = $this->container->get('arii_core.sql');                  
        $qry = $sql->Select(array('JOB_NAME','LAST_END','NEXT_START','DESCRIPTION'))
                .$sql->From(array('UJO_JOBST'));
        if ($calendar != '') {
            $qry .= $sql->Where(array('{job_name}' => 'JOB_NAME', 'EXCLUDE_CALENDAR' => $calendar));
        }  
        $qry .= $sql->OrderBy(array('JOB_NAME'));

        $dhtmlx = $this->container->get('arii_core.dhtmlx');
        $data = $dhtmlx->Connector('grid');
        $data->event->attach("beforeRender",array($this,"jobs_render"));
        $data->render_sql($qry,'JOB_NAME','JOB_NAME,LAST_END,NEXT_START,DESCRIPTION');        
    }

    public function jobs_render($data) {
        $date = $this->container->get('arii_core.date');
        $data->set_value('LAST_END',$date->Time2Local($data->get_value('LAST_END'),'',true));
        $data->set_value('NEXT_START',$date->Time2Local($data->get_value('NEXT_START'),'',true));
    }

}