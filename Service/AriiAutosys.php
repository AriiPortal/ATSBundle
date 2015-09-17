<?php
// src/Arii/JOCBundle/Service/AriiState.php
/*
 * Recupere les données et fournit un tableau pour les composants DHTMLx
 */ 
namespace Arii\ATSBundle\Service;

class AriiAutosys
{
    protected $ColorStatus;
    
    public function __construct ($color_status) {
        $this->ColorStatus = $color_status;
    }
    public function Alarm($alarm) {   
        $Alarms = array ( 
            501 => 'FORKFAIL',
            502 => 'MINRUNALARM',
            503 => 'JOBFAILURE',
            505 => 'MAX_RETRYS',
            506 => 'STARTJOBFAIL',
            507 => 'EVENT_HDLR_ERROR',
            508 => 'EVENT_QUE_ERROR',
            509 => 'JOBNOT_ONICEHOLD',
            510 => 'MAXRUNALARM',
            512 => 'RESOURCE',
            513 => 'MISSING_HEARTBEAT',
            514 => 'CHASE',
            516 => 'DATABASE_COMM',
            517 => 'APP_SERVER_COMM',
            518 => 'VERSION_MISMATCH',
            519 => 'DB_ROLLOVER',
            520 => 'EP_ROLLOVER',
            521 => 'EP_SHUTDOWN',
            522 => 'EP_HIGH_AVAIL',
            523 => 'DB_PROBLEM',
            524 => 'DUPLICATE_EVENT',
            525 => 'INSTANCE_UNAVAILABLE',
            526 => 'AUTO_PING',
            529 => 'EXTERN_DEPS_ERROR',
            532 => 'MACHINE_UNAVAILABLE',
            533 => 'SERVICEDESK_FAILURE',
            534 => 'UNINOTIFY_FAILURE',
            535 => 'CPI_JOBNAME_INVALID',
            536 => 'CPI_UNAVAILABLE',
            537 => 'MUST_START_ALARM',
            538 => 'MUST_COMPLETE_ALARM',
            539 => 'WAIT_REPLY_ALARM',
            540 => 'KILLJOBFAIL',
            541 => 'SENDSIGFAIL',
            542 => 'REPLY_RESPONSE_FAIL',
            543 => 'RETURN_RESOURCE_FAIL',
            544 => 'RESTARTJOBF' );
        if (isset($Alarms[$alarm])) {
            return $Alarms[$alarm];
        }
        return $alarm;
   }

    public function AlarmState($state) {   
        $States = array ( 
            43 => 'OPEN',
            44 => 'ACKNOWLEDGED',
            45 => 'CLOSED' );
        if (isset($States[$state])) {
            return $States[$state];
        }
        return $state;
    }

    public function Status($status) {   
        $Status = array (
            1 => 'RUNNING',
            3 => 'STARTING',
            4 => 'SUCCESS',
            5 => 'FAILURE',
            6 => 'TERMINATED',
            7 => 'ON_ICE',
            8 => 'INACTIVE',
            9 => 'ACTIVATED',
            10 => 'RESTART',
            11 => 'ON_HOLD',
            12 => 'QUEUE_WAIT',
            13 => 'WAIT_REPLY',
            14 => 'PEND_MACH',
            15 => 'RES_WAIT',
            16 => 'NO_EXEC'
        );
        if (isset($Status[$status])) {
            return $Status[$status];
        }
        return $status;
   }

    public function ColorStatus($status) {
        if (!isset($this->ColorStatus[$status]))
            return array('black','red');
        $Colors = explode('/',$this->ColorStatus[$status]);
        $bgcolor=$Colors[0];
        if (isset($Colors[1]))
            $color = $Colors[1];
        else
            $color = 'black';
        return array($bgcolor,$color);
   }

    public function JobType($type) {   
        $JobType = array (
            98 => 'BOX',
            99 => 'CMD',
            102 => 'FW',
            220 => 'I5'
        );
        if (isset($JobType[$type])) {
            return $JobType[$type];
        }
        return $type;
   }

 
}
