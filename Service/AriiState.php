<?php
// src/Arii/JOCBundle/Service/AriiState.php
/*
 * Recupere les données et fournit un tableau pour les composants DHTMLx
 */ 
namespace Arii\ATSBundle\Service;

class AriiState
{
    protected $db;
    protected $sql;
    protected $date;
    
    public function __construct (  
            \Arii\CoreBundle\Service\AriiDHTMLX $db, 
            \Arii\CoreBundle\Service\AriiSQL $sql,
            \Arii\CoreBundle\Service\AriiDate $date ) {
        $this->db = $db;
        $this->sql = $sql;
        $this->date = $date;
    }

/*********************************************************************
 * Informations de connexions
 *********************************************************************/
   public function Jobs($box='',$only_warning=0,$box_more=0) {   
        $date = $this->date;        
        $sql = $this->sql;
        $db = $this->db;
        $data = $db->Connector('data');
        
        // Jobs
        $Fields = array( 
            '{job_name}'   => 's.JOB_NAME',
            '{start_timestamp}'=> 'LAST_START',
            'j.is_currver' => 1 );
        if ($box!='') {
            $Fields['BOX_NAME'] = $box;
        }
        
        # Jointure car la vue est incomplete
        $qry = $sql->Select(array('s.*','j.AS_APPLIC','j.AS_GROUP'))
                .$sql->From(array('UJO_JOBST s'))
                .$sql->LeftJoin('UJO_JOB j',array('j.JOID','s.JOID'))
                .$sql->Where($Fields);
        if ($box_more==0) 
            $qry .= ' and  s.JOB_TYPE <> 98';                        
        $qry .= $sql->OrderBy(array('s.BOX_NAME','s.JOB_NAME'));

        $res = $data->sql->query($qry);
        $Jobs = array();
        while ($line = $data->sql->get_next($res))
        {   
            if ($only_warning and (($line['STATUS']==4) or ($line['STATUS']==8))) continue;
            $jn = $line['JOB_NAME'];
            $joid = $line['JOID'];
            $Jobs[$jn] =$line;
        }
        return $Jobs;
   }

   public function Boxes($box='%',$only_warning=0,$box=0) {   
        $date = $this->date;        
        $sql = $this->sql;
        $db = $this->db;
        $data = $db->Connector('data');
        
        // Jobs
        $Fields = array( 
            '{job_name}'   => 's.JOB_NAME',
            '{start_timestamp}'=> 's.LAST_START',
            's.JOB_TYPE' => 98 );
        
        # Jointure car la vue est incomplete
        $qry = $sql->Select(array(
                    's.JOID','s.JOB_NAME as BOX_NAME','s.LAST_START','s.LAST_END','s.STATUS','s.NEXT_START',
                    'j.JOID as JOB_JOID','j.JOB_NAME','j.LAST_START as JOB_START','j.LAST_END as JOB_END','j.STATUS as JOB_STATUS',
                    'i.AS_APPLIC','i.AS_GROUP'))
                .$sql->From(array('UJO_JOBST s'))
                .$sql->LeftJoin('UJO_JOBST j',array('s.JOID','j.BOX_JOID'))
                .$sql->LeftJoin('UJO_JOB i',array('j.JOID','i.JOID'))
                .$sql->Where($Fields)
                .$sql->OrderBy(array('s.BOX_NAME','j.LAST_START','j.NEXT_START'));

        $res = $data->sql->query($qry);
        $Jobs = array();
        while ($line = $data->sql->get_next($res))
        {   
            if ($only_warning 
                    and (($line['STATUS']==4) or ($line['STATUS']==8)) 
                    and (($line['JOB_STATUS']==4) or ($line['JOB_STATUS']==7) or ($line['JOB_STATUS']==8) or ($line['JOB_STATUS']==11)) ) continue;
            $jn = $line['BOX_NAME'];
            $joid = $line['JOID'];
            $Jobs[$jn] =$line;
        }
        return $Jobs;
   }
   
}
