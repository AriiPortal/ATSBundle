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

    public function templateAction()
    {   
        $request = Request::createFromGlobals();
        $arg = $request->query->get( 'template' );
        list($content, $config) = $this->template($arg);
        print "<pre>".$this->get('arii_tools.twig_string')->render( $content, $config )."</pre>";        
        exit();
    }

    private function template($arg) {
        $template = basename($arg);
        $category = dirname($arg);
        
        # Quel est le workspace ?
        $path = $this->container->getParameter('workspace')."/Autosys/Templates/$category"; 
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
        
        $basedir = $this->container->getParameter('workspace')."/Autosys/Templates"; 
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

    public function diffAction()
    {   
        $request = Request::createFromGlobals();
        $arg = $request->query->get( 'template' );

        print "<strong>$arg</strong>";
        
        $path = $this->container->getParameter('workspace')."/Autosys/Templates";

        $ref = str_replace('.yml','.ref',$arg);
        $reffile = "$path/$ref";
        if (!file_exists($reffile)) {
            print "<p><font color='red'>$ref ?!</font></p>";
            exit();
        }

        list($content, $config) = $this->template($arg);
        $new = $this->get('arii_tools.twig_string')->render( $content, $config );

        $file = substr($arg,0,strlen($arg)-4);
        file_put_contents("$path/$file.new",$new);

        //$gvz_cmd = $this->container->getParameter('graphviz_cmd');
        $cmd = $this->container->getParameter('perl').' '.dirname(__FILE__).str_replace('/',DIRECTORY_SEPARATOR,'/../Perl/jildiff.pl ');
        $cmd .= ' jil="'.$reffile.'" del=y < "'."$path/$file.new".'"';
        
        print "<pre>";
        print `$cmd`; 
        print "</pre>";
//        print $cmd;
        exit();
    }

      
}
