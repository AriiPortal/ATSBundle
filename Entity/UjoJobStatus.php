<?php

namespace Arii\ATSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UjoJobStatus
 *
 * @ORM\Table(name="UJO_JOB_STATUS", indexes={@ORM\Index(name="xak3ujo_job_status", columns={"JOID", "WF_JOID"}), @ORM\Index(name="xak1ujo_job_status", columns={"RUN_NUM", "JOID", "NTRY"})})
 * @ORM\Entity(readOnly=true)
 */
class UjoJobStatus
{
    /**
     * @var integer
     *
     * @ORM\Column(name="APPL_NTRY", type="integer", nullable=true)
     */
    private $applNtry;

    /**
     * @var string
     *
     * @ORM\Column(name="ENTRYNO", type="string", length=15, nullable=true)
     */
    private $entryno;

    /**
     * @var integer
     *
     * @ORM\Column(name="EVT_NUM", type="integer", nullable=true)
     */
    private $evtNum;

    /**
     * @var integer
     *
     * @ORM\Column(name="EXIT_CODE", type="integer", nullable=true)
     */
    private $exitCode;

    /**
     * @var integer
     *
     * @ORM\Column(name="HAS_EXTENDED_INFO", type="smallint", nullable=true)
     */
    private $hasExtendedInfo;

    /**
     * @var string
     *
     * @ORM\Column(name="JC_PID", type="string", length=20, nullable=true)
     */
    private $jcPid;

    /**
     * @var integer
     *
     * @ORM\Column(name="JNO", type="integer", nullable=true)
     */
    private $jno;

    /**
     * @var integer
     *
     * @ORM\Column(name="JOB_VER", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $jobVer;

    /**
     * @var string
     *
     * @ORM\Column(name="JOBSET", type="string", length=65, nullable=true)
     */
    private $jobset;

    /**
     * @var integer
     *
     * @ORM\Column(name="JOID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $joid;

    /**
     * @var integer
     *
     * @ORM\Column(name="LAST_END", type="integer", nullable=true)
     */
    private $lastEnd;

    /**
     * @var integer
     *
     * @ORM\Column(name="LAST_HEARTBEAT", type="integer", nullable=true)
     */
    private $lastHeartbeat;

    /**
     * @var integer
     *
     * @ORM\Column(name="LAST_SCHEDULED_START", type="integer", nullable=true)
     */
    private $lastScheduledStart;

    /**
     * @var integer
     *
     * @ORM\Column(name="LAST_START", type="integer", nullable=true)
     */
    private $lastStart;

    /**
     * @var string
     *
     * @ORM\Column(name="MVSAUTOSERV", type="string", length=20, nullable=true)
     */
    private $mvsautoserv;

    /**
     * @var integer
     *
     * @ORM\Column(name="MVSFLAG", type="integer", nullable=true)
     */
    private $mvsflag;

    /**
     * @var string
     *
     * @ORM\Column(name="MVSJOBNAME", type="string", length=65, nullable=true)
     */
    private $mvsjobname;

    /**
     * @var string
     *
     * @ORM\Column(name="MVSNODE", type="string", length=30, nullable=true)
     */
    private $mvsnode;

    /**
     * @var integer
     *
     * @ORM\Column(name="NEXT_PRIORITY", type="integer", nullable=true)
     */
    private $nextPriority;

    /**
     * @var integer
     *
     * @ORM\Column(name="NEXT_START", type="integer", nullable=true)
     */
    private $nextStart;

    /**
     * @var integer
     *
     * @ORM\Column(name="NTRY", type="integer", nullable=false)
     */
    private $ntry;

    /**
     * @var integer
     *
     * @ORM\Column(name="OVER_NUM", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $overNum;

    /**
     * @var string
     *
     * @ORM\Column(name="PID", type="string", length=20, nullable=true)
     */
    private $pid;

    /**
     * @var string
     *
     * @ORM\Column(name="QUAL", type="string", length=5, nullable=true)
     */
    private $qual;

    /**
     * @var string
     *
     * @ORM\Column(name="QUE_NAME", type="string", length=161, nullable=true)
     */
    private $queName;

    /**
     * @var string
     *
     * @ORM\Column(name="RUN_MACHINE", type="string", length=80, nullable=true)
     */
    private $runMachine;

    /**
     * @var integer
     *
     * @ORM\Column(name="RUN_NUM", type="integer", nullable=false)
     */
    private $runNum;

