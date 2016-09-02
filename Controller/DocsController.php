<?php

namespace Arii\ATSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DocsController extends Controller
{
    public function indexAction()
    {
        return $this->render('AriiATSBundle:Docs:index.html.twig');
    }

    public function AlarmsAction()
    {
        $request = Request::createFromGlobals();
        $note = $request->get('note');
        
        $Alarms = $this->getDoctrine()->getRepository("AriiATSBundle:Alarms")->findByNote($note);   
        
        $list = '<rows>';
        foreach ($Alarms as $note) { 
            $Note = $note->getNote();
            $list .= '<row id="'.$note->getId().'">';
            $list .= '<cell>'.$Note->getJobName().'</cell>';          
            $list .= '<cell>'.$note->getStatus().'</cell><cell>'.$note->getExitCodes().'</cell>';
            $list .= '</row>';
        }
        $list .= '</rows>';
        
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        $response->setContent( $list );
        return $response;
    }        
    
    public function AllAlarmsAction()
    {
        $Alarms = $this->getDoctrine()->getRepository("AriiATSBundle:Alarms")->findAll();
        
        $list = '<rows>';
        foreach ($Alarms as $note) { 
            $Note = $note->getNote();
            $list .= '<row id="'.$note->getId().'">';
            $list .= '<cell>'.$Note->getJobName().'</cell>';          
            $list .= '<cell>'.$Note->getJobDesc().'</cell>';          
            $list .= '<cell>'.$note->getStatus().'</cell><cell>'.$note->getExitCodes().'</cell>';
            $list .= '</row>';
        }
        $list .= '</rows>';
        
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        $response->setContent( $list );
        return $response;
    }        
    
    public function allAction()
    {
        $Notes = $this->getDoctrine()->getRepository("AriiATSBundle:Notes")->findAll();   
        
        $list = '<rows>';
        foreach ($Notes as $note) { 
            $list .= '<row id="'.$note->getId().'"><cell>'.$note->getJobName().'</cell><cell>'.$note->getJobDesc().'</cell></row>';
        }
        $list .= '</rows>';
        
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        $response->setContent( $list );
        return $response;
    }        
    
    public function gridAction()
    {
        $request = Request::createFromGlobals();
        $job = $request->get('job');

        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');

//        $Notes = $this->getDoctrine()->getRepository("AriiATSBundle:Notes")->findBy(array(, 'is_template'=>true)); 
        $em = $this->getDoctrine()->getManager();
        $Notes = $em->getRepository("AriiATSBundle:Notes")->createQueryBuilder('o')
                ->where('o.is_template = 1')
                ->andWhere(':template LIKE o.job_name') 
                ->andWhere(':template<>o.job_name') 
                ->setParameter('template', $job)                  
               ->getQuery()
               ->getResult();

        $list = '<?xml version="1.0" ?>';
        $list .= '<data>';
        foreach ($Notes as $note) { 
            $list .= '<item value="'.$note->getId().'" label="'.$note->getJobName().' ('.$note->getJobDesc().')"/>';
        }
        $list .= '</data>';
        
        $response->setContent( $list );
        return $response;
    }        
}
