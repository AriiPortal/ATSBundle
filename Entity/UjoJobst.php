<?php

namespace Arii\ATSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UjoJobst
 *
 * @ORM\Table(name="UJO_JOBST")
 * @ORM\Entity(readOnly=true)
 */
class UjoJobst
{

    /**
     * @var integer
     *
     * @ORM\Column(name="JOID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $joid;

    /**
     * @var string
     *
     * @ORM\Column(name="JOB_NAME", type="string", length=64, nullable=false)
     */
    private $jobName;

    /**
     * @var integer
     *
     * @ORM\Column(name="JOB_TYPE", type="integer", nullable=false)
     */
    private $jobType;

    /**
     * @var integer
     *
     * @ORM\Column(name="BOX_JOID", type="integer", nullable=true)
     */
    private $boxJoid;

    /**
     * @var string
     *
     * @ORM\Column(name="OWNER", type="string", length=145, nullable=true)
     */
    private $owner;

    /**
     * @var string
     *
     * @ORM\Column(name="PERMISSION", type="string", length=30, nullable=true)
     */
    private $permission;
	
    /**
     * @var integer
     *
     * @ORM\Column(name="N_RETRYS", type="integer", nullable=true)
     */
    private $nRetrys;

    /**
     * @var integer
     *
     * @ORM\Column(name="AUTO_HOLD", type="smallint", nullable=true)
     */
    private $autoHold;
	
    /**
     * @var string
     *
     * @ORM\Column(name="COMMAND", type="text", nullable=true)
     */
    private $command;

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
     * @var string
     *
     * @ORM\Column(name="RUN_CALENDAR", type="string", length=64, nullable=true)
     */
    private $runCalendar;

    /**
     * @var string
     *
     * @ORM\Column(name="EXCLUDE_CALENDAR", type="string", length=64, nullable=true)
     */
    private $excludeCalendar;

    /**
     * @var string
     *
     * @ORM\Column(name="START_TIMES", type="string", length=255, nullable=true)
     */
    private $startTimes;

    /**
     * @var string
     *
     * @ORM\Column(name="START_MINS", type="string", length=255, nullable=true)
     */
    private $startMins;

