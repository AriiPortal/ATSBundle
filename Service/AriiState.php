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
   public function Jobs() {   
        $date = $this->date;        
        $sql = $this->sql;
        $db = $this->db;
        $data = $db->Connector('data');
        
        // Jobs
        $Fields = array( '{job_name}'   => 'JOB_NAME' );

        $qry = $sql->Select(array('JOID','JOB_NAME','DESCRIPTION','STATUS','STATUS_TIME'))
                .$sql->From(array('UJO_JOBST'))
                .$sql->Where($Fields)
                .$sql->OrderBy(array('JOB_NAME'));

        $res = $data->sql->query($qry);
        $Jobs = array();
        while ($line = $data->sql->get_next($res))
        {            
            $jn = $line['JOB_NAME'];
            $joid = $line['JOID'];

            $Jobs[$jn] =$line;
        }
        return $Jobs;
   }

}