    /**
     * @var integer
     *
     * @ORM\Column(name="RUN_PRIORITY", type="integer", nullable=true)
     */
    private $runPriority;

    /**
     * @var integer
     *
     * @ORM\Column(name="RUN_WINDOW_END", type="integer", nullable=true)
     */
    private $runWindowEnd;

    /**
     * @var integer
     *
     * @ORM\Column(name="STATUS", type="smallint", nullable=false)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="STATUS_TIME", type="integer", nullable=false)
     */
    private $statusTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIME_OK", type="smallint", nullable=true)
     */
    private $timeOk;

    /**
     * @var integer
     *
     * @ORM\Column(name="WF_JOID", type="integer", nullable=false)
     */
    private $wfJoid;

    /**
     * @var string
     *
     * @ORM\Column(name="MVSPRIMARY", type="string", length=65, nullable=true)
     */
    private $mvsprimary;

    /**
     * @var integer
     *
     * @ORM\Column(name="NEXT_START_STAMP", type="integer", nullable=true)
     */
    private $nextStartStamp;



    /**
     * Set applNtry
     *
     * @param integer $applNtry
     * @return UjoJobStatus
     */
    public function setApplNtry($applNtry)
    {
        $this->applNtry = $applNtry;

        return $this;
    }

    /**
     * Get applNtry
     *
     * @return integer 
     */
    public function getApplNtry()
    {
        return $this->applNtry;
    }

    /**
     * Set entryno
     *
     * @param string $entryno
     * @return UjoJobStatus
     */
    public function setEntryno($entryno)
    {
        $this->entryno = $entryno;

        return $this;
    }

    /**
     * Get entryno
     *
     * @return string 
     */
    public function getEntryno()
    {
        return $this->entryno;
    }

    /**
     * Set evtNum
     *
     * @param integer $evtNum
     * @return UjoJobStatus
     */
    public function setEvtNum($evtNum)
    {
        $this->evtNum = $evtNum;

        return $this;
    }

    /**
     * Get evtNum
     *
     * @return integer 
     */
    public function getEvtNum()
    {
        return $this->evtNum;
    }

    /**
     * Set exitCode
     *
     * @param integer $exitCode
     * @return UjoJobStatus
     */
    public function setExitCode($exitCode)
    {
        $this->exitCode = $exitCode;

        return $this;
    }

    /**
     * Get exitCode
     *
     * @return integer 
     */
    public function getExitCode()
    {
        return $this->exitCode;
    }

    /**
     * Set hasExtendedInfo
     *
     * @param integer $hasExtendedInfo
     * @return UjoJobStatus
     */
    public function setHasExtendedInfo($hasExtendedInfo)
    {
        $this->hasExtendedInfo = $hasExtendedInfo;

        return $this;
    }

    /**
     * Get hasExtendedInfo
     *
     * @return integer 
     */
    public function getHasExtendedInfo()
    {
        return $this->hasExtendedInfo;
    }

    /**
     * Set jcPid
     *
     * @param string $jcPid
     * @return UjoJobStatus
     */
    public function setJcPid($jcPid)
    {
        $this->jcPid = $jcPid;

        return $this;
    }

    /**
     * Get jcPid
     *
     * @return string 
     */
    public function getJcPid()
    {
        return $this->jcPid;
    }

    /**
     * Set jno
     *
     * @param integer $jno
     * @return UjoJobStatus
     */
    public function setJno($jno)
    {
        $this->jno = $jno;

        return $this;
    }

    /**
     * Get jno
     *
     * @return integer 
     */
    public function getJno()
    {
        return $this->jno;
    }

    /**
     * Set jobVer
     *
     * @param integer $jobVer
     * @return UjoJobStatus
     */
    public function setJobVer($jobVer)
    {
        $this->jobVer = $jobVer;

        return $this;
    }

    /**
     * Get jobVer
     *
     * @return integer 
     */
    public function getJobVer()
    {
        return $this->jobVer;
    }

    /**
     * Set jobset
     *
     * @param string $jobset
     * @return UjoJobStatus
     */
    public function setJobset($jobset)
    {
        $this->jobset = $jobset;

        return $this;
    }

    /**
     * Get jobset
     *
     * @return string 
     */
    public function getJobset()
    {
        return $this->jobset;
    }

    /**
     * Set joid
     *
     * @param integer $joid
     * @return UjoJobStatus
     */
    public function setJoid($joid)
    {
        $this->joid = $joid;

        return $this;
    }

    /**
     * Get joid
     *
     * @return integer 
     */
    public function getJoid()
    {
        return $this->joid;
    }

