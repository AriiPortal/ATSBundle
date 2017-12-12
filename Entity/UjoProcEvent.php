<?php

namespace Arii\ATSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UjoProcEvent
 *
 * @ORM\Table(name="UJO_PROC_EVENT", uniqueConstraints={@ORM\UniqueConstraint(name="xpkujo_proc_event", columns={"EOID"})}, indexes={@ORM\Index(name="xak1ujo_proc_event", columns={"EVENT_TIME_GMT"}), @ORM\Index(name="xak2ujo_proc_event", columns={"EVENT", "STATUS", "JOID", "RUN_NUM", "NTRY"}), @ORM\Index(name="xak5ujo_proc_event", columns={"QUE_STATUS_STAMP", "EVT_NUM"}), @ORM\Index(name="xak4ujo_proc_event", columns={"JOID", "RUN_NUM", "EVENT_TIME_GMT"}), @ORM\Index(name="xak6ujo_proc_event", columns={"JOID", "AUTOSERV", "EVENT_TIME_GMT"})})
 * @ORM\Entity(readOnly=true)
 */
class UjoProcEvent
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ALARM", type="integer", nullable=true)
     */
    private $alarm;

    /**
     * @var string
     *
     * @ORM\Column(name="AUTOSERV", type="string", length=30, nullable=true)
     */
    private $autoserv;

    /**
     * @var integer
     *
     * @ORM\Column(name="BOX_JOID", type="integer", nullable=true)
     */
    private $boxJoid;

    /**
     * @var string
     *
     * @ORM\Column(name="EOID", type="string", length=12, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $eoid;

    /**
     * @var integer
     *
     * @ORM\Column(name="EVENT", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $event;

    /**
     * @var integer
     *
     * @ORM\Column(name="EVENT_TIME_GMT", type="integer", nullable=true)
     */
    private $eventTimeGmt;

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
     * @var string
     *
     * @ORM\Column(name="GLOBAL_NAME", type="string", length=64, nullable=true)
     */
    private $globalName;

    /**
     * @var string
     *
     * @ORM\Column(name="GLOBAL_VALUE", type="string", length=255, nullable=true)
     */
    private $globalValue;

    /**
     * @var string
     *
     * @ORM\Column(name="JC_PID", type="string", length=20, nullable=true)
     */
    private $jcPid;

    /**
     * @var integer
     *
     * @ORM\Column(name="JOB_VER", type="integer", nullable=true)
     */
    private $jobVer;

    /**
     * @var integer
     *
     * @ORM\Column(name="JOID", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $joid;

    /**
     * @var string
     *
     * @ORM\Column(name="MACH_NAME", type="string", length=80, nullable=true)
     */
    private $machName;

    /**
     * @var integer
     *
     * @ORM\Column(name="NTRY", type="integer", nullable=true)
     */
    private $ntry;

    /**
     * @var integer
     *
     * @ORM\Column(name="ORIG_EVT_NUM", type="integer", nullable=true)
     */
    private $origEvtNum;

    /**
     * @var integer
     *
     * @ORM\Column(name="OVER_NUM", type="integer", nullable=true)
     */
    private $overNum;

    /**
     * @var string
     *
     * @ORM\Column(name="PID", type="string", length=20, nullable=true)
     */
    private $pid;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRIORITY", type="integer", nullable=true)
     */
    private $priority;

    /**
     * @var integer
     *
     * @ORM\Column(name="QUE_PRIORITY", type="integer", nullable=true)
     */
    private $quePriority;

    /**
     * @var integer
     *
     * @ORM\Column(name="QUE_STATUS", type="integer", nullable=false)
     */
    private $queStatus;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="QUE_STATUS_STAMP", type="datetime", nullable=false)
     */
    private $queStatusStamp;

    /**
     * @var integer
     *
     * @ORM\Column(name="RUN_NUM", type="integer", nullable=true)
     */
    private $runNum;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="STAMP", type="datetime", nullable=true)
     */
    private $stamp;

    /**
     * @var integer
     *
     * @ORM\Column(name="STATUS", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="TEXT", type="string", length=255, nullable=true)
     */
    private $text;

    /**
     * @var integer
     *
     * @ORM\Column(name="WF_JOID", type="integer", nullable=true)
     */
    private $wfJoid;


    /**
     * Set alarm
     *
     * @param integer $alarm
     * @return UjoProcEvent
     */
    public function setAlarm($alarm)
    {
        $this->alarm = $alarm;

        return $this;
    }

    /**
     * Get alarm
     *
     * @return integer 
     */
    public function getAlarm()
    {
        return $this->alarm;
    }

    /**
     * Set autoserv
     *
     * @param string $autoserv
     * @return UjoProcEvent
     */
    public function setAutoserv($autoserv)
    {
        $this->autoserv = $autoserv;

        return $this;
    }

    /**
     * Get autoserv
     *
     * @return string 
     */
    public function getAutoserv()
    {
        return $this->autoserv;
    }

    /**
     * Set boxJoid
     *
     * @param integer $boxJoid
     * @return UjoProcEvent
     */
    public function setBoxJoid($boxJoid)
    {
        $this->boxJoid = $boxJoid;

        return $this;
    }

    /**
     * Get boxJoid
     *
     * @return integer 
     */
    public function getBoxJoid()
    {
        return $this->boxJoid;
    }

    /**
     * Set eoid
     *
     * @param string $eoid
     * @return UjoProcEvent
     */
    public function setEoid($eoid)
    {
        $this->eoid = $eoid;

        return $this;
    }

    /**
     * Get eoid
     *
     * @return string 
     */
    public function getEoid()
    {
        return $this->eoid;
    }

    /**
     * Set event
     *
     * @param integer $event
     * @return UjoProcEvent
     */
    public function setEvent($event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return integer 
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set eventTimeGmt
     *
     * @param integer $eventTimeGmt
     * @return UjoProcEvent
     */
    public function setEventTimeGmt($eventTimeGmt)
    {
        $this->eventTimeGmt = $eventTimeGmt;

        return $this;
    }

    /**
     * Get eventTimeGmt
     *
     * @return integer 
     */
    public function getEventTimeGmt()
    {
        return $this->eventTimeGmt;
    }

    /**
     * Set evtNum
     *
     * @param integer $evtNum
     * @return UjoProcEvent
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
     * @return UjoProcEvent
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
     * Set globalName
     *
     * @param string $globalName
     * @return UjoProcEvent
     */
    public function setGlobalName($globalName)
    {
        $this->globalName = $globalName;

        return $this;
    }

    /**
     * Get globalName
     *
     * @return string 
     */
    public function getGlobalName()
    {
        return $this->globalName;
    }

    /**
     * Set globalValue
     *
     * @param string $globalValue
     * @return UjoProcEvent
     */
    public function setGlobalValue($globalValue)
    {
        $this->globalValue = $globalValue;

        return $this;
    }

    /**
     * Get globalValue
     *
     * @return string 
     */
    public function getGlobalValue()
    {
        return $this->globalValue;
    }

    /**
     * Set jcPid
     *
     * @param string $jcPid
     * @return UjoProcEvent
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
     * Set jobVer
     *
     * @param integer $jobVer
     * @return UjoProcEvent
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
     * Set joid
     *
     * @param integer $joid
     * @return UjoProcEvent
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
     * Set machName
     *
     * @param string $machName
     * @return UjoProcEvent
     */
    public function setMachName($machName)
    {
        $this->machName = $machName;

        return $this;
    }

    /**
     * Get machName
     *
     * @return string 
     */
    public function getMachName()
    {
        return $this->machName;
    }

    /**
     * Set ntry
     *
     * @param integer $ntry
     * @return UjoProcEvent
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
     * Set origEvtNum
     *
     * @param integer $origEvtNum
     * @return UjoProcEvent
     */
    public function setOrigEvtNum($origEvtNum)
    {
        $this->origEvtNum = $origEvtNum;

        return $this;
    }

    /**
     * Get origEvtNum
     *
     * @return integer 
     */
    public function getOrigEvtNum()
    {
        return $this->origEvtNum;
    }

    /**
     * Set overNum
     *
     * @param integer $overNum
     * @return UjoProcEvent
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
     * @return UjoProcEvent
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
     * Set priority
     *
     * @param integer $priority
     * @return UjoProcEvent
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set quePriority
     *
     * @param integer $quePriority
     * @return UjoProcEvent
     */
    public function setQuePriority($quePriority)
    {
        $this->quePriority = $quePriority;

        return $this;
    }

    /**
     * Get quePriority
     *
     * @return integer 
     */
    public function getQuePriority()
    {
        return $this->quePriority;
    }

    /**
     * Set queStatus
     *
     * @param integer $queStatus
     * @return UjoProcEvent
     */
    public function setQueStatus($queStatus)
    {
        $this->queStatus = $queStatus;

        return $this;
    }

    /**
     * Get queStatus
     *
     * @return integer 
     */
    public function getQueStatus()
    {
        return $this->queStatus;
    }

    /**
     * Set queStatusStamp
     *
     * @param \DateTime $queStatusStamp
     * @return UjoProcEvent
     */
    public function setQueStatusStamp($queStatusStamp)
    {
        $this->queStatusStamp = $queStatusStamp;

        return $this;
    }

    /**
     * Get queStatusStamp
     *
     * @return \DateTime 
     */
    public function getQueStatusStamp()
    {
        return $this->queStatusStamp;
    }

    /**
     * Set runNum
     *
     * @param integer $runNum
     * @return UjoProcEvent
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
     * Set stamp
     *
     * @param \DateTime $stamp
     * @return UjoProcEvent
     */
    public function setStamp($stamp)
    {
        $this->stamp = $stamp;

        return $this;
    }

    /**
     * Get stamp
     *
     * @return \DateTime 
     */
    public function getStamp()
    {
        return $this->stamp;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return UjoProcEvent
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
     * Set text
     *
     * @param string $text
     * @return UjoProcEvent
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set wfJoid
     *
     * @param integer $wfJoid
     * @return UjoProcEvent
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
}
