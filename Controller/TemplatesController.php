<?php

namespace Arii\ATSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Yaml\Parser;

class TemplatesController extends Controller
{
    public function indexAction()
    {        
        return $this->render('AriiATSBundle:Templates:index.html.twig');            
    }

    public function toolbarAction()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        return $this->render('AriiATSBundle:Templates:toolbar.xml.twig',array(), $response );
    }

    public function templateAction()
    {   
        $request = Request::createFromGlobals();
        $arg = $request->query->get( 'template' );
        list($content, $config) = $this->template($arg);
        print "<pre>".$this->get('arii_ats.twig_string')->render( $content, $config )."</pre>";        
        exit();
    }

    private function template($arg) {
        $template = basename($arg);
        $category = dirname($arg);
        
        # Quel est le workspace ?
        $path = $this->getBaseDir().'/'.$category; 
        $content = file_get_contents("$path/$template");
        
        # On parse le fichier 
        $yaml = new Parser();
        try {
            $config = $yaml->parse($content);            
        } catch (ParseException $e) {
            $error = array( 'text' =>  "Unable to parse the YAML string: %s<br/>".$e->getMessage() );
            return $this->render('AriiATSBundle:Requests:ERROR.html.twig', array('error' => $error));
        }
        
        # Ouverture du template
        if (!isset($config['template']))
            throw new \Exception('ATS',2);
        
        $temp = $config['template'];
        $content = file_get_contents("$path/$temp");

        return array($content,$config);
    }
    
    public function treeAction()
    {        
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        $xml = "<?xml version='1.0' encoding='utf-8'?>";                
        $xml .= '<tree id="0" text="root">';
        
        # On parse le fichier 
        $yaml = new Parser();
        
        $basedir = $this->getBaseDir(); 
        if ($dh = @opendir($basedir)) {
            while (($file = readdir($dh)) !== false) {
                if (is_dir("$basedir/$file") and (substr($file,0,1)!='.')) {
                    $xml .= '<item id="'.$file.'" text="'.$file.'" img="folder.gif">';
                    $path = "$basedir/$file";
                    
                    if ($ds = @opendir($path)) {                    
                        while (($ymlfile = readdir($ds)) !== false) {
                            if (substr($ymlfile,-4)=='.yml') {
                                $info = $yaml->parse(file_get_contents("$path/$ymlfile"));
                                $xml .= '<item id="'."$file/$ymlfile".'" text="'.$info['title'].'"/>';                                
                            }
                        }
                    }
                    $xml .= '</item>';
                }
            }
        }
        $xml .= '</tree>';        
        $response->setContent($xml);
        return $response;
    }

    public function filesAction()
    {        
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        $xml = "<?xml version='1.0' encoding='utf-8'?>";                
        $xml .= '<rows><head><afterInit>
                <call command="clearAll"/>
            </afterInit>
        </head>
';
        
        # On parse le fichier 
        $yaml = new Parser();
        
        $basedir = $this->getBaseDir(); 
        if ($dh = @opendir($basedir)) {
            while (($file = readdir($dh)) !== false) {
                if (is_dir("$basedir/$file") and (substr($file,0,1)!='.')) {
                    $path = "$basedir/$file";
                    if ($ds = @opendir($path)) {                    
                        while (($newfile = readdir($ds)) !== false) {
                            if (substr($newfile,-4)=='.jil') {
                                $stat = stat("$path/$newfile");
                                $Time = localtime($stat[9],true);
                                $xml .= '<row id="'."$file/$newfile".'"><cell>'.$file.'</cell><cell>'.$newfile.'</cell><cell>'.sprintf("%04d-%02d-%02d %02d:%02d:%02d",$Time['tm_year']+1900,$Time['tm_mon']+1,$Time['tm_mday'],$Time['tm_hour'],$Time['tm_min'],$Time['tm_sec']).'</cell><cell>'.$stat[7].'</cell></row>';
                            }
                        }
                    }
}
            }
        }
        $xml .= '</rows>';        
        $response->setContent($xml);
        return $response;
    }

    // on appelle les templates liés au fichier de configuration
    public function recalcAction()
    {   
        $request = Request::createFromGlobals();
        $arg = $request->query->get( 'config' );
        $path = $this->getBaseDir();
       
        $config = @file_get_contents("$path/$arg");
        if (!$config) {
            print "$path/$arg";
            exit();            
        }
        
        # On parse le fichier 
        $yaml = new Parser();
        try {
            $cfg = $yaml->parse($config);          
        } catch (ParseException $e) {
            $error = array( 'text' =>  "Unable to parse the YAML string: %s<br/>".$e->getMessage() );
            return $this->render('AriiATSBundle:Requests:ERROR.html.twig', array('error' => $error));
        }
        
        # Ouverture du template
        if (!isset($cfg['templates']))
            throw new \Exception('ATS',2);

        # Parametres globaux
        $global = $cfg['global'];
        
        $dir = dirname("$path/$arg");
        foreach ($cfg['templates'] as $parameters) {
            $template = $parameters['file'];
            $code = @file_get_contents("$dir/$template");
            if ($code == '') {
                print "<p><font color='red'>TWIG $template ?!</font></p>";
            }
            $config = array_merge($global,$parameters);
            $new = $this->get('arii_ats.twig_string')->render( $code, $config );
            
            // Nouveau nom 
            $newfile = str_replace('.twig','.jil',$template);
            while (($p = strpos(" $newfile",'{{'))>0) {
                if (($e = strpos($newfile,'}}',$p))==0)
                    $e = $p+2;

                $param = substr($newfile,$p+1,$e-$p-1);
                if (isset($config[$param])) {
                    $param = $config[$param];
                }
                $newfile = substr($newfile,0,$p-1).$param.substr($newfile,$e+2);
            }
            
            if (@file_put_contents("$dir/$newfile",$new)) 
                print "$newfile<br/>";
            else 
                print "<p><font color='red'>JIL $newfile ?!</font></p>";
        }
        exit();
    }

    public function readAction()
    {   
        $request = Request::createFromGlobals();
        $arg = $request->query->get( 'file' );

        $path = $this->getBaseDir();
        $newfile = "$path/$arg";
        if (!file_exists($newfile)) {
            print "<p><font color='red'>$newfile ?!</font></p>";
            exit();
        }
        print "<pre>";
        print file_get_contents($newfile);
        print "</pre>";
        exit();
    }

    public function diffAction()
    {   
        $request = Request::createFromGlobals();
        $arg = $request->query->get( 'file' );
        $path = $this->getBaseDir();

        // On crée le dump
        $ats = $this->container->get('arii_ats.exec');
        $job = basename($arg);
        $job = substr($job,0,strlen($job)-4);
        $current = $ats->Exec('autorep -J '.$job.' -q');

        $ref = str_replace('.jil','.dump',$arg);
        $reffile = "$path/$ref";
        file_put_contents($reffile,$current);
        
        $session = $this->container->get('arii_core.session');
        $cmd = '"'.$session->get('perl').'" '.dirname(__FILE__).str_replace('/',DIRECTORY_SEPARATOR,'/../Perl/jildiff.pl ');
        $cmd .= ' jil="'.$reffile.'" del=y < "'."$path/$arg".'"';

        $res = `$cmd`;         
        $upd = str_replace('.dump','.update',$reffile);
        print "<pre>";
        print "/* $upd */\n";
        print $res;
        print "</pre>";
        file_put_contents($upd,$res);
        exit();
    }

    public function mepAction()
    {   
        $request = Request::createFromGlobals();
        $arg = $request->query->get( 'file' );
        $path = $this->getBaseDir();

        // On crée le dump
        $ats = $this->container->get('arii_ats.exec');
        $job = basename($arg);
        $job = substr($job,0,strlen($job)-4);
        $current = $ats->Exec('autorep -J '.$job.' -q');
        
        $ref = str_replace('.jil','.dump',$arg);
        $reffile = "$path/$ref";
        file_put_contents($reffile,$current);
        
        $session = $this->container->get('arii_core.session');
        $cmd = '"'.$session->get('perl').'" '.dirname(__FILE__).str_replace('/',DIRECTORY_SEPARATOR,'/../Perl/jildiff.pl ');
        $cmd .= ' jil="'.$reffile.'" del=y < "'."$path/$arg".'"';
//        print $cmd;
        $res = `$cmd`;         
        $upd = str_replace('.dump','.update',$reffile);
        print "<pre>";
        print "/* $upd */\n";
        print $res;
        print "</pre>";
        file_put_contents($upd,$res);
        exit();
    }     

    private function getBaseDir() {
        $lang = $this->getRequest()->getLocale();
        $session = $this->container->get('arii_core.session');
        return $session->get('workspace').'/Autosys/Templates';        
    }

}
