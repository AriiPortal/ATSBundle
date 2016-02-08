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
   public function Jobs($box='%',$only_warning=0,$box_only=1) {   
        $date = $this->date;        
        $sql = $this->sql;
        $db = $this->db;
        $data = $db->Connector('data');
        
        // Jobs
        $Fields = array( 
            '{job_name}'   => 's.JOB_NAME',
            '{start_timestamp}'=> 'LAST_START');
        
        if ($box_only) 
            $Fields['s.JOB_TYPE'] = 98;
        
        # Jointure car la vue est incomplete
        $qry = $sql->Select(array('s.*','j.AS_APPLIC','j.AS_GROUP'))
                .$sql->From(array('UJO_JOBST s'))
                .$sql->LeftJoin('UJO_JOB j',array('j.JOID','s.JOID'))
                .$sql->Where($Fields)
                .$sql->OrderBy(array('s.BOX_NAME','s.JOB_NAME'));

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

}
