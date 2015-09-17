<?php

namespace Arii\ATSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class SendeventController extends Controller
{
    public function toolbarAction()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        return $this->render('AriiATSBundle:Sendevent:toolbar.xml.twig',array(), $response );
    }

    public function formAction()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        return $this->render('AriiATSBundle:Sendevent:form.json.twig',array(), $response );
    }

    public function form_toolbarAction()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        return $this->render('AriiATSBundle:Sendevent:form_toolbar.xml.twig',array(), $response );
    }

    public function sendeventAction() {
        $request = Request::createFromGlobals();
        $job = $request->request->get( 'JOB' );
        $action = $request->request->get( 'ACTION' );
        $force = $request->request->get( 'FORCE' );
        $comment = $request->request->get( 'COMMENT' );
        $response = $request->request->get( 'RESPONSE' );

/*        
        $job = $request->query->get( 'JOB' );
        $force = $request->query->get( 'FORCE' );
        $action = $request->query->get( 'ACTION' );
        $comment = $request->query->get( 'COMMENT' );
        $response = $request->query->get( 'RESPONSE' );
*/
        $now = time();
        $stamp = date("Y-m-d H:i:s",$now);
        
        $exec = $this->container->get('arii_ats.exec');
        header('Content-Type: text/html; charset=utf-8');       
        $status ='';
        $event=$action;
        if (in_array($action,array('SUCCESS','FAILURE','TERMINATED','INACTIVE'))) {
            $sendevent = 'sendevent -E CHANGE_STATUS -s '.$action.' -J '.$job;
            $event = 'CHANGE_STATUS';
            $status = $action;
            $sendevent .= ' -c "['.$stamp.'] '.$comment.'"';
        }
        elseif ($action == 'WAIT_REPLY') {
            $action = $event = 'REPLY_RESPONSE';
            $sendevent = 'sendevent -E '.$action.' -J '.$job.' -r "'.$response.'"';
        }
        else {
            if (($action=='STARTJOB') and ($force!='')) {
                $action = $event = 'FORCE_STARTJOB';
            }
            $sendevent = 'sendevent -E '.$action.' -J '.$job;
            $sendevent .= ' -c "['.$stamp.'] '.$comment.'"';
        }
        print "$sendevent<br/>";
        $res =  $exec->Exec($sendevent);
        if ($res != '') {
            $res = str_replace("\n",'<br/>',$res);
            $res = str_replace(' ','&nbsp;',$res);
            print "$sendevent<hr/>";
            print "<font color='red'>$res</font>";
            exit();
        }
        
        if ($event == 'REPLY_RESPONSE') {
            print $response;
            exit();
        }
        // On recupere l'evenement immediatement
        $dhtmlx = $this->container->get('arii_core.dhtmlx');
        $data = $dhtmlx->Connector('data');        
        $Where = array( 'JOB_NAME' => $job,
                        'EVENTTXT' => $event);
        if ($status != '') {
            $Where['STATUSTXT'] = $status;
        }
        
        $sql = $this->container->get('arii_core.sql');                  
        $qry = $sql->Select(array('distinct EOID','EVENT_TIME_GMT','QUE_STATUS'))
                .$sql->From(array('UJO_EVENTVU'))
                .$sql->Where($Where)
                ." and TEXT like '[$stamp]%'";
                
        $res = $data->sql->query($qry);
        $autosys = $this->container->get('arii_ats.autosys');
        $date = $this->container->get('arii_core.date');
        while ($line = $data->sql->get_next($res))
        {
            // Decalage
            print "<font color='green'>".date("Y-m-d H:i:s",$line['EVENT_TIME_GMT'])."</font>";
            $delay = $line['EVENT_TIME_GMT']-$now;
            if ($delay != '') {
                print "<hr/>$delay s";
            }
            exit();
        }
        
        // deja executé ?
        $sql = $this->container->get('arii_core.sql');                  
        $qry = $sql->Select(array('distinct EOID','EVENT_TIME_GMT','QUE_STATUS'))
                .$sql->From(array('UJO_EVENTVU'))
                .$sql->Where($Where)
                ." and TEXT like '[$stamp]%'";
        
        $res = $data->sql->query($qry);
        $autosys = $this->container->get('arii_ats.autosys');
        $date = $this->container->get('arii_core.date');
        while ($line = $data->sql->get_next($res))
        {
            // Decalage
            print "PROCESSED !<hr/><font color='green'>".date("Y-m-d H:i:s",$line['EVENT_TIME_GMT'])."</font>";
            $delay = $line['EVENT_TIME_GMT']-$now;
            if ($delay != '') {
                print "<hr/>$delay s";
            }
            exit();
        }
        exit();
    }

}
