<?php

namespace Arii\ATSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class JobController extends Controller
{
    protected $images;
    
    public function __construct( )
    {
          $request = Request::createFromGlobals();
          $this->images = $request->getUriForPath('/../bundles/ariicore/images/wa');          
    }

    public function historyAction()
    {
        $request = Request::createFromGlobals();
        $id = $request->get('joid');
        $sql = $this->container->get('arii_core.sql');                  
        $qry = $sql->Select(array('JOID','JOB_NAME','JOB_TYPE'))
                .$sql->From(array('UJO_JOB'))
                .$sql->Where(
                        array(  'IS_ACTIVE' => 1, 
                                'JOID' => $id ));
        
        $dhtmlx = $this->container->get('arii_core.dhtmlx');
        $data = $dhtmlx->Connector('data');

        $res = $data->sql->query($qry);
        $autosys = $this->container->get('arii_ats.autosys');
        $type = $job = '';
        while ($line = $data->sql->get_next($res))
        {     
            $job = $line['JOB_NAME'];
            $type = $line['JOB_TYPE'];
        }
        if ($job=='') {
            $portal->ErrorLog("Unknown ID ($id)", 1,  __FILE__, __LINE__);
            $id = $type = $job = '?';
        }
        return $this->render('AriiATSBundle:Job:history.html.twig',array('id' => $id, 'type' => $type, 'job' => $job));
    }

    public function jilAction()
    {
        $request = Request::createFromGlobals();
        $id = $request->query->get('id');
        
        $sql = $this->container->get('arii_core.sql');                  
        $qry = $sql->Select(array('*'))
                .$sql->From(array('UJO_JOB'))
                .$sql->Where(
                        array(  'IS_ACTIVE' => 1, 
                                'JOID' => $id ));
        
        $dhtmlx = $this->container->get('arii_core.dhtmlx');
        $data = $dhtmlx->Connector('data');

        $res = $data->sql->query($qry);
        $job = $data->sql->get_next($res);
        
        $jil = "/* job $id */\n";
        foreach ($job as $k=>$v) {
            $jil .= "$k: \"$v\"\n";
        }
        $response = new Response();
        $response->headers->set('Content-Type', 'text/plain');
        $response->setContent($jil);
        return $response;
    }
    
    public function formAction()
    {
        $request = Request::createFromGlobals();
        $type = $request->get('type');

        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        return $this->render("AriiATSBundle:Forms:$type.json.twig",array(), $response );
    }

    public function history_gridAction()
    {
        $request = Request::createFromGlobals();
        $id = $request->get('id');
        
        $sql = $this->container->get('arii_core.sql');  
        $qry = $sql->Select(array('JOID','RUN_NUM','NTRY','STARTIME','ENDTIME','STATUS','OVER_NUM','EXIT_CODE','RUNTIME','EVT_NUM','STD_OUT_FILE','STD_ERR_FILE','REPLY_MESSAGE','REPLY_RESPONSE','HAS_EXTENDED_INFO','JOB_VER','RUN_MACHINE'))
                .$sql->From(array('UJO_JOB_RUNS'))
                .$sql->Where(array( 
                    'JOID' => $id ))
                .$sql->OrderBy(array('RUN_NUM desc,NTRY desc'));

        $dhtmlx = $this->container->get('arii_core.dhtmlx');
        $data = $dhtmlx->Connector('grid');
        $data->event->attach("beforeRender",array($this,"grid_render"));
        $data->render_sql($qry,'ID','RUN_NUM,NTRY,STARTIME,ENDTIME,RUNTIME,STATUS,EXIT_CODE,RUN_MACHINE,REPLY_MESSAGE,REPLY_RESPONSE,STD_OUT_FILE,STD_ERR_FILE,EVT_NUM,JOB_VER,OVER_RUN,HAS_EXTENDED_INFO');
    }

