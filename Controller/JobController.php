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

    public function formAction()
    {
        $request = Request::createFromGlobals();
        $type = $request->get('type');

        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        return $this->render("AriiATSBundle:Forms:$type.json.twig",array(), $response );
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