<?php

namespace Arii\ATSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Yaml\Parser;

class DefaultController extends Controller
{
    public function indexAction()
    {
        // La db est en parametre ?
        $request = Request::createFromGlobals();
            $portal = $this->container->get('arii_core.portal');
        if ($request->get('db')!='')
            $portal->setDatabaseByName($request->get('db'));
        if ($request->get('db_id')!='')
            $portal->setDatabaseById($request->get('db_id'));
        return $this->render('AriiATSBundle:Default:index.html.twig');
    }

    public function summaryAction()
    {
        $portal = $this->container->get('arii_core.portal');
        $Module = $portal->getModule('ATS');

        // On recupère les requetes
        $yaml = new Parser();
        $lang = $this->getRequest()->getLocale();

        $basedir = $this->getBaseDir();
        $Requests = array();
        if ($dh = @opendir($basedir)) {
            while (($file = readdir($dh)) !== false) {
                if (substr($file,-4) == '.yml') {
                    $content = file_get_contents("$basedir/$file");
                    $v = $yaml->parse($content);
                    $v['id']=substr($file,0,strlen($file)-4);
                    if (!isset($v['icon'])) $v['icon']='cross';
                    if (!isset($v['title'])) $v['title']='?';
                    array_push($Requests, $v);
                }
            }
        }
        
        // Base de donnees courante ?
        // passée en variable        
        $request = Request::createFromGlobals();
            $portal = $this->container->get('arii_core.portal');
        if ($request->get('db')!='')
            $portal->setDatabaseByName($request->get('db'));
        if ($request->get('db_id')!='')
            $portal->setDatabaseById($request->get('db_id'));

        // on reteste (c'est en session)
        $Database = $portal->getDatabase();
        if (isset($Database['name']))
            $db = $Database['name'];
        else
            $db = "?";

        // base de données
        $Nodes=$portal->getNodesBy('vendor', 'ats');
  
        // on recrée un arbre avec référentiel 
        $db_active = '';
        $Repositories = array();
        foreach ($Nodes as $Node) {
            foreach ($Node['Connections'] as $Connection) {
                if ($Connection['domain']!='database') continue;
                $name = $Connection['name'];
                if (!isset($Repositories[$name])) {
                    $Repositories[$name] = $Connection;
                    // si la base est dans la liste, elle est validée
                    if ($Connection['name']==$db) $db_active=$db;                
                }
            }
        }
        // si la base n'est pas dans la liste, on reset ?
        return $this->render('AriiATSBundle:Default:summary.html.twig',array('module' => $Module, 'Repositories' => $Repositories, 'db_active' => $db_active ));
    }

    public function mainAction()
    {
        $portal = $this->container->get('arii_core.portal');
        $Spoolers=$portal->getNodesBy('vendor', 'ats'); 
        
        return $this->render('AriiATSBundle:Default:summary.html.twig',
            array(  'module'   => $portal->getModule('ATS'), 
                    'Spooler'  => $portal->getJobScheduler(),
                    'Database' => $portal->getDatabase() ));                
    }
    
    public function readmeAction()
    {
        return $this->render('AriiATSBundle:Default:readme.html.twig');
    }

    public function sendevent_toolbarAction()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        return $this->render('AriiATSBundle:Default:sendevent_toolbar.xml.twig',array(), $response );
    }

    public function ribbonAction()
    {
        // On recupère les requetes
        $yaml = new Parser();
        $lang = $this->getRequest()->getLocale();

        $basedir = $this->getBaseDir();

        $Requests = array();
        if ($dh = @opendir($basedir)) {
            while (($file = readdir($dh)) !== false) {
                if (substr($file,-4) == '.yml') {
                    $content = file_get_contents("$basedir/$file");
                    $v = $yaml->parse($content);
                    $v['id']=substr($file,0,strlen($file)-4);
                    if (!isset($v['icon'])) $v['icon']='cross';
                    if (!isset($v['title'])) $v['title']='?';
                    array_push($Requests, $v);
                }
            }
        }
        
        // On recupere la liste des base de données
        // si il y en a plus d'une, pour ats, on cree une liste de choix
        $portal = $this->container->get('arii_core.portal');
        $Nodes=$portal->getNodesBy('vendor', 'ats');  
        
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        
        return $this->render('AriiATSBundle:Default:ribbon.json.twig',array('Nodes' => $Nodes, 'Requests' => $Requests ), $response );
    }

    public function docAction() {
        $request = Request::createFromGlobals();
        $lang = $this->getRequest()->getLocale();
        $template = $this->container->getParameter('ats_doc');

        $doc = $this->container->get('arii_core.doc');
        $url = $doc->Url($template);

        $response = new Response();
        $response->setStatusCode(200);
        $response->headers->set('Refresh', '0; url='.$url);
        $response->send();
    }

    public function sendeventAction() {
        $request = Request::createFromGlobals();
        $job = $request->request->get( 'JOB' );
        $action = $request->request->get( 'ACTION' );
        $comment = $request->request->get( 'COMMENT' );
        
        $exec = $this->container->get('arii_ats.exec');
        $sendevent = 'sendevent -E '.$action.' -J '.$job.' -c "'.$comment.'"';
        
        $response = new Response();
        $response->headers->set('Content-Type: text/html; charset=utf-8');        
        $html = '<pre>'.$exec->Exec($sendevent).'</pre>';
        $response->setContent( $html );
        return $response;
    }

    public function autorepAction() {
        $request = Request::createFromGlobals();
        $job = $request->query->get( 'job' );
        $options = $request->query->get( 'options' );
        
        $exec = $this->container->get('arii_ats.exec');
        
        $response = new Response();
        $response->headers->set('Content-Type: text/html; charset=utf-8');        
        $html = '<pre>'.$exec->Exec("autorep -J $job $options").'</pre>';
        $response->setContent( $html );
        return $response;
    }

    public function autosyslogAction() {
        $request = Request::createFromGlobals();
        $job = $request->query->get( 'job' );
        $options = $request->query->get( 'options' );
        
        $exec = $this->container->get('arii_ats.exec');
        
        $response = new Response();
        $response->headers->set('Content-Type: text/html; charset=utf-8');        
        $html = '<pre>'.$exec->Exec("autosyslog -J $job $options").'</pre>';
        $response->setContent( $html );
        return $response;        
    }
