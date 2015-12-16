<?php

namespace Arii\ATSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class LogsController extends Controller
{
    protected $images;
    
    public function __construct( )
    {
    }

    public function indexAction()
    {
        return $this->render('AriiATSBundle:Logs:index.html.twig');
    }

    public function toolbarAction()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        return $this->render('AriiATSBundle:Logs:toolbar.xml.twig',array(), $response );
    }

    public function EventDemonAction($only_warning=0,$job_only=0)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        $list = '<?xml version="1.0" encoding="UTF-8"?>';
        $list .= "<rows>\n";
        $list .= '<head>
            <afterInit>
                <call command="clearAll"/>
            </afterInit>
        </head>';
        
        // Tail du log
        $ats = $this->container->get('arii_ats.exec');
        $autosys = $this->container->get('arii_ats.autosys');
        $log = $ats->Exec('autosyslog -e -l 100');
        
        $last_code='';
        foreach (array_reverse(explode("\n",$log)) as $line) {
            $date = substr($line,1,19);
            $test = substr($line,27,6);
            if ($test=='CAUAJM') {
                $code = substr($line,36,5);
                $text = substr($line,42);
            }
            elseif ($test=='------') {
                $code = '...';
            }
            else {
                $code = $last_code;
                $text = substr($line,27);
            }
            if ($code == '') continue;
            $style ='';
            if (($p=strpos($text,' STATUS: '))>0) {
                $status = substr($text,$p+9,strpos($text,' ',$p+10)-$p-9);
                list($bgcolor,$Color) = $autosys->ColorStatus($status);
                $style =' style="background-color: '.$bgcolor.'"';
            }
            else {
                $style = '';
            }
            $bgcolor='white';
            $list .= '<row'.$style.'>';
            $list .= '<cell>'.$date.'</cell>';               
            $list .= '<cell><![CDATA['.str_replace(array('<','>'),array('&lt;','&gt;'),$text).']]></cell>';  
            $list .= '<cell>'.$code.'</cell>';
            $list .= '</row>';
            $last_code=$code;
        }        
            
        $list .= "</rows>\n";
        $response->setContent( $list );
        return $response;        
    }

}