    /**
     * Set lastEnd
     *
     * @param integer $lastEnd
     * @return UjoJobStatus
     */
    public function setLastEnd($lastEnd)
    {
        $this->lastEnd = $lastEnd;

        return $this;
    }

    /**
     * Get lastEnd
     *
     * @return integer 
     */
    public function getLastEnd()
    {
        return $this->lastEnd;
    }

    /**
     * Set lastHeartbeat
     *
     * @param integer $lastHeartbeat
     * @return UjoJobStatus
     */
    public function setLastHeartbeat($lastHeartbeat)
    {
        $this->lastHeartbeat = $lastHeartbeat;

        return $this;
    }

    /**
     * Get lastHeartbeat
     *
     * @return integer 
     */
    public function getLastHeartbeat()
    {
        return $this->lastHeartbeat;
    }

    /**
     * Set lastScheduledStart
     *
     * @param integer $lastScheduledStart
     * @return UjoJobStatus
     */
    public function setLastScheduledStart($lastScheduledStart)
    {
        $this->lastScheduledStart = $lastScheduledStart;

        return $this;
    }

    /**
     * Get lastScheduledStart
     *
     * @return integer 
     */
    public function getLastScheduledStart()
    {
        return $this->lastScheduledStart;
    }

    /**
     * Set lastStart
     *
     * @param integer $lastStart
     * @return UjoJobStatus
     */
    public function setLastStart($lastStart)
    {
        $this->lastStart = $lastStart;

        return $this;
    }

    /**
     * Get lastStart
     *
     * @return integer 
     */
    public function getLastStart()
    {
        return $this->lastStart;
    }

    /**
     * Set mvsautoserv
     *
     * @param string $mvsautoserv
     * @return UjoJobStatus
     */
    public function setMvsautoserv($mvsautoserv)
    {
        $this->mvsautoserv = $mvsautoserv;

        return $this;
    }

    /**
     * Get mvsautoserv
     *
     * @return string 
     */
    public function getMvsautoserv()
    {
        return $this->mvsautoserv;
    }

    /**
     * Set mvsflag
     *
     * @param integer $mvsflag
     * @return UjoJobStatus
     */
    public function setMvsflag($mvsflag)
    {
        $this->mvsflag = $mvsflag;

        return $this;
    }

    /**
     * Get mvsflag
     *
     * @return integer 
     */
    public function getMvsflag()
    {
        return $this->mvsflag;
    }

    /**
     * Set mvsjobname
     *
     * @param string $mvsjobname
     * @return UjoJobStatus
     */
    public function setMvsjobname($mvsjobname)
    {
        $this->mvsjobname = $mvsjobname;

        return $this;
    }

    /**
     * Get mvsjobname
     *
     * @return string 
     */
    public function getMvsjobname()
    {
        return $this->mvsjobname;
    }

    /**
     * Set mvsnode
     *
     * @param string $mvsnode
     * @return UjoJobStatus
     */
    public function setMvsnode($mvsnode)
    {
        $this->mvsnode = $mvsnode;

        return $this;
    }

    /**
     * Get mvsnode
     *
     * @return string 
     */
    public function getMvsnode()
    {
        return $this->mvsnode;
    }

    /**
     * Set nextPriority
     *
     * @param integer $nextPriority
     * @return UjoJobStatus
     */
    public function setNextPriority($nextPriority)
    {
        $this->nextPriority = $nextPriority;

        return $this;
    }

    /**
     * Get nextPriority
     *
     * @return integer 
     */
    public function getNextPriority()
    {
        return $this->nextPriority;
    }

    /**
     * Set nextStart
     *
     * @param integer $nextStart
     * @return UjoJobStatus
     */
    public function setNextStart($nextStart)
    {
        $this->nextStart = $nextStart;

        return $this;
    }

    /**
     * Get nextStart
     *
     * @return integer 
     */
    public function getNextStart()
    {
        return $this->nextStart;
    }

    /**
     * Set ntry
     *
     * @param integer $ntry
     * @return UjoJobStatus
     */
    public function setNtry($ntry)
    {
        $this->ntry = $ntry;

        return $this;
    }

    /**
     * Get ntry
     *
     * @return integer 
     */
    public function getNtry()
    {
        return $this->ntry;
    }

    /**
     * Set overNum
     *
     * @param integer $overNum
     * @return UjoJobStatus
     */
    public function setOverNum($overNum)
    {
        $this->overNum = $overNum;

        return $this;
    }

