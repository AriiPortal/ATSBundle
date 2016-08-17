<?php

namespace Arii\ATSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Yaml\Parser;

class FormController extends Controller
{
    public function indexAction()
    {
        return $this->render('AriiATSBundle:Form:index.html.twig');
    }

    public function toolbarAction()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        return $this->render('AriiATSBundle:Form:toolbar.xml.twig',array(), $response );
    }
    
    public function listAction()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        $list = '<?xml version="1.0" encoding="UTF-8"?>';
        $list .= '<rows>';
        
        $lang = $this->getRequest()->getLocale();
        $session = $this->container->get('arii_core.session');

        $basedir = $session->get('workspace').'/Autosys/Forms/'.$lang;
        if ($dh = @opendir($basedir)) {
            while (($file = readdir($dh)) !== false) {
                if (substr($file,-10) == '.json.twig') {
                    $list .= '<row id="'.$file.'"><cell>'.substr($file,0,strlen($file)-10).'</cell></row>';
                }
            }
        }
        $list .= '</rows>';

        $response->setContent( $list );
        return $response;        
    }

    public function defaultAction()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');        
        return $this->render('AriiATSBundle:Form:default.json.twig',array(),$response);
    }


    public function getAction()
    {
        $request = Request::createFromGlobals();
        $form = $request->query->get( 'form' );
        if ($form=='') {
            $form = 'default.json.twig';
        }
        
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $lang = $this->getRequest()->getLocale();        
        $basedir = $this->getBaseDir();
        $response->setContent( file_get_contents("$basedir/$form") );
        return $response;        
    }

    public function gridAction()
    {
        $db = $this->container->get('arii_core.db');
        $grid = $db->Connector('grid');
        $grid->sort("APP_NAME,GROUP_NAME,NAME");
        $grid->render_table('ATS_REQUESTS',"ID","APP_NAME,GROUP_NAME,NAME,DESCRIPTION");
    }

    public function formAction()
    {
        $db = $this->container->get('arii_core.db');
        $grid = $db->Connector('form');
        $grid->render_table('ATS_REQUESTS',"ID","ID,NAME,APP_NAME,GROUP_NAME,DESCRIPTION,COMMAND,OWNER,MACHINE,TRIGGER_DATE_TIME,TRIGGER_FILE_WATCHER,FILE_WATCHER,DAYS_OF_WEEK,RUN_CALENDAR,START_TIMES,DEPENDENCIES,NOT_RUNNING,RESOURCES,RESOURCES_VALUE,REQUESTER,INSTRUCTIONS,RESTART,SUCCESSORS,SUCCESS_CODES,MAX_RUN_TIME,CRITICITY");
    }
    
    
    
    public function saveAction()
    {
        $request = Request::createFromGlobals();
        $id = $request->get('ID');
        
        $em = $this->getDoctrine()->getManager();
        
        // on teste 
        $form =  $this->getDoctrine()->getRepository("AriiATSBundle:Requests")->find($id); 
        if (!$form)
            $form = new \Arii\ATSBundle\Entity\Requests();
        
        $form->setName($request->get('NAME'));
        $form->setRequester($request->get('REQUESTER'));
        $form->setDescription($request->get('DESCRIPTION'));
        $form->setAppName($request->get('APP_NAME'));
        $form->setGroupName($request->get('GROUP_NAME'));
        
        $command_type = $request->get('COMMAND_TYPE');
        $form->setCommandType($command_type);
        $form->setDbUpdate(0);
        if ($command_type=='I5') {
            $form->setOwner($request->get('USER_I5'));
            $form->setCommand($request->get('COMMAND_I5'));
            $form->setDbUpdate($request->get('DB_UPDATE'));
        }
        elseif ($command_type=='UNIX') {
            $form->setOwner($request->get('USER_UNIX'));
            $form->setCommand($request->get('COMMAND_UNIX'));
        }
        elseif ($command_type=='WINDOWS') {
            $form->setOwner($request->get('USER_WINDOWS'));
            $form->setCommand($request->get('COMMAND_WINDOWS'));
        }
        else {
            $form->setOwner($request->get('USER_OTHER'));
            $form->setCommand($request->get('COMMAND_OTHER'));
        }
                
        $form->setMachine($request->get('MACHINE'));

        $form->setTriggerFileWatcher($request->get('TRIGGER_FILE_WATCHER'));
        $form->setFileWatcher($request->get('FILE_WATCHER'));
        
        $form->setTriggerDateTime($request->get('TRIGGER_DATE_TIME'));        
        $form->setDaysOfWeek($request->get('DAYS_OF_WEEK'));
        $form->setRunCalendar($request->get('RUN_CALENDAR'));
        $form->setExcludeCalendar($request->get('EXCLUDE_CALENDAR'));
        $form->setStartTimes($request->get('START_TIMES'));
        
        $form->setDependencies($request->get('DEPENDENCIES'));
        $form->setNotRunning($request->get('NOT_RUNNING'));
        
        $form->setSuccessCodes($request->get('SUCCESS_CODES'));
        $form->setSuccessors($request->get('SUCCESSORS'));

        $form->setResources($request->get('RESOURCES'));
        $form->setResourcesValue($request->get('RESOURCES_VALUE'));
        
        $form->setInstructions($request->get('INSTRUCTIONS'));
        $form->setRestart($request->get('RESTART'));
        
        $form->setMaxRunTime($request->get('MAX_RUN_TIME'));
        $form->setCriticity($request->get('CRITICITY'));

        $em->persist($form);
        $em->flush();

        return new Response("success");
    }

    private function getBaseDir() {
        $lang = $this->getRequest()->getLocale();
        $session = $this->container->get('arii_core.session');
        return $session->get('workspace').'/Autosys/Forms/'.$lang;        
    }
    
}
