<?php

namespace Arii\ATSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $Colors = $this->container->getParameter('color_status');
        foreach ($Colors as $k=>$v) {
            if (($p=strpos($v,"/"))>0) $Colors[$k] = substr($Colors[$k],0,$p);                    
        }
        return $this->render('AriiATSBundle:Default:index.html.twig', array("color" => $Colors));
    }
    
    public function ribbonAction()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        
        return $this->render('AriiATSBundle:Default:ribbon.json.twig',array(), $response );
    }

    public function docAction() {
        $request = Request::createFromGlobals();
        $lang = $this->getRequest()->getLocale();

        $doc = $request->get('doc');
        if ($doc != '')
            $file = "../src/Arii/ATSBundle/Docs/$lang/$doc.md";
        else 
            $file = "../src/Arii/ATSBundle/README.md";

        $content = @file_get_contents($file);
        if ($content == '') {
            print "$doc ?!";
            exit();
        }

        $doc = $this->container->get('arii_core.doc');
        $parsedown =  $doc->Parsedown($content);

        return $this->render('AriiATSBundle:Default:bootstrap.html.twig',array( 'content' => $parsedown ) );
    }
}
