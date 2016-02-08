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

    public function listAction()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        $list = '<?xml version="1.0" encoding="UTF-8"?>';
        $list .= '<rows>';
        
        $yaml = new Parser();
        $lang = $this->getRequest()->getLocale();
        
        $basedir = $this->container->getParameter('workspace').'/Autosys/Requests/'.$lang;
        if ($dh = @opendir($basedir)) {
            while (($file = readdir($dh)) !== false) {
                if (substr($file,-4) == '.yml') {
                    $content = file_get_contents("$basedir/$file");
                    $v = $yaml->parse($content);
                    $title = $v['title'];
                    $Files[$title] = '<row id="'.substr($file,0,strlen($file)-4).'"><cell>'.$title.'</cell></row>';
                }
            }
            ksort($Files);
            foreach ($Files as $k=>$v) {
                $list .= $v;
            }
        }
        $list .= '</rows>';

        $response->setContent( $list );
        return $response;        
    }
    
    public function summaryAction()
    {
        $lang = $this->getRequest()->getLocale();
        $basedir = $this->container->getParameter('workspace').'/Autosys/Requests/'.$lang;

        $yaml = new Parser();
        $value['title'] = $this->get('translator')->trans('Summary');
        $value['description'] = $this->get('translator')->trans('List of requests');
        $value['columns'] = array(
            $this->get('translator')->trans('Title'),
            $this->get('translator')->trans('Description') );
        
        $nb=0;
        if ($dh = @opendir($basedir)) {
            while (($file = readdir($dh)) !== false) {
                if (substr($file,-4)=='.yml') {
                    $content = file_get_contents("$basedir/$file");
                    $v = $yaml->parse($content);
                    $nb++;
                    $value['lines'][$nb]['cells'] = array($v['title'],$v['description']);
                }                
            }
        }
        
        $value['count'] = $nb;
        return $this->render('AriiATSBundle:Requests:bootstrap.html.twig', array('result' => $value));
    }

    public function resultAction($output='html')
    {
        $lang = $this->getRequest()->getLocale();
        $request = Request::createFromGlobals();
        if ($request->query->get( 'request' ))
            $req=$request->query->get( 'request');
        else {
            print "Request ?!";
            exit();
        }            
        if ($request->query->get( 'output' ))
            $output=$request->query->get( 'output');
            
        // cas de l'appel direct
        if ($request->query->get( 'dbname' )) {
            $instance=$request->query->get( 'dbname');

            $session = $this->container->get('arii_core.session');
            $engine = $session->setDatabaseByName($instance,'waae');            
        }
        
        if (!isset($req)) return $this->summaryAction();
        
        $page = $this->container->getParameter('workspace').'/Autosys/Requests/'.$lang.'/'.$req.'.yml';
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
        // On cree le tableau des consoles et des formats
        $value['columns'] = $Format = array();
        foreach (explode(',',$value['header']) as $c) {
            if (($p = strpos($c,'('))>0) {
                $h = substr($c,0,$p);
                $Format[$h] = substr($c,$p+1,strpos($c,')',$p)-$p-1);
                $c = $h;
            }
            array_push($value['columns'],$c);
        }
        // bibliothèques
        $ats  = $this->container->get('arii_ats.autosys'); 
        $date = $this->container->get('arii_core.date');   
        while ($line = $data->sql->get_next($res))
        {
            $r = array();
            $status = 'unknown';
            foreach ($value['columns'] as $h) {
                if (isset($line[$h])) {
                    // format special
                    $value['status'] = '';
                    if (isset($Format[$h])) {
                        switch ($Format[$h]) {
                            case 'timestamp':
                                $val = $date->Time2Local($line[$h]);
                                break;
                            case 'duration':
                                $val = $date->FormatTime($line[$h]);
                                break;
                            case 'status':
                                $val = $ats->Status($line[$h]);
                                $status = $val;
                                break;
                            case 'event':
                                $val = $ats->Event($line[$h]);
                                break;
                            case 'alarm':
                                $val = $ats->Alarm($line[$h]);
                                break;
                            case 'br':
                                $val = str_replace(array("\t","\n"),array("     ","<br/>"),$line[$h]);
                                break;
                            default:
                                $val = $line[$h].'('.$Format[$h].')';
                                break;
                        }
                    }
                    else {
                        $val = $line[$h];
                    }
                }
                else  $val = '';
                array_push($r,$val);
            }
            $nb++;
            $value['lines'][$nb]['cells'] = $r;
            $value['lines'][$nb]['status'] = $status;
         }
        $value['count'] = $nb;

        if ($output=='html')
            return $this->render('AriiATSBundle:Requests:bootstrap.html.twig', array('result' => $value ));
        
/*        
        $twig = file_get_contents('../src/Arii/ATSBundle/Resources/views/Requests/html2pdf.pdf.twig');
        $content = $this->get('arii_ats.twig_string')->render( $twig, array('result' => $value ) );      
        require_once('../vendor/html2pdf/html2pdf.class.php');
        header('Content-Type: application/pdf');
        $html2pdf = new \HTML2PDF('L','A4','fr');
        $html2pdf->WriteHTML($content);
        $html2pdf->Output($request.'.pdf');
*/
        $twig = file_get_contents('../src/Arii/ATSBundle/Resources/views/Requests/dompdf.pdf.twig');
        $content = $this->get('arii_ats.twig_string')->render( $twig, array('result' => $value ) );      
        require_once('../vendor/dompdf/dompdf_config.inc.php');
        header('Content-Type: application/pdf');
        $dompdf = new \DOMPDF();
        $dompdf->load_html($content);
        $dompdf->render();
        $dompdf->stream("sample.pdf");
        exit();
    }

}