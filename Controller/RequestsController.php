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
        // On récupère les statuts en cours
        $em = $this->getDoctrine()->getManager('default');        
        $Checks = $em->getRepository("AriiATSBundle:Check")->findAll();
        foreach ($Checks as $Check) {
            $request = $Check->getName();
            $State[$request] = [
                'status'  => $Check->getStatus(),
                'executed'  => $Check->getExecuted()->format('U'),
                'results'  => $Check->getResults()
            ];            
        }
        
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        $list = '<?xml version="1.0" encoding="UTF-8"?>';
        $list .= '<rows>';
        $list .= '<head>
            <afterInit>
                <call command="clearAll"/>
            </afterInit>
        </head>';
        
        $yaml = new Parser();
        $basedir = $this->getBaseDir();

        $portal = $this->container->get('arii_core.portal');
        $ColorStatus = $portal->getColors();

        if ($dh = @opendir($basedir)) {
            while (($file = readdir($dh)) !== false) {
                if (substr($file,-4) == '.yml') {
                    $content = file_get_contents("$basedir/$file");
                    $v = $yaml->parse($content);
                    $title = $v['title'];
                    $name = substr($file,0,strlen($file)-4);
                    if (isset($State[$name])) {
                        $nb     = $State[$name]['results'];
                        $delay = round((time() - $State[$name]['executed'])/3600);
                        if ($delay>4) {
                            $bg = ' style="background-color: '.$ColorStatus['RUNNING']['bgcolor'].';"';
                        }
                        else {
                            switch ($State[$name]['status']) {
                                case 1:
                                    $bg = ' style="background-color: '.$ColorStatus['INACTIVE']['bgcolor'].';"';
                                    break;
                                case 2:
                                    $bg = ' style="background-color: '.$ColorStatus['SUCCESS']['bgcolor'].';"';
                                    break;
                                case 4:
                                    $bg = ' style="background-color: '.$ColorStatus['FAILURE']['bgcolor'].';"';
                                    break;
                                default:
                                    $bg = '';
                            }
                        }
                    }
                    else {
                        $nb='';
                        $bg = '';
                    }
                    $Files[$title] = '<row id="'.$name.'"'.$bg.'><cell>'.$title.'</cell><cell>'.$nb.'</cell></row>';
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
        $basedir = $this->getBaseDir();

        $yaml = new Parser();
        $value['title'] = $this->get('translator')->trans('Summary','internal');
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

    public function resultAction($output='html',$dbname='',$req='')
    {
        $lang = $this->getRequest()->getLocale();
        $request = Request::createFromGlobals();
        if ($request->query->get( 'request' )!='')
            $req=$request->query->get( 'request');
        
        if ($req=='')
            throw new \Exception('ARI',6);

        // cas de l'appel direct
        if ($request->query->get( 'dbname' )!='')
            $dbname=$request->query->get( 'dbname');

        if ($dbname!='') {
            $portal = $this->container->get('arii_core.portal');
            $engine = $portal->setDatabaseByName($dbname,'waae');            
        }
        
        if (!isset($req)) return $this->summaryAction();
        
        $page = $this->getBaseDir().'/'.$req.'.yml';
        $content = file_get_contents($page);
        
        $yaml = new Parser();
        try {
            $value = $yaml->parse($content);
        } catch (ParseException $e) {
            throw new \Exception($e->getMessage());
        }

        $runtime = microtime();
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

        // Statut 
        $status = 0; // inconnu
        $min=0;
        $max=1000000;
        if (!isset($value['expected'])) {
            $status=1; // info
        }
        else {
            $expected = $value['expected'];
            $Limits = explode("-",$expected);
            $min=$Limits[0];
            if (!isset($Limits[1]))
                $max=$min;
            if (($nb>=$min) and ($nb<=$max))
                $status = 2; // success
            else 
                $status = 4; // error
        }
        
        $runtime = microtime() - $runtime;

        // on peut mettre a jour la table des sondes
        $em = $this->getDoctrine()->getManager();        
        $Check = $em->getRepository("AriiATSBundle:Check")->findOneBy( [ 'name' => $req ] );

        if (!$Check)
            $Check = new \Arii\ATSBundle\Entity\Check();  

        $Check->setName($req);
        $Check->setTitle($value['title']);
        $Check->setRunTime($runtime);
        $Check->setResults($nb);
        $Check->setMinSuccess($min);
        $Check->setMaxSuccess($max);
        $Check->setStatus($status);
        $Check->setExecuted(new \Datetime());

        $em->persist($Check);
        $em->flush();
        
        if ($output=='html') {
            return $this->render('AriiATSBundle:Requests:bootstrap.html.twig', array('result' => $value, 
                'infos' => [ 
                    'results' => $nb,
                    'min_success' => $min,
                    'max_success' => $max,
                    'min_warning' => $min,
                    'max_warning' => $max,
                    'status' => $status,
                    'runtime' => $runtime,
                    'request' => $req
                ] ));
        }
        elseif ($output=='csv') {
            $sep = ";";
            $response = new Response();
            $response->headers->set('Content-type', 'text/plain');
            $response->headers->set("Content-disposition", "attachment; filename=$req.csv"); 
            $csv = implode($sep,$value['columns'])."\n";
            if (isset($value['lines'])) {
                foreach ($value['lines'] as $k=>$l) {
                    $csv .= implode($sep,$l['cells'])."\n";
                }
            }
            if ($status==4)
                $response->setStatusCode( '417' );

            $response->setContent( utf8_decode( $csv ) );
            return $response;                      
        }
        elseif ($output=='check') {
            $response = new Response();
            $response->setStatusCode( '417' );
            return $response;                      
        }        

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

    private function getBaseDir() {
        $lang = $this->getRequest()->getLocale();       
        $portal = $this->container->get('arii_core.portal');
        return $portal->getWorkspace().'/Autosys/Requests/'.$lang;    
    }
}