<?php

namespace Arii\ATSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class NoteController extends Controller
{
    public function toolbarAction()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        return $this->render('AriiATSBundle:Note:toolbar.xml.twig',array(), $response );
    }

    public function saveAction()
    {
        $request = Request::createFromGlobals();
        $id = $request->get('ID');

        $note = new \Arii\ATSBundle\Entity\Notes();
        if( $id!="" ) 
            $note = $this->getDoctrine()->getRepository("AriiATSBundle:Notes")->find($id);      
        
        $note->setJobName($request->get('JOB_NAME'));
        $note->setJobType($request->get('JOB_TYPE'));
        $note->setJobNote($request->get('JOB_NOTE'));
        $note->setJobDesc($request->get('JOB_DESC'));
        $note->setIsTemplate($request->get('IS_TEMPLATE'));        
        
        $template= $this->getDoctrine()->getRepository("AriiATSBundle:Notes")->find($request->get('TEMPLATE_ID'));       
        if ($template)
            $note->setTemplate($template);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($note);
        $em->flush();
        
        return new Response("success");        
    }
    
    public function formAction()
    {
        $request = Request::createFromGlobals();
        $job = $request->get('job');

        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');

        $note = $this->getDoctrine()->getRepository("AriiATSBundle:Notes")->findOneBy(array('job_name'=>$job)); 
        $list = '<?xml version="1.0" encoding="UTF-8"?>';
        $list .= '<data>';
        if ($note) {
            $list .= '<ID>'.$note->getId().'</ID>';
            $list .= '<JOB_NAME>'.$note->getJobName().'</JOB_NAME>';
            $list .= '<JOB_DESC>'.$note->getJobDesc().'</JOB_DESC>';
            $list .= '<JOB_TYPE>'.$note->getJobType().'</JOB_TYPE>';
            $list .= '<JOB_NOTE><![CDATA['.$note->getJobNote().']]></JOB_NOTE>';
            $list .= '<IS_TEMPLATE>'.$note->getIsTemplate().'</IS_TEMPLATE>';
            $template = $note->getTemplate();
            if ($template) {                
                $list .= '<TEMPLATE_ID>'.$template->getId().'</TEMPLATE_ID>';                
                $list .= '<NOTE_TYPE>template</NOTE_TYPE>';                
            }
            else {
                $list .= '<NOTE_TYPE>note</NOTE_TYPE>';                
            }
        }
        $list .= '</data>';
        
        $response->setContent( $list );
        return $response;
    }

    public function showAction()
    {
        $request = Request::createFromGlobals();
        $job = $request->get('job');
        
        $note = $this->getDoctrine()->getRepository("AriiATSBundle:Notes")->findOneBy(array('job_name'=>$job)); 
        if (!$note)
            throw new \Exception('ATS',1);
        
        $response = new Response();
        $response->setContent( $note->getJobNote() );
        return $response;        
    }

    public function templatesAction()
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