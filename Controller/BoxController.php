<?php
namespace Arii\ATSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class BoxController extends Controller
{
    
    public function docAction()
    {
        $request = Request::createFromGlobals();
        $id = $request->get('id');
        
        $db = $this->container->get('arii_core.dhtmlx');
        $sql = $this->container->get('arii_core.sql');
        $data = $db->Connector('data');
        $qry = $sql->Select(array('s.*','j.AS_APPLIC','j.AS_GROUP'))
                .$sql->From(array('UJO_JOBST s'))
                .$sql->LeftJoin('UJO_JOB j',array('j.JOID','s.JOID'))
                .$sql->Where(array('s.JOID'=>$id,'j.IS_CURRVER' => 1));

        $res = $data->sql->query($qry);
        $Box = $data->sql->get_next($res);
        $Note = array($Box['JOID']);
        
        $qry = $sql->Select(array('s.*','j.AS_APPLIC','j.AS_GROUP'))
                .$sql->From(array('UJO_JOBST s'))
                .$sql->LeftJoin('UJO_JOB j',array('j.JOID','s.JOID'))
                .$sql->Where(array('j.BOX_JOID'=>$id,'j.IS_CURRVER' => 1));

        $res = $data->sql->query($qry);
        while ($line = $data->sql->get_next($res))
        {
            $joid = $line['JOID'];
            $Job[$joid] = $line;            
        }

        // Ajout des notes de jobs
        foreach ($Job as $joid=>$Infos) {
            $job = $Job[$joid]['JOB_NAME'];
            $note = $this->getDoctrine()->getRepository("AriiATSBundle:Notes")->findOneBy(array('job_name'=>$job));

            if ($note) {
                $Job[$joid]['NOTE'] = $note->getJobNote();
                $Job[$joid]['DESC'] = $note->getJobDesc();
                $template = $note->getTemplate();
                if ($template) {                  
                    $Job[$joid]['TEMPLATE'] = $template->getJobNote();
                }
                else {
                    $Job[$joid]['TEMPLATE'] = '';
                }
            }
            else {
                $Job[$joid]['NOTE'] = '';
            }
        }        

        $response = new Response();
        return $this->render('AriiATSBundle:Box:bootstrap.html.twig', 
                array( 
                    'Box'  => $Box,
                    'Jobs' => $Job
                ),
                $response );
    }
    
}
