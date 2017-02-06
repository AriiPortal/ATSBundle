<?php

namespace Arii\ATSBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class AlertsController extends Controller{

    public function indexAction()
    {
        return $this->render('AriiATSBundle:Alerts:index.html.twig');
    }

    public function toolbarAction()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        return $this->render("AriiATSBundle:Alerts:toolbar.xml.twig", array(), $response);
    }

    public function gridAction()
    {   
        $sql = $this->container->get('arii_core.sql');        
        $qry = $sql->Select(array("ID","NAME","TITLE","DESCRIPTION","SOURCE","PATTERN","ALERT","CODES"))
                .$sql->From(array("ATS_ALERTS"))
                .$sql->OrderBy(array('NAME'));
        
        $db = $this->container->get('arii_core.db');
        $data = $db->Connector('grid');
        $data->render_sql($qry,"ID","NAME,TITLE,DESCRIPTION,SOURCE,PATTERN,ALERT,CODES");
    }

    public function formAction()
    {   
        $request = Request::createFromGlobals();
        $id = $request->get('id');
        
        $sql = $this->container->get('arii_core.sql');        
        $qry = $sql->Select(array("ID","NAME","TITLE","DESCRIPTION","SOURCE","PATTERN","ALERT","CODES","MESSAGE","HELP"))
                .$sql->From(array("ARII_ALERT"))
                .$sql->Where(array("ID"=>$id));
        
        $db = $this->container->get('arii_core.db');
        $data = $db->Connector('form');
        $data->render_sql($qry,"ID","ID,NAME,TITLE,DESCRIPTION,SOURCE,PATTERN,ALERT,CODES,MESSAGE,HELP");
    }

    public function deleteAction()
    {
        $request = Request::createFromGlobals();
        $id = $request->get('ID');

        $em = $this->getDoctrine()->getManager();
       
        $alert = $this->getDoctrine()->getRepository("AriiCoreBundle:Alert")->find($id);      
        
        $em->remove($alert);
        $em->flush();
        return new Response("success");
    }
    
    public function saveAction()
    {
        $request = Request::createFromGlobals();
        $id = $request->get('ID');

        $alert = new \Arii\CoreBundle\Entity\Alerts();
        if( $id!="" )
            $alert = $this->getDoctrine()->getRepository("AriiCoreBundle:Alerts")->find($id);      
        
        $alert->setName($request->get('NAME'));
        $alert->setTitle($request->get('TITLE'));
        $alert->setDescription($request->get('DESCRIPTION'));
        $alert->setSource($request->get('SOURCE'));
        $alert->setPattern($request->get('PATTERN'));
        $alert->setAlert($request->get('ALERT'));
        $alert->setCodes($request->get('CODES'));
        $alert->setMessage($request->get('MESSAGE'));
        $alert->setHelp($request->get('HELP'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($alert);
        $em->flush();
        
        return new Response("success");
    }
    
    public function importAction()
    {
        $portal = $this->container->get('arii_core.portal');        
        $file = file_get_contents($portal->getWorkspace().'/Autosys/Import/autoclose.csv');
        $Log = explode("\r\n",$file);
        
        $header = array_shift($Log);
        $Head = explode("\t",$header);
        
        // On traite le log
        $n=0;
        foreach ($Log as $l) {
            $Infos = explode("\t",$l);
            for($i=0;$i<count($Infos);$i++) {
                $Data[$Head[$i]] = $Infos[$i];
            }

            $Alert = $this->getDoctrine()->getRepository("AriiCoreBundle:Alerts")->findBy('pattern');
            if (!$Alert) 
                $Alert = new \Arii\CoreBundle\Entity\Alerts();
        
            $Alert->setName($request->get('NAME'));
            $Alert->setTitle($request->get('TITLE'));
            $Alert->setDescription($request->get('DESCRIPTION'));
            $Alert->setSource($request->get('SOURCE'));
            $Alert->setPattern($request->get('PATTERN'));
            $Alert->setAlert($request->get('ALERT'));
            $Alert->setCodes($request->get('CODES'));
            $Alert->setMessage($request->get('MESSAGE'));
            $Alert->setHelp($request->get('HELP'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($Alert);
        }
        $em->flush();        
        return new Response("success");
    }
    
}

?>
