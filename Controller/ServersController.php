<?php

namespace Arii\ATSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ServersController extends Controller
{
    protected $images;
    
    public function __construct( )
    {
          $request = Request::createFromGlobals();
          $this->images = $request->getUriForPath('/../bundles/ariicore/images/wa');          
    }

    public function indexAction()
    {
        return $this->render('AriiATSBundle:Servers:index.html.twig');
    }
    
    public function toolbarAction()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        return $this->render('AriiATSBundle:Servers:grid_toolbar.xml.twig',array(), $response );
    }
    
    public function gridAction()
    {
        $sql = $this->container->get('arii_core.sql');                  
        $qry = $sql->Select(array('*'))
                .$sql->From(array('UJO_HA_PROCESS'))
                .$sql->OrderBy(array('HA_DESIGNATOR_ID'));

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
        while ($line = $data->sql->get_next($res))
        {
            $bgcolor = $color = '';
            $list .= '<row';
            $list .= '>';
                
            $list .= '<cell>'.$date->Time2Local($line['TIME_STAMP'],'VA1',true).'</cell>';             
            switch($line['HA_DESIGNATOR_ID'])  {
                case 1:
                    $list .= '<cell>PRIMARY</cell>';
                    break;
                case 2:
                    $list .= '<cell>SHADOW</cell>';
                    break;
                case 3:
                    $list .= '<cell>TIE BREAKER</cell>';
                    break;
            }
            $list .= '<cell>'.$line['HOSTNAME'].'</cell>';
            $list .= '<cell>'.$line['HA_STATUS_ID'].'</cell>';
            $list .= '<cell>'.$line['PID'].'</cell>';             
            $list .= '<cell>'.$line['PORT'].'</cell>';
            $list .= '<cell>'.$line['QUEUE_ID'].'</cell>';
            $list .= '</row>';      
        }
        $list .= "</rows>\n";
        $response->setContent( $list );
        return $response;        
    }

    public function grid2Action()
    {
        $sql = $this->container->get('arii_core.sql');                  
        $qry = $sql->Select(array('*'))
                .$sql->From(array('UJO_MA_PROCESS'))
                .$sql->OrderBy(array('MA_DESIGNATOR_ID'));

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
        while ($line = $data->sql->get_next($res))
        {
            $bgcolor = $color = '';
            $list .= '<row';
            $list .= '>';
                
            $list .= '<cell>'.$date->Time2Local($line['TIME_STAMP'],'VA1',true).'</cell>';             
            $list .= '<cell>'.$line['HOSTNAME'].'</cell>';
            $list .= '<cell>'.$line['MA_STATUS_ID'].'</cell>';
            $list .= '<cell>'.$line['PID'].'</cell>';             
            $list .= '<cell>'.$line['PORT'].'</cell>';
            $list .= '<cell>'.$line['QUEUE_ID'].'</cell>';
            $list .= '<cell>'.$line['COMM_ALIAS'].'</cell>';
            $list .= '<cell>'.$line['MGR_ALIAS'].'</cell>';
            $list .= '</row>';      
        }
        $list .= "</rows>\n";
        $response->setContent( $list );
        return $response;        
    }

    public function grid3Action()
    {
        $sql = $this->container->get('arii_core.sql');                  
        $qry = $sql->Select(array('*'))
                .$sql->From(array('UJO_MACHINE'))
                .$sql->OrderBy(array('MACH_NAME'));

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
        while ($line = $data->sql->get_next($res))
        {
            $bgcolor = $color = '';
            $list .= '<row';
            $list .= '>';
//            $list .= '<cell>'.$line['ADMINISTRATOR'].'</cell>';
            $list .= '<cell>'.$line['MACH_NAME'].'</cell>';
            $list .= '<cell>'.$line['MACH_STATUS'].'</cell>';
            $list .= '<cell>'.$line['AGENT_NAME'].'</cell>';
            $list .= '<cell>'.$line['DESCRIPTION'].'</cell>';
//            $list .= '<cell>'.$line['PARENT_NAME'].'</cell>';
            $list .= '<cell>'.$line['QUE_NAME'].'</cell>';
            $list .= '<cell>'.$line['TYPE'].'</cell>';
            $list .= '<cell>'.$line['OPSYS'].'</cell>';            
            $list .= '<cell>'.$line['MAX_LOAD'].'</cell>';
            $list .= '<cell>'.$line['FACTOR'].'</cell>';
            $list .= '<cell>'.$line['NODE_NAME'].'</cell>';
            $list .= '<cell>'.$line['PORT'].'</cell>';
/*            $list .= '<cell>'.$line['PLUGIN_ADDTLN_COUNT'].'</cell>';
            $list .= '<cell>'.$line['PLUGIN_LIST'].'</cell>';
*/
/*            $list .= '<cell>'.$line['PREPJOBID'].'</cell>';
            $list .= '<cell>'.$line['PROVISION'].'</cell>';
*/            $list .= '</row>';
        }
        $list .= "</rows>\n";
        $response->setContent( $list );
        return $response;        
    }

    public function pieAction() {
        $dhtmlx = $this->container->get('arii_core.dhtmlx');
        $data = $dhtmlx->Connector('data');
        // Jobs
        $Fields = array( '{job_name}'   => 'JOB_NAME' );
        
        $sql = $this->container->get('arii_core.sql');
        $qry = $sql->Select(array('EVENTTXT','STATUSTXT','count(JOID) as NB'))
                .$sql->From(array('UJO_EVENTVU'))
                .$sql->GroupBy(array('EVENTTXT','STATUSTXT'));

        $res = $data->sql->query($qry);
        $autosys = $this->container->get('arii_ats.autosys');
        while ($line = $data->sql->get_next($res))
        {            
            if ($line['STATUSTXT'] == '')
                $status = $autosys->Status($line['EVENTTXT']);
            else
                $status = $autosys->Status($line['STATUSTXT']);

            $Status[$status] = $line['NB'];
        }
        $pie = '<data>';
        foreach ($Status as $s=>$nb) {
            list($bgcolor) = $autosys->ColorStatus($s);
            $pie .= '<item id="'.$s.'"><STATUS>'.$s.'</STATUS><JOBS>'.$nb.'</JOBS><COLOR>'.$bgcolor.'</COLOR></item>';
        }
        $pie .= '</data>';
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        $response->setContent( $pie );
        return $response;
    }

}