    /**
     * @var string
     *
     * @ORM\Column(name="RUN_WINDOW", type="string", length=20, nullable=true)
     */
    private $runWindow;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPTION", type="string", length=500, nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="TERM_RUN_TIME", type="integer", nullable=true)
     */
    private $termRunTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="BOX_TERMINATOR", type="smallint", nullable=true)
     */
    private $boxTerminator;
	
    /**
     * @var string
     *
     * @ORM\Column(name="BOX_NAME", type="string", length=64, nullable=false)
     */
    private $boxName;	

    /**
     * @var integer
     *
     * @ORM\Column(name="HAS_NOTIFICATION", type="smallint", nullable=true)
     */
    private $hasNotification;

    /**
     * @var integer
     *
     * @ORM\Column(name="IS_CURRVER", type="smallint", nullable=false)
     */
    private $isCurrver;

    /**
     * @var string
     *
     * @ORM\Column(name="TIMEZONE", type="string", length=50, nullable=true)
     */
    private $timezone;
	
    /**
     * @var integer
     *
     * @ORM\Column(name="JOB_TERMINATOR", type="smallint", nullable=true)
     */
    private $jobTerminator;

    /**
     * @var string
     *
     * @ORM\Column(name="STD_ERR_FILE", type="string", length=255, nullable=false)
     */
    private $stdErrFile;	
	
    /**
     * @var string
     *
     * @ORM\Column(name="STD_OUT_FILE", type="string", length=255, nullable=false)
     */
    private $stdOutFile;	

    /**
     * @var string
     *
     * @ORM\Column(name="WATCH_FILE", type="string", length=256, nullable=false)
     */
    private $watchFile;
	
    /**
     * @var integer
     *
     * @ORM\Column(name="WATCH_FILE_MIN_SIZE", type="integer", nullable=true)
     */
    private $watchFileMinSize;

    /**
     * @var integer
     *
     * @ORM\Column(name="WATCH_INTERVAL", type="integer", nullable=true)
     */
    private $watchInterval;

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
     * @ORM\Column(name="ALARM_IF_FAIL", type="smallint", nullable=true)
     */
    private $alarmIfFail;

    /**
     * @var string
     *
     * @ORM\Column(name="CHK_FILES", type="string", length=255, nullable=true)
     */
    private $chkFiles;

    /**
     * @var string
     *
     * @ORM\Column(name="PROFILE", type="string", length=255, nullable=true)
     */
    private $profile;

    /**
     * @var integer
     *
     * @ORM\Column(name="HEARTBEAT_INTERVAL", type="integer", nullable=true)
     */
    private $heartbeatInterval;

    /**
     * @var integer
     *
     * @ORM\Column(name="JOB_LOAD", type="integer", nullable=true)
     */
    private $jobLoad;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRIORITY", type="integer", nullable=true)
     */
    private $priority;

    /**
     * @var integer
     *
     * @ORM\Column(name="AUTO_DELETE", type="integer", nullable=true)
     */
    private $autoDelete;

    /**
     * @var integer
     *
     * @ORM\Column(name="NUMERO", type="integer", nullable=true)
     */
    private $numero;

    /**
     * @var integer
     *
     * @ORM\Column(name="MAX_EXIT_SUCCESS", type="integer", nullable=true)
     */
    private $maxExitSuccess;

    /**
     * @var integer
     *
     * @ORM\Column(name="HAS_BLOB", type="smallint", nullable=true)
     */
    private $hasBlob;

    /**
     * @var integer
     *
     * @ORM\Column(name="HAS_OVERRIDE", type="smallint", nullable=true)
     */
    private $hasOverride;

    /**
     * @var integer
     *
     * @ORM\Column(name="JOB_VER", type="integer", nullable=false)
     */
    private $jobVer;

    /**
     * @var integer
     *
     * @ORM\Column(name="WF_JOID", type="integer", nullable=false)
     */
    private $wfJoid;

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
     * @ORM\Column(name="RUN_NUM", type="integer", nullable=false)
     */
    private $runNum;

    /**
     * @var integer
     *
     * @ORM\Column(name="NTRY", type="integer", nullable=false)
     */
    private $ntry;

    /**
     * @var integer
     *
     * @ORM\Column(name="APPL_NTRY", type="integer", nullable=true)
     */
    private $applNtry;

    /**
     * @var integer
     *
     * @ORM\Column(name="LAST_START", type="integer", nullable=true)
     */
    private $lastStart;

    /**
     * @var integer
     *
     * @ORM\Column(name="LAST_END", type="integer", nullable=true)
     */
    private $lastEnd;

    /**
     * @var integer
     *
     * @ORM\Column(name="NEXT_START", type="integer", nullable=true)
     */
    private $nextStart;

    /**
     * @var integer
     *
     * @ORM\Column(name="EXIT_CODE", type="integer", nullable=true)
     */
    private $exitCode;

    /**
     * @var string
     *
     * @ORM\Column(name="RUN_MACHINE", type="string", length=80, nullable=true)
     */
    private $runMachine;

    /**
     * @var string
     *
     * @ORM\Column(name="QUE_NAME", type="string", length=161, nullable=true)
     */
    private $queName;

    /**
     * @var integer
     *
     * @ORM\Column(name="RUN_PRIORITY", type="integer", nullable=true)
     */
    private $runPriority;

    /**
     * @var integer
     *
     * @ORM\Column(name="NEXT_PRIORITY", type="integer", nullable=true)
     */
    private $nextPriority;

    /**
     * @var string
     *
     * @ORM\Column(name="PID", type="string", length=20, nullable=true)
     */
    private $pid;

    /**
     * @var string
     *
     * @ORM\Column(name="JC_PID", type="string", length=20, nullable=true)
     */
    private $jcPid;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIME_OK", type="smallint", nullable=true)
     */
    private $timeOk;

    /**
     * @var integer
     *
     * @ORM\Column(name="LAST_HEARTBEAT", type="integer", nullable=true)
     */
    private $lastHeartbeat;

    /**
     * @var integer
     *
     * @ORM\Column(name="HAS_CONDITION", type="smallint", nullable=true)
     */
    private $hasCondition;

    /**
     * @var integer
     *
     * @ORM\Column(name="HAS_SERVICE_DESK", type="smallint", nullable=true)
     */
    private $hasServiceDesk;


    /**
     * Set joid
     *
     * @param integer $joid
     * @return UjoJobst
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
     * Set jobName
     *
     * @param string $jobName
     * @return UjoJobst
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
     * Set jobType
     *
     * @param integer $jobType
     * @return UjoJobst
     */
    public function setJobType($jobType)
    {
        $this->jobType = $jobType;

        return $this;
    }

    /**
     * Get jobType
     *
     * @return integer 
     */
    public function getJobType()
    {
        return $this->jobType;
    }

    /**
     * Set boxJoid
     *
     * @param integer $boxJoid
     * @return UjoJobst
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
     * Set owner
     *
     * @param string $owner
     * @return UjoJobst
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return string 
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set permission
     *
     * @param string $permission
     * @return UjoJobst
     */
    public function setPermission($permission)
    {
        $this->permission = $permission;

        return $this;
    }

    /**
     * Get permission
     *
     * @return string 
     */
    public function getPermission()
    {
        return $this->permission;
    }

    /**
     * Set nRetrys
     *
     * @param integer $nRetrys
     * @return UjoJobst
     */
    public function setNRetrys($nRetrys)
    {
        $this->nRetrys = $nRetrys;

        return $this;
    }

    /**
     * Get nRetrys
     *
     * @return integer 
     */
    public function getNRetrys()
    {
        return $this->nRetrys;
    }

    /**
     * Set autoHold
     *
     * @param integer $autoHold
     * @return UjoJobst
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
     * Set command
     *
     * @param string $command
     * @return UjoJobst
     */
    public function setCommand($command)
    {
        $this->command = $command;

        return $this;
    }

    /**
     * Get command
     *
     * @return string 
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * Set dateConditions
     *
     * @param integer $dateConditions
     * @return UjoJobst
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
     * @return UjoJobst
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
     * Set runCalendar
     *
     * @param string $runCalendar
     * @return UjoJobst
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
     * Set excludeCalendar
     *
     * @param string $excludeCalendar
     * @return UjoJobst
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
     * Set startTimes
     *
     * @param string $startTimes
     * @return UjoJobst
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
     * Set startMins
     *
     * @param string $startMins
     * @return UjoJobst
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
     * Set runWindow
     *
     * @param string $runWindow
     * @return UjoJobst
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
     * Set description
     *
     * @param string $description
     * @return UjoJobst
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set termRunTime
     *
     * @param integer $termRunTime
     * @return UjoJobst
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
     * Set boxTerminator
     *
     * @param integer $boxTerminator
     * @return UjoJobst
     */
    public function setBoxTerminator($boxTerminator)
    {
        $this->boxTerminator = $boxTerminator;

        return $this;
    }

    /**
     * Get boxTerminator
     *
     * @return integer 
     */
    public function getBoxTerminator()
    {
        return $this->boxTerminator;
    }

    /**
     * Set boxName
     *
     * @param string $boxName
     * @return UjoJobst
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
     * Set hasNotification
     *
     * @param integer $hasNotification
     * @return UjoJobst
     */
    public function setHasNotification($hasNotification)
    {
        $this->hasNotification = $hasNotification;

        return $this;
    }

    /**
     * Get hasNotification
     *
     * @return integer 
     */
    public function getHasNotification()
    {
        return $this->hasNotification;
    }

    /**
     * Set isCurrver
     *
     * @param integer $isCurrver
     * @return UjoJobst
     */
    public function setIsCurrver($isCurrver)
    {
        $this->isCurrver = $isCurrver;

        return $this;
    }

    /**
     * Get isCurrver
     *
     * @return integer 
     */
    public function getIsCurrver()
    {
        return $this->isCurrver;
    }

    /**
     * Set timezone
     *
     * @param string $timezone
     * @return UjoJobst
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

    /**
     * Set jobTerminator
     *
     * @param integer $jobTerminator
     * @return UjoJobst
     */
    public function setJobTerminator($jobTerminator)
    {
        $this->jobTerminator = $jobTerminator;

        return $this;
    }

    /**
     * Get jobTerminator
     *
     * @return integer 
     */
    public function getJobTerminator()
    {
        return $this->jobTerminator;
    }

    /**
     * Set stdErrFile
     *
     * @param string $stdErrFile
     * @return UjoJobst
     */
    public function setStdErrFile($stdErrFile)
    {
        $this->stdErrFile = $stdErrFile;

        return $this;
    }

    /**
     * Get stdErrFile
     *
     * @return string 
     */
    public function getStdErrFile()
    {
        return $this->stdErrFile;
    }

    /**
     * Set stdOutFile
     *
     * @param string $stdOutFile
     * @return UjoJobst
     */
    public function setStdOutFile($stdOutFile)
    {
        $this->stdOutFile = $stdOutFile;

        return $this;
    }

    /**
     * Get stdOutFile
     *
     * @return string 
     */
    public function getStdOutFile()
    {
        return $this->stdOutFile;
    }

    /**
     * Set watchFile
     *
     * @param string $watchFile
     * @return UjoJobst
     */
    public function setWatchFile($watchFile)
    {
        $this->watchFile = $watchFile;

        return $this;
    }

    /**
     * Get watchFile
     *
     * @return string 
     */
    public function getWatchFile()
    {
        return $this->watchFile;
    }

    /**
     * Set watchFileMinSize
     *
     * @param integer $watchFileMinSize
     * @return UjoJobst
     */
    public function setWatchFileMinSize($watchFileMinSize)
    {
        $this->watchFileMinSize = $watchFileMinSize;

        return $this;
    }

    /**
     * Get watchFileMinSize
     *
     * @return integer 
     */
    public function getWatchFileMinSize()
    {
        return $this->watchFileMinSize;
    }

    /**
     * Set watchInterval
     *
     * @param integer $watchInterval
     * @return UjoJobst
     */
    public function setWatchInterval($watchInterval)
    {
        $this->watchInterval = $watchInterval;

        return $this;
    }

    /**
     * Get watchInterval
     *
     * @return integer 
     */
    public function getWatchInterval()
    {
        return $this->watchInterval;
    }

    /**
     * Set maxRunAlarm
     *
     * @param integer $maxRunAlarm
     * @return UjoJobst
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
     * @return UjoJobst
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
     * Set alarmIfFail
     *
     * @param integer $alarmIfFail
     * @return UjoJobst
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
     * Set chkFiles
     *
     * @param string $chkFiles
     * @return UjoJobst
     */
    public function setChkFiles($chkFiles)
    {
        $this->chkFiles = $chkFiles;

        return $this;
    }

    /**
     * Get chkFiles
     *
     * @return string 
     */
    public function getChkFiles()
    {
        return $this->chkFiles;
    }

    /**
     * Set profile
     *
     * @param string $profile
     * @return UjoJobst
     */
    public function setProfile($profile)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get profile
     *
     * @return string 
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * Set heartbeatInterval
     *
     * @param integer $heartbeatInterval
     * @return UjoJobst
     */
    public function setHeartbeatInterval($heartbeatInterval)
    {
        $this->heartbeatInterval = $heartbeatInterval;

        return $this;
    }

    /**
     * Get heartbeatInterval
     *
     * @return integer 
     */
    public function getHeartbeatInterval()
    {
        return $this->heartbeatInterval;
    }

    /**
     * Set jobLoad
     *
     * @param integer $jobLoad
     * @return UjoJobst
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
     * Set priority
     *
     * @param integer $priority
     * @return UjoJobst
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
     * Set autoDelete
     *
     * @param integer $autoDelete
     * @return UjoJobst
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
     * Set numero
     *
     * @param integer $numero
     * @return UjoJobst
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set maxExitSuccess
     *
     * @param integer $maxExitSuccess
     * @return UjoJobst
     */
    public function setMaxExitSuccess($maxExitSuccess)
    {
        $this->maxExitSuccess = $maxExitSuccess;

        return $this;
    }

    /**
     * Get maxExitSuccess
     *
     * @return integer 
     */
    public function getMaxExitSuccess()
    {
        return $this->maxExitSuccess;
    }

    /**
     * Set hasBlob
     *
     * @param integer $hasBlob
     * @return UjoJobst
     */
    public function setHasBlob($hasBlob)
    {
        $this->hasBlob = $hasBlob;

        return $this;
    }

    /**
     * Get hasBlob
     *
     * @return integer 
     */
    public function getHasBlob()
    {
        return $this->hasBlob;
    }

    /**
     * Set hasOverride
     *
     * @param integer $hasOverride
     * @return UjoJobst
     */
    public function setHasOverride($hasOverride)
    {
        $this->hasOverride = $hasOverride;

        return $this;
    }

    /**
     * Get hasOverride
     *
     * @return integer 
     */
    public function getHasOverride()
    {
        return $this->hasOverride;
    }

    /**
     * Set jobVer
     *
     * @param integer $jobVer
     * @return UjoJobst
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
     * Set wfJoid
     *
     * @param integer $wfJoid
     * @return UjoJobst
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
     * Set status
     *
     * @param integer $status
     * @return UjoJobst
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
     * @return UjoJobst
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
     * Set runNum
     *
     * @param integer $runNum
     * @return UjoJobst
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
     * Set ntry
     *
     * @param integer $ntry
     * @return UjoJobst
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
     * Set applNtry
     *
     * @param integer $applNtry
     * @return UjoJobst
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
     * Set lastStart
     *
     * @param integer $lastStart
     * @return UjoJobst
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
     * Set lastEnd
     *
     * @param integer $lastEnd
     * @return UjoJobst
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
     * Set nextStart
     *
     * @param integer $nextStart
     * @return UjoJobst
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
     * Set exitCode
     *
     * @param integer $exitCode
     * @return UjoJobst
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
     * Set runMachine
     *
     * @param string $runMachine
     * @return UjoJobst
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
     * Set queName
     *
     * @param string $queName
     * @return UjoJobst
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
     * Set runPriority
     *
     * @param integer $runPriority
     * @return UjoJobst
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
     * Set nextPriority
     *
     * @param integer $nextPriority
     * @return UjoJobst
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
     * Set pid
     *
     * @param string $pid
     * @return UjoJobst
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
     * Set jcPid
     *
     * @param string $jcPid
     * @return UjoJobst
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
     * Set timeOk
     *
     * @param integer $timeOk
     * @return UjoJobst
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
     * Set lastHeartbeat
     *
     * @param integer $lastHeartbeat
     * @return UjoJobst
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
     * Set hasCondition
     *
     * @param integer $hasCondition
     * @return UjoJobst
     */
    public function setHasCondition($hasCondition)
    {
        $this->hasCondition = $hasCondition;

        return $this;
    }

    /**
     * Get hasCondition
     *
     * @return integer 
     */
    public function getHasCondition()
    {
        return $this->hasCondition;
    }

    /**
     * Set hasServiceDesk
     *
     * @param integer $hasServiceDesk
     * @return UjoJobst
     */
    public function setHasServiceDesk($hasServiceDesk)
    {
        $this->hasServiceDesk = $hasServiceDesk;

        return $this;
    }

    /**
     * Get hasServiceDesk
     *
     * @return integer 
     */
    public function getHasServiceDesk()
    {
        return $this->hasServiceDesk;
    }
}
