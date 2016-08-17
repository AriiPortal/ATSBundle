<?php

namespace Arii\ATSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Yaml\Parser;

class DashboardController extends Controller
{
    public function indexAction()
    {
        return $this->render('AriiATSBundle:Dashboard:index.html.twig');
    }

    public function pageAction()
    {
        return $this->render('AriiATSBundle:Dashboard:page.html.twig');
    }
}
