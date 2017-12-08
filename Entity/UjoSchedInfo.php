<?php

namespace Arii\ATSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UjoSchedInfo
 *
 * @ORM\Table(name="UJO_SCHED_INFO")
 * @ORM\Entity(readOnly=true)
 */
class UjoSchedInfo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ALARM_IF_FAIL", type="smallint", nullable=true)
     */
    private $alarmIfFail;

    /**
     * @var string
     *
     * @ORM\Column(name="ALERT", type="string", length=32, nullable=true)
     */
    private $alert;

    /**
     * @var integer
     *
     * @ORM\Column(name="AUTO_DELETE", type="integer", nullable=true)
     */
    private $autoDelete;

    /**
     * @var integer
     *
     * @ORM\Column(name="AUTO_HOLD", type="smallint", nullable=true)
     */
    private $autoHold;

    /**
     * @var integer
     *
     * @ORM\Column(name="CONTINUOUS", type="smallint", nullable=true)
     */
    private $continuous;

    /**
     * @var string
     *
     * @ORM\Column(name="CONTINUOUS_ALERT", type="string", length=32, nullable=true)
     */
    private $continuousAlert;

    /**
     * @var integer
     *
     * @ORM\Column(name="DATE_CONDITIONS", type="smallint", nullable=true)
     */
    private $dateConditions;

    /**
     * @var string
     *
     * @ORM\Column(name="DAYS_OF_WEEK", type="string", length=80, nullable=true)
     */
    private $daysOfWeek;

    /**
     * @var integer
     *
     * @ORM\Column(name="ENVVARS", type="integer", nullable=true)
     */
    private $envvars;

    /**
     * @var string
     *
     * @ORM\Column(name="EXCLUDE_CALENDAR", type="string", length=64, nullable=true)
     */
    private $excludeCalendar;

    /**
     * @var integer
     *
     * @ORM\Column(name="EXEC_TIME", type="integer", nullable=true)
     */
    private $execTime;

    /**
     * @var string
     *
     * @ORM\Column(name="FAIL_CODES", type="string", length=256, nullable=true)
     */
    private $failCodes;

    /**
     * @var integer
     *
     * @ORM\Column(name="JOB_LOAD", type="integer", nullable=true)
     */
    private $jobLoad;

    /**
     * @var integer
     *
     * @ORM\Column(name="JOB_VER", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $jobVer;

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
     * @ORM\Column(name="MAX_RUN_ALARM", type="integer", nullable=true)
     */
    private $maxRunAlarm;

    /**
     * @var integer
     *
     * @ORM\Column(name="MIN_RUN_ALARM", type="integer", nullable=true)
     */
    private $minRunAlarm;

    /**
     * @var integer
     *
     * @ORM\Column(name="MODE_TYPE", type="smallint", nullable=true)
     */
    private $modeType;

    /**
     * @var string
     *
     * @ORM\Column(name="MUST_COMPLETE", type="string", length=255, nullable=true)
     */
    private $mustComplete;

    /**
     * @var string
     *
     * @ORM\Column(name="MUST_START", type="string", length=255, nullable=true)
     */
    private $mustStart;

    /**
     * @var integer
     *
     * @ORM\Column(name="OVER_NUM", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $overNum;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRIORITY", type="integer", nullable=true)
     */
    private $priority;

    /**
     * @var string
     *
     * @ORM\Column(name="RUN_CALENDAR", type="string", length=64, nullable=true)
     */
    private $runCalendar;

    /**
     * @var string
     *
     * @ORM\Column(name="RUN_WINDOW", type="string", length=20, nullable=true)
     */
    private $runWindow;

    /**
     * @var string
     *
     * @ORM\Column(name="START_MINS", type="string", length=255, nullable=true)
     */
    private $startMins;

    /**
     * @var string
     *
     * @ORM\Column(name="START_TIMES", type="string", length=255, nullable=true)
     */
    private $startTimes;

    /**
     * @var string
     *
     * @ORM\Column(name="SUCCESS_CODES", type="string", length=256, nullable=true)
     */
    private $successCodes;

    /**
     * @var integer
     *
     * @ORM\Column(name="TERM_RUN_TIME", type="integer", nullable=true)
     */
    private $termRunTime;

    /**
     * @var string
     *
     * @ORM\Column(name="TIMEZONE", type="string", length=50, nullable=true)
     */
    private $timezone;



    /**
     * Set alarmIfFail
     *
     * @param integer $alarmIfFail
     * @return UjoSchedInfo
     */
    public function setAlarmIfFail($alarmIfFail)
    {
        $this->alarmIfFail = $alarmIfFail;

        return $this;
    }

    /**
     * Get alarmIfFail
     *
     * @return integer 
     */
    public function getAlarmIfFail()
    {
        return $this->alarmIfFail;
    }

    /**
     * Set alert
     *
     * @param string $alert
     * @return UjoSchedInfo
     */
    public function setAlert($alert)
    {
        $this->alert = $alert;

        return $this;
    }

    /**
     * Get alert
     *
     * @return string 
     */
    public function getAlert()
    {
        return $this->alert;
    }

    /**
     * Set autoDelete
     *
     * @param integer $autoDelete
     * @return UjoSchedInfo
     */
    public function setAutoDelete($autoDelete)
    {
        $this->autoDelete = $autoDelete;

        return $this;
    }

    /**
     * Get autoDelete
     *
     * @return integer 
     */
    public function getAutoDelete()
    {
        return $this->autoDelete;
    }

    /**
     * Set autoHold
     *
     * @param integer $autoHold
     * @return UjoSchedInfo
     */
    public function setAutoHold($autoHold)
    {
        $this->autoHold = $autoHold;

        return $this;
    }

    /**
     * Get autoHold
     *
     * @return integer 
     */
    public function getAutoHold()
    {
        return $this->autoHold;
    }

    /**
     * Set continuous
     *
     * @param integer $continuous
     * @return UjoSchedInfo
     */
    public function setContinuous($continuous)
    {
        $this->continuous = $continuous;

        return $this;
    }

    /**
     * Get continuous
     *
     * @return integer 
     */
    public function getContinuous()
    {
        return $this->continuous;
    }

    /**
     * Set continuousAlert
     *
     * @param string $continuousAlert
     * @return UjoSchedInfo
     */
    public function setContinuousAlert($continuousAlert)
    {
        $this->continuousAlert = $continuousAlert;

        return $this;
    }

    /**
     * Get continuousAlert
     *
     * @return string 
     */
    public function getContinuousAlert()
    {
        return $this->continuousAlert;
    }

    /**
     * Set dateConditions
     *
     * @param integer $dateConditions
     * @return UjoSchedInfo
     */
    public function setDateConditions($dateConditions)
    {
        $this->dateConditions = $dateConditions;

        return $this;
    }

    /**
     * Get dateConditions
     *
     * @return integer 
     */
    public function getDateConditions()
    {
        return $this->dateConditions;
    }

    /**
     * Set daysOfWeek
     *
     * @param string $daysOfWeek
     * @return UjoSchedInfo
     */
    public function setDaysOfWeek($daysOfWeek)
    {
        $this->daysOfWeek = $daysOfWeek;

        return $this;
    }

    /**
     * Get daysOfWeek
     *
     * @return string 
     */
    public function getDaysOfWeek()
    {
        return $this->daysOfWeek;
    }

    /**
     * Set envvars
     *
     * @param integer $envvars
     * @return UjoSchedInfo
     */
    public function setEnvvars($envvars)
    {
        $this->envvars = $envvars;

        return $this;
    }

    /**
     * Get envvars
     *
     * @return integer 
     */
    public function getEnvvars()
    {
        return $this->envvars;
    }

    /**
     * Set excludeCalendar
     *
     * @param string $excludeCalendar
     * @return UjoSchedInfo
     */
    public function setExcludeCalendar($excludeCalendar)
    {
        $this->excludeCalendar = $excludeCalendar;

        return $this;
    }

    /**
     * Get excludeCalendar
     *
     * @return string 
     */
    public function getExcludeCalendar()
    {
        return $this->excludeCalendar;
    }

    /**
     * Set execTime
     *
     * @param integer $execTime
     * @return UjoSchedInfo
     */
    public function setExecTime($execTime)
    {
        $this->execTime = $execTime;

        return $this;
    }

    /**
     * Get execTime
     *
     * @return integer 
     */
    public function getExecTime()
    {
        return $this->execTime;
    }

    /**
     * Set failCodes
     *
     * @param string $failCodes
     * @return UjoSchedInfo
     */
    public function setFailCodes($failCodes)
    {
        $this->failCodes = $failCodes;

        return $this;
    }

    /**
     * Get failCodes
     *
     * @return string 
     */
    public function getFailCodes()
    {
        return $this->failCodes;
    }

    /**
     * Set jobLoad
     *
     * @param integer $jobLoad
     * @return UjoSchedInfo
     */
    public function setJobLoad($jobLoad)
    {
        $this->jobLoad = $jobLoad;

        return $this;
    }

    /**
     * Get jobLoad
     *
     * @return integer 
     */
    public function getJobLoad()
    {
        return $this->jobLoad;
    }

    /**
     * Set jobVer
     *
     * @param integer $jobVer
     * @return UjoSchedInfo
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
     * @return UjoSchedInfo
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
     * Set maxRunAlarm
     *
     * @param integer $maxRunAlarm
     * @return UjoSchedInfo
     */
    public function setMaxRunAlarm($maxRunAlarm)
    {
        $this->maxRunAlarm = $maxRunAlarm;

        return $this;
    }

    /**
     * Get maxRunAlarm
     *
     * @return integer 
     */
    public function getMaxRunAlarm()
    {
        return $this->maxRunAlarm;
    }

    /**
     * Set minRunAlarm
     *
     * @param integer $minRunAlarm
     * @return UjoSchedInfo
     */
    public function setMinRunAlarm($minRunAlarm)
    {
        $this->minRunAlarm = $minRunAlarm;

        return $this;
    }

    /**
     * Get minRunAlarm
     *
     * @return integer 
     */
    public function getMinRunAlarm()
    {
        return $this->minRunAlarm;
    }

    /**
     * Set modeType
     *
     * @param integer $modeType
     * @return UjoSchedInfo
     */
    public function setModeType($modeType)
    {
        $this->modeType = $modeType;

        return $this;
    }

    /**
     * Get modeType
     *
     * @return integer 
     */
    public function getModeType()
    {
        return $this->modeType;
    }

    /**
     * Set mustComplete
     *
     * @param string $mustComplete
     * @return UjoSchedInfo
     */
    public function setMustComplete($mustComplete)
    {
        $this->mustComplete = $mustComplete;

        return $this;
    }

    /**
     * Get mustComplete
     *
     * @return string 
     */
    public function getMustComplete()
    {
        return $this->mustComplete;
    }

    /**
     * Set mustStart
     *
     * @param string $mustStart
     * @return UjoSchedInfo
     */
    public function setMustStart($mustStart)
    {
        $this->mustStart = $mustStart;

        return $this;
    }

    /**
     * Get mustStart
     *
     * @return string 
     */
    public function getMustStart()
    {
        return $this->mustStart;
    }

    /**
     * Set overNum
     *
     * @param integer $overNum
     * @return UjoSchedInfo
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
     * Set priority
     *
     * @param integer $priority
     * @return UjoSchedInfo
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
     * Set runCalendar
     *
     * @param string $runCalendar
     * @return UjoSchedInfo
     */
    public function setRunCalendar($runCalendar)
    {
        $this->runCalendar = $runCalendar;

        return $this;
    }

    /**
     * Get runCalendar
     *
     * @return string 
     */
    public function getRunCalendar()
    {
        return $this->runCalendar;
    }

    /**
     * Set runWindow
     *
     * @param string $runWindow
     * @return UjoSchedInfo
     */
    public function setRunWindow($runWindow)
    {
        $this->runWindow = $runWindow;

        return $this;
    }

    /**
     * Get runWindow
     *
     * @return string 
     */
    public function getRunWindow()
    {
        return $this->runWindow;
    }

    /**
     * Set startMins
     *
     * @param string $startMins
     * @return UjoSchedInfo
     */
    public function setStartMins($startMins)
    {
        $this->startMins = $startMins;

        return $this;
    }

    /**
     * Get startMins
     *
     * @return string 
     */
    public function getStartMins()
    {
        return $this->startMins;
    }

    /**
     * Set startTimes
     *
     * @param string $startTimes
     * @return UjoSchedInfo
     */
    public function setStartTimes($startTimes)
    {
        $this->startTimes = $startTimes;

        return $this;
    }

    /**
     * Get startTimes
     *
     * @return string 
     */
    public function getStartTimes()
    {
        return $this->startTimes;
    }

    /**
     * Set successCodes
     *
     * @param string $successCodes
     * @return UjoSchedInfo
     */
    public function setSuccessCodes($successCodes)
    {
        $this->successCodes = $successCodes;

        return $this;
    }

    /**
     * Get successCodes
     *
     * @return string 
     */
    public function getSuccessCodes()
    {
        return $this->successCodes;
    }

    /**
     * Set termRunTime
     *
     * @param integer $termRunTime
     * @return UjoSchedInfo
     */
    public function setTermRunTime($termRunTime)
    {
        $this->termRunTime = $termRunTime;

        return $this;
    }

    /**
     * Get termRunTime
     *
     * @return integer 
     */
    public function getTermRunTime()
    {
        return $this->termRunTime;
    }

    /**
     * Set timezone
     *
     * @param string $timezone
     * @return UjoSchedInfo
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * Get timezone
     *
     * @return string 
     */
    public function getTimezone()
    {
        return $this->timezone;
    }
}