    function grid_render ($data){
        $autosys = $this->container->get('arii_ats.autosys');
        $data->set_value( 'ID', $data->get_value('RUN_NUM').'-'.$data->get_value('NTRY') );
        $data->set_value( 'STATUS',  $autosys->Status($data->get_value('STATUS')));
        list($bgcolor,$color) =  $autosys->ColorStatus($autosys->Status($data->get_value('STATUS')));
        $data->set_row_color($bgcolor);
        $data->set_row_style("color: $color;");
        
        $date = $this->container->get('arii_core.date');
        $data->set_value('STARTIME', $date->Time2Local($data->get_value('STARTIME'),'VA1',true));
        $data->set_value('ENDTIME', $date->Time2Local($data->get_value('ENDTIME'),'VA1',true));
    }

    public function history_chartAction()
    {
        $request = Request::createFromGlobals();
        $id = $request->get('id');
        
        $sql = $this->container->get('arii_core.sql');  
        $qry = $sql->Select(array('RUN_NUM','NTRY','STARTIME','ENDTIME','STATUS'))
                .$sql->From(array('UJO_JOB_RUNS'))
                .$sql->Where(array( 
                    'JOID' => $id ))
                .$sql->OrderBy(array('RUN_NUM desc','NTRY desc'));

        $dhtmlx = $this->container->get('arii_core.dhtmlx');
        $data = $dhtmlx->Connector('chart');
        $data->event->attach("beforeRender",array($this,"chart_render"));
        $data->render_sql($qry,'ID','START,DURATION,COLOR');
    }

    function chart_render ($data){
        $autosys = $this->container->get('arii_ats.autosys');
        $data->set_value( 'ID', $data->get_value('RUN_NUM').'-'.$data->get_value('NTRY') );
        list($bgcolor,$color) =  $autosys->ColorStatus($autosys->Status($data->get_value('STATUS')));
        $data->set_value( 'COLOR', $bgcolor );

        $data->set_value('START', $data->get_value('STARTIME'));
        if ($data->get_value('ENDTIME')!=0) {
            $end = $data->get_value('ENDTIME');

        }
        else {
            $end = time();
                        print "OK";
        }
        $duration = ($end - $data->get_value('STARTIME'));
        $data->set_value('DURATION',$duration );
    }

    public function xmlAction()
    {
        $request = Request::createFromGlobals();
        $id = $request->get('id');
        $jobtype = $request->get('type');
        switch($jobtype) {
            case 'I5':
                $table = 'UJO_'.$jobtype.'_JOB';
                $return = strtoupper('action,cl_library_list,cur_library,envvars,exec_name,exit_cc,job_description,job_name,job_parms,job_queue,job_ver,lda,lib,name,others,over_num,process_priority');
                break;
            case 'CMD':
                $table = 'UJO_COMMAND_JOB';
                $return = strtoupper('chk_files,command,envvars,heartbeat_interval,interactive,is_script,job_ver,joid,over_num,shell,std_err_file,std_in_file,std_out_file,ulimit,userid');
                break;
            case 'FW':
                $table = 'UJO_FILE_WATCH_JOB';
                $return = strtoupper('change_type,change_value,file_name,file_owner,file_size,job_ver,joid,over_num,poll,recursive,unc_password,unc_userid,user_group,watch_type');
                break;         
            default:
                $table = 'UJO_JOB';
                $return = strtoupper('joid,job_name,job_type,box_joid,owner,permission,n_retrys,create_stamp,external_app,has_box_success,has_override,is_active,job_qualifier,mach_name,sub_application,wf_joid,description,box_terminator,job_terminator,alert,create_userid,has_blob,has_condition,has_resource,is_currver,over_num,tag,update_userid,profile,numero,max_exit_success,send_notification,service_desk,as_applic,as_group,destination_file,has_box_failure,has_notification,has_service_desk,job_class,job_ver,over_seed,update_stamp');
        }
        
        $sql = $this->container->get('arii_core.sql');                  
        $qry = $sql->Select(array('*'))
                .$sql->From(array($table))
                .$sql->Where(array('JOID' => $id));
        
        $dhtmlx = $this->container->get('arii_core.dhtmlx');
        $data = $dhtmlx->Connector('form');
        $data->render_sql($qry,'JOID',$return);
    }

}