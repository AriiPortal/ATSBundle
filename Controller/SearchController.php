<?php

namespace Arii\ATSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    public function __construct( )
    {
    }

    public function indexAction()
    {
        return $this->render('AriiATSBundle:Search:index.html.twig');
    }

    public function gridAction()
    {
        $request = Request::createFromGlobals();
        $id = $request->get('joid');

        // Jobs
        $Fields = array( 
            '{job_name}'   => 'JOB_NAME',
            'is_currver' => 1 );

        # Jointure car la vue est incomplete
        $sql = $this->container->get('arii_core.sql');                  
        $qry = $sql->Select(array('JOB_NAME','DESCRIPTION','COMMAND'))
                .$sql->From(array('UJO_JOBST'))
                .$sql->Where($Fields);
        
        if ($request->get('NAME')!='')
            $qry .= " and (lower(JOB_NAME) like '".strtolower($request->get('NAME'))."')";
        if ($request->get('COMMAND')!='')
            $qry .= " and (lower(COMMAND) like '".strtolower($request->get('COMMAND'))."')";
        if ($request->get('DESCRIPTION')!='')
            $qry .= " and (lower(DESCRIPTION) like '".strtolower($request->get('DESCRIPTION'))."')";

        $dhtmlx = $this->container->get('arii_core.dhtmlx');
        $data = $dhtmlx->Connector('data');
        $res = $data->sql->query($qry);
        $Job=[];
        while ($line = $data->sql->get_next($res))
        {   
            array_push($Job,$line);
        }
        $render = $this->container->get('arii_core.render');     
        return $render->grid($Job,'JOB_NAME,DESCRIPTION,COMMAND');
    }

}