<?php

namespace Arii\ATSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class RuntimesController extends Controller
{
    protected $images;
    
    public function __construct( )
    {
          $request = Request::createFromGlobals();
          $this->images = $request->getUriForPath('/../bundles/ariicore/images/wa');          
    }

    public function indexAction()
    {
        return $this->render('AriiATSBundle:Runtimes:index.html.twig');
    }

    public function grid_toolbarAction()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        return $this->render('AriiATSBundle:Runtimes:grid_toolbar.xml.twig',array(), $response );
    }

    public function grid_menuAction()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        return $this->render('AriiATSBundle:Runtimes:grid_menu.xml.twig',array(), $response );
    }

    public function gridAction($only_warning=0,$job_only=0)
    {
        $request = Request::createFromGlobals();
        if ($request->query->get( 'only_warning' ))
            $only_warning = $request->query->get( 'only_warning' );
        if ($request->query->get( 'job_warning' ))
            $only_warning = $request->query->get( 'job_warning' );

        $sql = $this->container->get('arii_core.sql');                 
        $qry = $sql->Select(array('j.JOID','j.JOB_NAME','s.STATUS', 's.LAST_START','a.AVG_RUN_TIME' ))
                .$sql->From(array('UJO_JOB j'))
                .$sql->LeftJoin('UJO_JOB_STATUS s',array('j.JOID','s.JOID'))
                .$sql->LeftJoin('UJO_AVG_JOB_RUNS a',array('j.JOID','a.JOID'))
                .$sql->Where(
                        array(  'j.IS_ACTIVE' => 1, 
                                '{job_name}' => 'j.JOB_NAME',
                                's.STATUS' => 1 ))                
                .$sql->OrderBy(array('s.LAST_START'));

        $dhtmlx = $this->container->get('arii_core.dhtmlx');
        $data = $dhtmlx->Connector('data');

        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        $list = '<?xml version="1.0" encoding="UTF-8"?>';
        $list .= "<rows>\n";
        $list .= '<head>
            <afterInit>
                <call command="clearAll"/>
            </afterInit>
        </head>';

        $res = $data->sql->query($qry);
        $autosys = $this->container->get('arii_ats.autosys');
        $date = $this->container->get('arii_core.date');
        $now = time();
        while ($j = $data->sql->get_next($res))
        {            
            $duration = $now-$j['LAST_START'];
            if ($j['AVG_RUN_TIME']>0) {
                $gap = ($duration/$j['AVG_RUN_TIME'])*100;
                if ($gap>150) {
                    $bgcolor = '#fbb4ae';                
                }
                elseif ($gap>100) {
                    $bgcolor = '#ffffcc';                
                }
                else {
                    $bgcolor = '#ccebc5';                
                }
            }
            else {
                $gap = '';
                $bgcolor = 'lightgrey';
            }
            $list .= '<row id="'.$j['JOID'].'" style="background-color: '.$bgcolor.'">';
            $list .= '<cell>'.$j['JOB_NAME'].'</cell>';            
            $list .= '<cell>'.$date->FormatTime($duration).'</cell>';               
            $list .= '<cell>'.sprintf("%3d",$gap).'</cell>';
            $list .= '</row>';
        }
        $list .= "</rows>\n";
        $response->setContent( $list );
        return $response;        
    }

}