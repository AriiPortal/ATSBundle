<?php

namespace Arii\ATSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ConfigController extends Controller
{
    public function indexAction()
    {
        return $this->render('AriiATSBundle:Config:index.html.twig' );
    }

    public function configAction()
    {
        $portal = $this->container->get('arii_core.portal');
        $db = $portal->getDatabase();
        
        return $this->render('AriiATSBundle:Config:config.html.twig', array('db' => $db));
    }

}
