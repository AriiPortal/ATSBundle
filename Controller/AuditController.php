<?php

namespace Arii\ATSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class AuditController extends Controller
{
    protected $images;
    protected $Color = array(
        "insert_job" => "#00cccc",
        "delete_job" => "#ff0033",
        "command"   => "white",
        "eoid"   => "white"        
        );
    
    public function __construct( )
    {
          $request = Request::createFromGlobals();
          $this->images = $request->getUriForPath('/../bundles/ariicore/images/wa');          
    }

    public function indexAction()
    {
        return $this->render('AriiATSBundle:Audit:index.html.twig');
    }
    
    public function toolbarAction()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        return $this->render('AriiATSBundle:Audit:grid_toolbar.xml.twig',array(), $response );
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
    public function gridAction()
    {
        $sql = $this->container->get('arii_core.sql');
        
        $qry = $sql->Select(
                    array(  'm.AUDIT_INFO_NUM', 'm.SEQ_NO','m.ATTRIBUTE','m.VALUE1','m.VALUE2','m.IS_EDIT',
                            'i.ENTITY','i.TIME','i.TYPE'))
                .$sql->From(array('UJO_AUDIT_INFO i'))
                .$sql->LeftJoin('UJO_AUDIT_MSG m',array('i.AUDIT_INFO_NUM','m.AUDIT_INFO_NUM'))
                .$sql->Where(array('{start_timestamp}'=> 'i.TIME'))
                .$sql->OrderBy(array('AUDIT_INFO_NUM desc'));

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
            if (    (($line['TYPE']=='S') and ($line['SEQ_NO']<>3))
                    or (($line['TYPE']=='J') and ($line['SEQ_NO']<>1))) continue;
            
            $list .= '<row id="'.$line['AUDIT_INFO_NUM'].'"';            
            if ($line['ATTRIBUTE']=='insert_job') {
                $list .= '  bgColor="'.$this->Color['insert_job'].'"';
            }
            elseif ($line['ATTRIBUTE']=='delete_job') {
                $list .= '  bgColor="'.$this->Color['delete_job'].'"';
            } 
            $list .= '>';
            
            list($login,$machine) = explode('@',$line['ENTITY']);
            $list .= '<cell>'.$date->Time2Local($line['TIME'],'',true).'</cell>';
            $list .= '<cell>'.$line['TYPE'].'</cell>';
            $list .= '<cell>'.$line['ATTRIBUTE'].'</cell>';
            $list .= '<cell><![CDATA['.$line['VALUE1'].' '.$line['VALUE2'].']]></cell>';
            $list .= '<cell>'.$login.'</cell>';             
            $list .= '<cell>'.$machine.'</cell>';
            $list .= '<cell>'.$line['IS_EDIT'].'</cell>';
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
        $qry = $sql->Select(array('SEQ_NO','ATTRIBUTE','VALUE1','VALUE2','IS_EDIT'))
                .$sql->From(array('UJO_AUDIT_MSG'))
                .$sql->Where(array('AUDIT_INFO_NUM' => $id));
        
        $dhtmlx = $this->container->get('arii_core.dhtmlx');
        $data = $dhtmlx->Connector('grid');
        $data->event->attach("beforeRender",array($this,"detail_render"));
        $data->render_sql($qry,'SEQ_NO','SEQ_NO,ATTRIBUTE,VALUE');
    }

    function detail_render ($data){
        $data->set_value( 'VALUE', $data->get_value('VALUE1').' '.$data->get_value('VALUE2') );
        if ($data->get_value('IS_EDIT')=='Y')
            $data->set_row_color("#00cccc");
    }

    public function pieAction() {
        $dhtmlx = $this->container->get('arii_core.dhtmlx');
        $data = $dhtmlx->Connector('data');
                
        // Jobs
        $Fields = array( '{job_name}'   => 'JOB_NAME' );
        
        $sql = $this->container->get('arii_core.sql');
        $qry = $sql->Select(array('m.ATTRIBUTE','count(m.AUDIT_INFO_NUM) as NB'))
                .$sql->From(array('UJO_AUDIT_INFO i'))
                .$sql->LeftJoin('UJO_AUDIT_MSG m',array('i.AUDIT_INFO_NUM','m.AUDIT_INFO_NUM'))
                .$sql->Where(array('{start_timestamp}'=> 'i.TIME','SEQ_NO'=>1))
                .$sql->GroupBy(array('m.ATTRIBUTE'));

        $res = $data->sql->query($qry);
        $autosys = $this->container->get('arii_ats.autosys');
        while ($line = $data->sql->get_next($res))
        {            
            $status = $autosys->Status($line['ATTRIBUTE']);
            $Status[$status] = $line['NB'];
        }
        $pie = '<data>';
        
        foreach ($Status as $s=>$nb) {
            if (isset($this->Color[$s]))
                $color=$this->Color[$s];
            else 
                $color='white';
            $pie .= '<item id="'.$s.'"><STATUS>'.$s.'</STATUS><JOBS>'.$nb.'</JOBS><COLOR>'.$color.'</COLOR></item>';
        }
        $pie .= '</data>';
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        $response->setContent( $pie );
        return $response;
    }

}