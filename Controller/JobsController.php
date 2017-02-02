<?php

namespace Arii\ATSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class JobsController extends Controller
{
    protected $images;
    protected $autosys; 
    
    public function __construct( )
    {
          $request = Request::createFromGlobals();
          $this->images = $request->getUriForPath('/../bundles/ariicore/images/wa');          
    }

    public function indexAction()
    {
        return $this->render('AriiATSBundle:Jobs:index.html.twig');
    }

    public function grid_toolbarAction()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        return $this->render('AriiATSBundle:Jobs:grid_toolbar.xml.twig',array(), $response );
    }

    public function grid_menuAction()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        return $this->render('AriiATSBundle:Jobs:grid_menu.xml.twig',array(), $response );
    }

    public function statusAction($only_warning=0,$box_more=0)
    {
        $request = Request::createFromGlobals();
        if ($request->query->get( 'box' ))
            $box = $request->query->get( 'box' );      
        else 
            $box = '';
        if ($request->query->get( 'only_warning' )!='')
            $only_warning = $request->query->get( 'only_warning' );
        if ($request->query->get( 'box_more' )!='')
            $box_more = $request->query->get( 'box_more' );

        $state = $this->container->get('arii_ats.state');
        $Job = $state->Jobs($box,$only_warning,$box_more);
                
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        $list = '<?xml version="1.0" encoding="UTF-8"?>';
        $list .= "<rows>\n";
        $list .= '<head>
            <afterInit>
                <call command="clearAll"/>
            </afterInit>
        </head>';
        
        $autosys = $this->container->get('arii_ats.autosys');
        foreach($Job as $k=>$j) {
            $status = $autosys->Status($j['STATUS']);
            list($bgcolor,$color) = $autosys->ColorStatus($status);
            $list .= '<row id="'.$j['JOID'].'" style="background-color: '.$bgcolor.'; color: '.$color.'">';
            $list .= '<cell>'.$j['JOB_NAME'].'</cell>';               
            $list .= '<cell>'.$j['BOX_NAME'].'</cell>';               
            $list .= '<cell>'.$j['DESCRIPTION'].'</cell>';               
            $list .= '<cell>'.$status.'</cell>';               
            $list .= '<cell>'.$autosys->JobType($j['JOB_TYPE']).'</cell>';               

            $date = $this->container->get('arii_core.date');
            foreach (array('LAST_START','LAST_END') as $f ) {
                $list .= '<cell>'.$date->Time2Local($j[$f],'VA1',true).'</cell>';               
            }
            if ($j['LAST_END']>0)
                $list .= '<cell>'.($j['LAST_END']-$j['LAST_START']).'</cell>';               
            else
                $list .= '<cell/>';  
            
            if ($j['EXIT_CODE']!='-656')
                $list .= '<cell>'.$j['EXIT_CODE'].'</cell>';               
            else 
                $list .= '<cell/>';  
            $list .= '<cell>'.$j['AS_APPLIC'].'</cell>';               
            $list .= '<cell>'.$j['AS_GROUP'].'</cell>';               
            $list .= '</row>';
        }
        $list .= "</rows>\n";
        $response->setContent( $list );
        return $response;        
    }

    public function pieAction($only_warning=0,$box_more=0) {
        $request = Request::createFromGlobals();
        if ($request->query->get( 'box' ))
            $box = $request->query->get( 'box' );      
        else 
            $box = '';
        if ($request->query->get( 'only_warning' )!='')
            $only_warning = $request->query->get( 'only_warning' );
        if ($request->query->get( 'box_more' )!='')
            $box_more = $request->query->get( 'box_more' );

        $state = $this->container->get('arii_ats.state');
        $Job = $state->Jobs($box,$only_warning,$box_more);

        $autosys = $this->container->get('arii_ats.autosys');
        foreach ($Job as $k=>$j) {
            $status = $autosys->Status($j['STATUS']);
            if (($only_warning==1) and (($j['STATUS']==4) or ($j['STATUS']==8))) {
            }
            else {
                if (isset($Status[$status])) 
                    $Status[$status]++;
                else 
                    $Status[$status] = 1;
            }
        }
        $pie = '<data>';
        foreach (array('SUCCESS','FAILURE','TERMINATED','RUNNING','INACTIVE','ACTIVATED','WAIT_REPLY','ON_ICE','ON_HOLD','ON_NOEXEC') as $s) {
            list($bgcolor,$color) = $autosys->ColorStatus($s);
            if (isset($Status[$s])) 
                $pie .= '<item id="'.$s.'"><STATUS>'.$s.'</STATUS><JOBS>'.$Status[$s].'</JOBS><COLOR>'.$bgcolor.'</COLOR></item>';
        }
        $pie .= '</data>';
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        $response->setContent( $pie );
        return $response;
    }

    public function treeAction() {
        $request = Request::createFromGlobals();
        if ($request->query->get( 'only_warning' ))
            $only_warning = $request->query->get( 'only_warning' );
        
        $sql = $this->container->get('arii_core.sql');                  
        $qry = $sql->Select(array('JOID','BOX_JOID','JOB_NAME','DESCRIPTION','STATUS'))
                .$sql->From(array('UJO_JOBST'))
                .$sql->Where(array( 
                    'JOB_TYPE' => 98, 
                    '{job_name}'   => 'JOB_NAME'));
        if ($only_warning)
                $qry .= " and STATUS<>4";
        $qry .= $sql->OrderBy(array('JOB_NAME'));

        $dhtmlx = $this->container->get('arii_core.dhtmlx');
        $data = $dhtmlx->Connector('tree');
        $this->autosys = $this->container->get('arii_ats.autosys');
        $data->event->attach("beforeRender",array($this,"tree_render"));        
        $data->render_sql($qry,'JOID','JOB_NAME','','BOX_JOID');
    }

    public function tree_render($data) {
        list($bgcolor,$color) = $this->autosys->ColorStatus($this->autosys->Status($data->get_value("STATUS")));
        $data->set_value("JOB_NAME","<font color='".$bgcolor."'>".$data->get_value("JOB_NAME")."</font>");
    }
    
    public function barchartAction($tag='application',$only_warning=0) {
        $dhtmlx = $this->container->get('arii_core.dhtmlx');
        $data = $dhtmlx->Connector('data');

        $request = Request::createFromGlobals();
        if ($request->query->get( 'tag' )) 
            $tag = $request->query->get( 'tag' );
        if ($request->query->get( 'only_warning' ))
            $only_warning = $request->query->get( 'only_warning' );

        $Fields = array( '{job_name}'   => 'JOB_NAME' );
        $sql = $this->container->get('arii_core.sql');
        if ($tag=='GROUP')
            $field = 'AS_GROUP';
        else
            $field = 'AS_APPLIC';
        
        $qry = $sql->Select(array('j.'.$field.' as DOMAIN','s.STATUS','count(j.JOID) as NB'))
                .$sql->From(array('UJO_JOB j'))
                .$sql->LeftJoin('UJO_JOB_STATUS s',array('j.JOID','s.JOID'))
                .$sql->Where(array(
                    '{job_name}' => 'j.JOB_NAME', 
                    '{start_timestamp}'=> 's.LAST_START',
                    'j.IS_ACTIVE'=>1 ))                
                .$sql->GroupBy(array('j.'.$field,'s.STATUS'));

        $res = $data->sql->query($qry);
        $autosys = $this->container->get('arii_ats.autosys');
        while ($line = $data->sql->get_next($res))
        {
            $domain = $line['DOMAIN'];
            if ($domain == '') continue;
            
            if ($domain == '')
                $domain = "UNKNOWN";
            $id = $domain.'/'.$autosys->Status($line['STATUS']);
            $Domain[$domain] = 1;
            if(($only_warning==1) and ($line['STATUS']==4)) {
                $Status[$id] = 0;            
            }
            else {
                $Status[$id] = $line['NB'];            
            }
        }
        $bar = '<data>';
        if (!empty($Domain)) {
            ksort($Domain);
            foreach (array_keys($Domain) as $dom) {
                $bar .= '<item id="'.$dom.'"><domain>'.$dom.'</domain>';
                foreach (array('SUCCESS','FAILURE','TERMINATED','RUNNING','INACTIVE','ACTIVATED','JOB_ON_ICE','JOB_ON_HOLD') as $s) {
                    if (isset($Status["$dom/$s"]))
                        $bar .= "<$s>".$Status["$dom/$s"]."</$s>";
                    else 
                        $bar .= "<$s>0</$s>";
                }
                $bar .= '</item>';
            }
        }
        $bar .= '</data>';
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        $response->setContent( $bar );
        return $response;
    }

}