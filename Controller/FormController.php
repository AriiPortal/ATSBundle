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
        
        $basedir = $this->container->getParameter('workspace').'/Autosys/Forms/'.$lang;
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
        $basedir = $this->container->getParameter('workspace').'/Autosys/Forms/'.$lang;
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
        $grid->render_table('ATS_REQUESTS',"ID","ID,NAME,DESCRIPTION,COMMAND,OWNER,MACHINE,TRIGGERS,DAYS_OF_WEEK,CALENDAR,START_TIMES,DEPENDENCIES,NOT_RUNNING,RESOURCES,RESOURCES_VALUE");
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
        $form->setDescription($request->get('DESCRIPTION'));
        $form->setAppName($request->get('APP_NAME'));
        $form->setGroupName($request->get('GROUP_NAME'));
        $form->setCommand($request->get('COMMAND'));
        $form->setOwner($request->get('OWNER'));
        $form->setMachine($request->get('MACHINE'));
        $form->setTriggers($request->get('TRIGGERS'));
        $form->setDaysOfWeek($request->get('DAYS_OF_WEEK'));
        $form->setCalendar($request->get('CALENDAR'));
        $form->setStartTimes($request->get('START_TIMES'));
        $form->setDependencies($request->get('DEPENDENCIES'));
        $form->setNotRunning($request->get('NOT_RUNNING'));
        $form->setResources($request->get('RESOURCES'));
        $form->setResourcesValue($request->get('RESOURCES_VALUE'));
        
        $em->persist($form);
        $em->flush();

        return new Response("success");
    }
    
}
