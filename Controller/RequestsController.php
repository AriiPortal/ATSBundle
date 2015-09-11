<?php

namespace Arii\ATSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Yaml\Parser;

class RequestsController extends Controller
{
    public function indexAction()
    {
        return $this->render('AriiATSBundle:Requests:index.html.twig');
    }
    
    public function treeAction()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        $list = '<?xml version="1.0" encoding="UTF-8"?>';
        $list .= '<tree id="0">
                    <item id="runtimes" text="Runtimes"/>
                 </tree>';

        $response->setContent( $list );
        return $response;        
    }

    // Temps d'exécution trop long
    public function summaryAction()
    {
        $lang = $this->getRequest()->getLocale();
        $basedir = '../src/Arii/ATSBundle/Resources/views/Requests/'.$lang;
        
        $yaml = new Parser();
        $value['title'] = $this->get('translator')->trans('Summary');
        $value['description'] = $this->get('translator')->trans('List of requests');
        $value['columns'] = array(
            $this->get('translator')->trans('title'),
            $this->get('translator')->trans('description') );
        
        if ($dh = @opendir($basedir)) {
            $nb=0;
            while (($file = readdir($dh)) !== false) {
                if (substr($file,-4)=='.yml') {
                    $content = file_get_contents("$basedir/$file");
                    $v = $yaml->parse($content);
                    $value['line'][$nb] = array($v['title'],$v['description']);
                    $nb++;
                }
            }
        }
        return $this->render('AriiATSBundle:Requests:bootstrap.html.twig', array('result' => $value));
    }
    
    // Temps d'exécution trop long
    public function resultAction()
    {
        $request = Request::createFromGlobals();
        if ($request->query->get( 'request' ))
            $req=$request->query->get( 'request');
        $page = '../src/Arii/ATSBundle/Resources/views/Requests/'.$req.'.yml';
        $content = file_get_contents($page);
        
        $yaml = new Parser();
        try {
            $value = $yaml->parse($content);
            
        } catch (ParseException $e) {
            $error = array( 'text' =>  "Unable to parse the YAML string: %s<br/>".$e->getMessage() );
            return $this->render('AriiATSBundle:Requests:ERROR.html.twig', array('error' => $error));
        }

        $sql = $this->container->get('arii_core.sql');
        
        $dhtmlx = $this->container->get('arii_core.dhtmlx');
        $data = $dhtmlx->Connector('data');

        $res = $data->sql->query($value['sql']['oracle']);
        $autosys = $this->container->get('arii_ats.autosys');
        $date = $this->container->get('arii_core.date');
        $nb=0;
        $value['columns'] = explode(',',$value['header']);
        while ($line = $data->sql->get_next($res))
        {
            $r = array();
            foreach ($value['columns'] as $h) {
                if (isset($line[$h])) $val = $line[$h];
                    else  $val = $h;
                array_push($r,$val);
            }
            $value['line'][$nb] = $r;
            $nb++;
        }
        return $this->render('AriiATSBundle:Requests:bootstrap.html.twig', array('result' => $value));
    }

}