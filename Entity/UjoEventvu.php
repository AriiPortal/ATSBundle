<?php

namespace Arii\ATSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UjoEventvu
 *
 * @ORM\Table(name="UJO_EVENTVU")
 * @ORM\Entity(readOnly=true)
 */
class UjoEventvu
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
     * @var string
     *
     * @ORM\Column(name="BOX_NAME", type="string", length=64, nullable=true)
     */
    private $boxName;

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
     * @ORM\Column(name="GLOBAL_VALUE", type="string", length=255, nullable=true)
     */
    private $globalValue;

    /**
     * @var string
     *
     * @ORM\Column(name="JOB_NAME", type="string", length=64, nullable=true)
     */
    private $jobName;

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
     * @var integer
     *
     * @ORM\Column(name="NTRY", type="integer", nullable=true)
     */
    private $ntry;

    /**
     * @var integer
     *
     * @ORM\Column(name="OVER_NUM", type="integer", nullable=true)
     */
    private $overNum;

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
     * @var string
     *
     * @ORM\Column(name="EVENTTXT", type="string", length=255, nullable=false)
     */
    private $eventtxt;

    /**
     * @var string
     *
     * @ORM\Column(name="STATUSTXT", type="string", length=255, nullable=false)
     */
    private $statustxt;

    /**
     * @var string
     *
     * @ORM\Column(name="ALARMTXT", type="string", length=255, nullable=false)
     */
    private $alarmtxt;
    

    /**
     * Set alarm
     *
     * @param integer $alarm
     * @return UjoEventvu
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
     * @return UjoEventvu
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
     * Set boxName
     *
     * @param string $boxName
     * @return UjoEventvu
     */
    public function setBoxName($boxName)
    {
        $this->boxName = $boxName;

        return $this;
    }

    /**
     * Get boxName
     *
     * @return string 
     */
    public function getBoxName()
    {
        return $this->boxName;
    }

    /**
     * Set eoid
     *
     * @param string $eoid
     * @return UjoEventvu
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
     * @return UjoEventvu
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
     * @return UjoEventvu
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
     * @return UjoEventvu
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
     * @return UjoEventvu
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
     * Set globalValue
     *
     * @param string $globalValue
     * @return UjoEventvu
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
     * Set jobName
     *
     * @param string $jobName
     * @return UjoEventvu
     */
    public function setJobName($jobName)
    {
        $this->jobName = $jobName;

        return $this;
    }

    /**
     * Get jobName
     *
     * @return string 
     */
    public function getJobName()
    {
        return $this->jobName;
    }

    /**
     * Set jobVer
     *
     * @param integer $jobVer
     * @return UjoEventvu
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
     * @return UjoEventvu
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
     * Set ntry
     *
     * @param integer $ntry
     * @return UjoEventvu
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
     * @return UjoEventvu
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
     * Set queStatus
     *
     * @param integer $queStatus
     * @return UjoEventvu
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
     * @return UjoEventvu
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
     * @return UjoEventvu
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
     * @return UjoEventvu
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
     * @return UjoEventvu
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
     * @return UjoEventvu
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
     * @return UjoEventvu
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
     * Set eventtxt
     *
     * @param string $eventtxt
     * @return UjoEventvu
     */
    public function setEventtxt($eventtxt)
    {
        $this->eventtxt = $eventtxt;

        return $this;
    }

    /**
     * Get eventtxt
     *
     * @return string 
     */
    public function getEventtxt()
    {
        return $this->eventtxt;
    }

    /**
     * Set statustxt
     *
     * @param string $statustxt
     * @return UjoEventvu
     */
    public function setStatustxt($statustxt)
    {
        $this->statustxt = $statustxt;

        return $this;
    }

    /**
     * Get statustxt
     *
     * @return string 
     */
    public function getStatustxt()
    {
        return $this->statustxt;
    }

    /**
     * Set alarmtxt
     *
     * @param string $alarmtxt
     * @return UjoEventvu
     */
    public function setAlarmtxt($alarmtxt)
    {
        $this->alarmtxt = $alarmtxt;

        return $this;
    }

    /**
     * Get alarmtxt
     *
     * @return string 
     */
    public function getAlarmtxt()
    {
        return $this->alarmtxt;
    }
}