/*
File Name  File Num Status     Size (KB) Date   Time   User Data  Queue Name 
---------- -------- ---------- --------- ------ ------ ---------- ---------- 
QPJOBLOG   1        *READY     24        150911 093940 EJOBOTOSY1 QEZJOBLOG  
 */
    public function autosyslog_gridAction() {
        $request = Request::createFromGlobals();
        $job = $request->query->get( 'job' );
        $options = $request->query->get( 'options' );
        
        
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= "<rows>\n";
        $xml .= '<head>
            <afterInit>
                <call command="clearAll"/>
            </afterInit>
        </head>';
        
        $exec = $this->container->get('arii_ats.exec');
        $result = $exec->Exec("autosyslog -J $job $options");
        foreach (explode("\n",$result) as $l) {
            if (preg_match("/^(.{10}) (.{8}) (.{10}) (.{9}) (\d{6}) (\d{6}) (.{10}) (.*)/",$l,$matches)) {
                $xml .= "<row>";
                array_shift($matches);
                foreach($matches as $m) {
                    $xml .= "<cell>".trim($m)."</cell>";
                }
                $xml .= "</row>";                
            }
        }
        $xml .= "</rows>\n";
        $response->setContent( $xml );
        return $response;
    }

    public function chk_auto_upAction() {
        $request = Request::createFromGlobals();
        $job = $request->query->get( 'job' );
        $options = $request->query->get( 'options' );
        
        $exec = $this->container->get('arii_ats.exec');
        $Check = array();
        foreach (explode("\n",$exec->Exec("chk_auto_up")) as $line) {
            if (strpos($line, "Connected with")) {
                $line = '<font color="green">'.$line.'</font>';
            }
            elseif (strpos($line, "is RUNNING")) {
                $line = '<font color="green">'.$line.'</font>';
            }
            elseif (strpos($line, "not RUNNING")) {
                $line = '<font color="red">'.$line.'</font>';
            }
            elseif (strpos($line, "***")) {
                $line = '<strong>'.$line.'</strong>';
            }
            array_push($Check, $line);            
        }
        header('Content-Type: text/html; charset=utf-8');        

        $response = new Response();
        $response->headers->set('Content-Type: text/html; charset=utf-8');        
        $html = '<pre>'.implode("\n",$Check).'</pre>';
        $response->setContent( $html );
        return $response;         
    }

    /* Donne le répertoire de travail en fonction de la langue et de l'utilisiation */
    private function getBaseDir() {
        $lang = $this->getRequest()->getLocale();       
        $portal = $this->container->get('arii_core.portal');
        return $portal->getWorkspace().'/Autosys/Requests/'.$lang;    
    }

    public function nodesAction()
    {        
        // On recupere la liste des spoolers, donc des nodes 'OJS'
        $portal = $this->container->get('arii_core.portal');
        $Nodes=$portal->getNodesBy('vendor', 'ats');
  
        $Result = array();
        foreach ($Nodes as $Node) {
            foreach ($Node['Connections'] as $Connection) {
                if ($Connection['domain']!='database') continue;
                $name = $Node['title'];
                $Result[$name] = array(
                    'id'=> $Node['id'], 
                    'db' => $Connection['title'], 
                    'db_id' => $Connection['id'],
                    'db_name' => $Connection['name'] );
            }
        }
        asort($Result);
        // on recrée un arbre avec référentiel 
        $data = "<?xml version='1.0' encoding='utf-8' ?>";
        $data .= "<rows>";
        foreach ($Result as $name => $Info) {
            $data .= '<row id="'.$Info['id'].'">';
            $data .= '<cell>'.$name.'</cell>';
            $data .= '<cell>'.$Info['db'].'</cell>';
            $data .= '<cell>'.$Info['db_id'].'</cell>';
            $data .= "</row>";
        }
        $data .= "</rows>";
        
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        $response->setContent( $data );
        return $response;
    }
    
}
