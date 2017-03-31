<?php
namespace Arii\ATSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class BoxController extends Controller
{
    
    public function docAction($id=0)
    {
        $request = Request::createFromGlobals();
        if ($request->get('id')>0) 
            $id = $request->get('id');
        $job_name = $request->get('job');

        $db = $this->container->get('arii_core.dhtmlx');
        $sql = $this->container->get('arii_core.sql');
        $data = $db->Connector('data');
        $qry = $sql->Select(array('j.*','s.*')) 
                .$sql->From(array('UJO_JOB j'))
                .$sql->LeftJoin('UJO_JOBST s',array('j.JOID','s.JOID'));
        if ($job_name!='')
                $qry .= $sql->Where(array('j.JOB_NAME'=>$job_name,'j.IS_CURRVER' => 1,'j.IS_ACTIVE' => 1));
        else
                $qry .= $sql->Where(array('j.JOID'=>$id,'j.IS_CURRVER' => 1,'j.IS_ACTIVE' => 1));

        $res = $data->sql->query($qry);
        $Box = $data->sql->get_next($res);

        $Note = array($Box['JOID']);
        // on recalcule l'id (si l'argument est un nom de job)
        if ($id=='') $id = $Box['JOID'];
        
        $qry = $sql->Select(array('j.*','s.*'))
                .$sql->From(array('UJO_JOB j'))
                .$sql->LeftJoin('UJO_JOBST s',array('j.JOID','s.JOID'))
                .$sql->Where(array('j.BOX_JOID'=>$id,'j.IS_CURRVER' => 1));

        $res = $data->sql->query($qry);
        $Job = array();
        while ($line = $data->sql->get_next($res))
        {
            $joid = $line['JOID'];
            $Job[$joid] = $line;            
        }

        // Ajout des notes de jobs
        foreach ($Job as $joid=>$Infos) {
            $job = $Job[$joid]['JOB_NAME'];
            $Job[$joid]['TEMPLATE'] = '';
            $note = $this->getDoctrine()->getRepository("AriiATSBundle:Notes")->findOneBy(array('job_name'=>$job));
            
            if ($note) {
                $Job[$joid]['NOTE'] = $note->getJobNote();
                $Job[$joid]['DESC'] = $note->getJobDesc();
                $template = $note->getTemplate();
                if ($template) {                  
                    $Job[$joid]['TEMPLATE'] = $template->getJobNote();
                }
            }
            else {
                // On recherche la doc la plus proche
                $em = $this->getDoctrine()->getManager();
                $Notes = $em->getRepository("AriiATSBundle:Notes")->createQueryBuilder('o')
                        ->Where(':template LIKE o.job_name') 
                        ->setParameter('template', $job)                  
                       ->getQuery()
                       ->getResult();
                
                $Job[$joid]['NOTE'] = '';
                $Job[$joid]['SUGGEST'] = array();
                $Suggest = array();
                if ($Notes) {
                    $max = 0;
                    foreach ($Notes as $Note) {
                        // on cherche le titre qui le plus de lettres (et le moins de % ?)
                        $jobname = $Note->getJobName();
                        $len = strlen($jobname);
                        if ($len>$max)
                            $max = $len;
                        $Suggest[$jobname] = array( 'count' => $len, 'note' => $Note );
                    }
                    
                    $S = array();
                    foreach ($Suggest as $k=>$v) {
                        if ($v['count']==$max) {
                            array_push($S, array(
                                'name' => $v['note']->getJobName(),
                                'desc' => $v['note']->getJobDesc(),
                                'note' => $v['note']->getJobNote(),
                                )
                            );
                        }
                    }
                    $Job[$joid]['SUGGEST'] = $S;
                }
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