    /**
     * Get overNum
     *
     * @return integer 
     */
    public function getOverNum()
    {
        return $this->overNum;
    }

    /**
     * Set pid
     *
     * @param string $pid
     * @return UjoJobStatus
     */
    public function setPid($pid)
    {
        $this->pid = $pid;

        return $this;
    }

    /**
     * Get pid
     *
     * @return string 
     */
    public function getPid()
    {
        return $this->pid;
    }

    /**
     * Set qual
     *
     * @param string $qual
     * @return UjoJobStatus
     */
    public function setQual($qual)
    {
        $this->qual = $qual;

        return $this;
    }

    /**
     * Get qual
     *
     * @return string 
     */
    public function getQual()
    {
        return $this->qual;
    }

    /**
     * Set queName
     *
     * @param string $queName
     * @return UjoJobStatus
     */
    public function setQueName($queName)
    {
        $this->queName = $queName;

        return $this;
    }

    /**
     * Get queName
     *
     * @return string 
     */
    public function getQueName()
    {
        return $this->queName;
    }

    /**
     * Set runMachine
     *
     * @param string $runMachine
     * @return UjoJobStatus
     */
    public function setRunMachine($runMachine)
    {
        $this->runMachine = $runMachine;

        return $this;
    }

    /**
     * Get runMachine
     *
     * @return string 
     */
    public function getRunMachine()
    {
        return $this->runMachine;
    }

    /**
     * Set runNum
     *
     * @param integer $runNum
     * @return UjoJobStatus
     */
    public function setRunNum($runNum)
    {
        $this->runNum = $runNum;

        return $this;
    }

    /**
     * Get runNum
     *
     * @return integer 
     */
    public function getRunNum()
    {
        return $this->runNum;
    }

    /**
     * Set runPriority
     *
     * @param integer $runPriority
     * @return UjoJobStatus
     */
    public function setRunPriority($runPriority)
    {
        $this->runPriority = $runPriority;

        return $this;
    }

    /**
     * Get runPriority
     *
     * @return integer 
     */
    public function getRunPriority()
    {
        return $this->runPriority;
    }

    /**
     * Set runWindowEnd
     *
     * @param integer $runWindowEnd
     * @return UjoJobStatus
     */
    public function setRunWindowEnd($runWindowEnd)
    {
        $this->runWindowEnd = $runWindowEnd;

        return $this;
    }

    /**
     * Get runWindowEnd
     *
     * @return integer 
     */
    public function getRunWindowEnd()
    {
        return $this->runWindowEnd;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return UjoJobStatus
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set statusTime
     *
     * @param integer $statusTime
     * @return UjoJobStatus
     */
    public function setStatusTime($statusTime)
    {
        $this->statusTime = $statusTime;

        return $this;
    }

    /**
     * Get statusTime
     *
     * @return integer 
     */
    public function getStatusTime()
    {
        return $this->statusTime;
    }

    /**
     * Set timeOk
     *
     * @param integer $timeOk
     * @return UjoJobStatus
     */
    public function setTimeOk($timeOk)
    {
        $this->timeOk = $timeOk;

        return $this;
    }

    /**
     * Get timeOk
     *
     * @return integer 
     */
    public function getTimeOk()
    {
        return $this->timeOk;
    }

    /**
     * Set wfJoid
     *
     * @param integer $wfJoid
     * @return UjoJobStatus
     */
    public function setWfJoid($wfJoid)
    {
        $this->wfJoid = $wfJoid;

        return $this;
    }

    /**
     * Get wfJoid
     *
     * @return integer 
     */
    public function getWfJoid()
    {
        return $this->wfJoid;
    }

    /**
     * Set mvsprimary
     *
     * @param string $mvsprimary
     * @return UjoJobStatus
     */
    public function setMvsprimary($mvsprimary)
    {
        $this->mvsprimary = $mvsprimary;

        return $this;
    }

    /**
     * Get mvsprimary
     *
     * @return string 
     */
    public function getMvsprimary()
    {
        return $this->mvsprimary;
    }

    /**
     * Set nextStartStamp
     *
     * @param integer $nextStartStamp
     * @return UjoJobStatus
     */
    public function setNextStartStamp($nextStartStamp)
    {
        $this->nextStartStamp = $nextStartStamp;

        return $this;
    }

    /**
     * Get nextStartStamp
     *
     * @return integer 
     */
    public function getNextStartStamp()
    {
        return $this->nextStartStamp;
    }
}
