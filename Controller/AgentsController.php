<?php

namespace Arii\ATSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class AgentsController extends Controller
{
    protected $images;
    
    public function __construct( )
    {
          $request = Request::createFromGlobals();
          $this->images = $request->getUriForPath('/../bundles/ariicore/images/wa');          
    }

    public function indexAction()
    {
        return $this->render('AriiATSBundle:Servers:agents.html.twig');
    }
    
    public function agentsAction()
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
        $sql = $this->container->get('arii_core.sql');                  
        $qry = $sql->Select(array('MACH_STATUS'))
                .$sql->From(array('UJO_MACHINE'))
                .$sql->Where(array('TYPE'=>'a'));

        $dhtmlx = $this->container->get('arii_core.dhtmlx');
        $data = $dhtmlx->Connector('data');

        $res = $data->sql->query($qry);
        $autosys = $this->container->get('arii_ats.autosys');
        $online = $offline = 0;
        while ($line = $data->sql->get_next($res))
        {
            if ($line['MACH_STATUS'] == 'o') {
                $online++;
            }
            else {
                $offline++;
            }
         }
        $pie = '<data>';
        $pie .= '<item id="ONLINE"><STATUS>ONLINE</STATUS><PROCESSES>'.$online.'</PROCESSES><COLOR>#fbb4ae</COLOR></item>';
        $pie .= '<item id="OFFLINE"><STATUS>OFFLINE</STATUS><PROCESSES>'.$offline.'</PROCESSES><COLOR>#ccebc5</COLOR></item>';
        $pie .= '</data>';
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        $response->setContent( $pie );
        return $response;
    }
  
}