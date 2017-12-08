<?php

namespace Arii\ATSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UjoJobRuns
 *
 * @ORM\Table(name="UJO_JOB_RUNS", indexes={@ORM\Index(name="xak2ujo_job_runs", columns={"JOID", "JOB_VER", "OVER_NUM"}), @ORM\Index(name="xak1ujo_job_runs", columns={"EVT_NUM"}), @ORM\Index(name="xak3ujo_job_runs", columns={"ENDTIME", "STARTIME", "STATUS", "SVCDESK_HANDLE"})})
 * @ORM\Entity(readOnly=true)
 */
class UjoJobRuns
{

    /**
     * @ORM\ManyToOne(targetEntity="Arii\ATSBundle\Entity\UjoJob")
     * @ORM\JoinColumn(nullable=true)
     * @ORM\Column(name="JOID")
     *      
     */
    private $joid;
        
    /**
     * @var integer
     *
     * @ORM\Column(name="ENDTIME", type="integer", nullable=true)
     */
    private $endtime;

    /**
     * @var string
     *
     * @ORM\Column(name="ESP_LSTATUS", type="string", length=256, nullable=true)
     */
    private $espLstatus;

    /**
     * @var string
     *
     * @ORM\Column(name="ESP_STATUS", type="string", length=256, nullable=true)
     */
    private $espStatus;

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
     * @var integer
     *
     * @ORM\Column(name="JOB_VER", type="integer", nullable=true)
     */
    private $jobVer;

    /**
     * @var integer
     *
     * @ORM\Column(name="NTRY", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $ntry;

    /**
     * @var integer
     *
     * @ORM\Column(name="OVER_NUM", type="integer", nullable=true)
     */
    private $overNum;

    /**
     * @var string
     *
     * @ORM\Column(name="REPLY_MESSAGE", type="string", length=256, nullable=true)
     */
    private $replyMessage;

    /**
     * @var string
     *
     * @ORM\Column(name="REPLY_RESPONSE", type="string", length=256, nullable=true)
     */
    private $replyResponse;

    /**
     * @var string
     *
     * @ORM\Column(name="RUN_MACHINE", type="string", length=80, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $runMachine;

    /**
     * @var integer
     *
     * @ORM\Column(name="RUN_NUM", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $runNum;

    /**
     * @var integer
     *
     * @ORM\Column(name="RUNTIME", type="integer", nullable=true)
     */
    private $runtime;

    /**
     * @var integer
     *
     * @ORM\Column(name="STARTIME", type="integer", nullable=true)
     */
    private $startime;

    /**
     * @var integer
     *
     * @ORM\Column(name="STATUS", type="integer", nullable=true)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="STD_ERR_FILE", type="string", length=1024, nullable=true)
     */
    private $stdErrFile;

    /**
     * @var string
     *
     * @ORM\Column(name="STD_OUT_FILE", type="string", length=1024, nullable=true)
     */
    private $stdOutFile;

    /**
     * @var string
     *
     * @ORM\Column(name="SVCDESK_HANDLE", type="string", length=32, nullable=true)
     */
    private $svcdeskHandle;

    /**
     * @var integer
     *
     * @ORM\Column(name="SVCDESK_STATUS", type="integer", nullable=true)
     */
    private $svcdeskStatus;

    /**
     * @var integer
     *
     * @ORM\Column(name="WF_JOID", type="integer", nullable=true)
     */
    private $wfJoid;

    /**
     * @var integer
     *
     * @ORM\Column(name="EXECUTION_MODE", type="integer", nullable=true)
     */
/* 11.3.6
    private $executionMode;
*/

    /**
     * Set endtime
     *
     * @param integer $endtime
     * @return UjoJobRuns
     */
    public function setEndtime($endtime)
    {
        $this->endtime = $endtime;

        return $this;
    }

    /**
     * Get endtime
     *
     * @return integer 
     */
    public function getEndtime()
    {
        return $this->endtime;
    }

    /**
     * Set espLstatus
     *
     * @param string $espLstatus
     * @return UjoJobRuns
     */
    public function setEspLstatus($espLstatus)
    {
        $this->espLstatus = $espLstatus;

        return $this;
    }

    /**
     * Get espLstatus
     *
     * @return string 
     */
    public function getEspLstatus()
    {
        return $this->espLstatus;
    }

    /**
     * Set espStatus
     *
     * @param string $espStatus
     * @return UjoJobRuns
     */
    public function setEspStatus($espStatus)
    {
        $this->espStatus = $espStatus;

        return $this;
    }

    /**
     * Get espStatus
     *
     * @return string 
     */
    public function getEspStatus()
    {
        return $this->espStatus;
    }

    /**
     * Set evtNum
     *
     * @param integer $evtNum
     * @return UjoJobRuns
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
     * @return UjoJobRuns
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
     * @return UjoJobRuns
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
     * Set jobVer
     *
     * @param integer $jobVer
     * @return UjoJobRuns
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
     * Set ntry
     *
     * @param integer $ntry
     * @return UjoJobRuns
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
     * @return UjoJobRuns
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
     * Set replyMessage
     *
     * @param string $replyMessage
     * @return UjoJobRuns
     */
    public function setReplyMessage($replyMessage)
    {
        $this->replyMessage = $replyMessage;

        return $this;
    }

    /**
     * Get replyMessage
     *
     * @return string 
     */
    public function getReplyMessage()
    {
        return $this->replyMessage;
    }

    /**
     * Set replyResponse
     *
     * @param string $replyResponse
     * @return UjoJobRuns
     */
    public function setReplyResponse($replyResponse)
    {
        $this->replyResponse = $replyResponse;

        return $this;
    }

    /**
     * Get replyResponse
     *
     * @return string 
     */
    public function getReplyResponse()
    {
        return $this->replyResponse;
    }

    /**
     * Set runMachine
     *
     * @param string $runMachine
     * @return UjoJobRuns
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
     * @return UjoJobRuns
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
     * Set runtime
     *
     * @param integer $runtime
     * @return UjoJobRuns
     */
    public function setRuntime($runtime)
    {
        $this->runtime = $runtime;

        return $this;
    }

    /**
     * Get runtime
     *
     * @return integer 
     */
    public function getRuntime()
    {
        return $this->runtime;
    }

    /**
     * Set startime
     *
     * @param integer $startime
     * @return UjoJobRuns
     */
    public function setStartime($startime)
    {
        $this->startime = $startime;

        return $this;
    }

    /**
     * Get startime
     *
     * @return integer 
     */
    public function getStartime()
    {
        return $this->startime;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return UjoJobRuns
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
     * Set stdErrFile
     *
     * @param string $stdErrFile
     * @return UjoJobRuns
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
     * @return UjoJobRuns
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
     * Set svcdeskHandle
     *
     * @param string $svcdeskHandle
     * @return UjoJobRuns
     */
    public function setSvcdeskHandle($svcdeskHandle)
    {
        $this->svcdeskHandle = $svcdeskHandle;

        return $this;
    }

    /**
     * Get svcdeskHandle
     *
     * @return string 
     */
    public function getSvcdeskHandle()
    {
        return $this->svcdeskHandle;
    }

    /**
     * Set svcdeskStatus
     *
     * @param integer $svcdeskStatus
     * @return UjoJobRuns
     */
    public function setSvcdeskStatus($svcdeskStatus)
    {
        $this->svcdeskStatus = $svcdeskStatus;

        return $this;
    }

    /**
     * Get svcdeskStatus
     *
     * @return integer 
     */
    public function getSvcdeskStatus()
    {
        return $this->svcdeskStatus;
    }

    /**
     * Set wfJoid
     *
     * @param integer $wfJoid
     * @return UjoJobRuns
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
     * Set executionMode
     *
     * @param integer $executionMode
     * @return UjoJobRuns
     */
    public function setExecutionMode($executionMode)
    {
        $this->executionMode = $executionMode;

        return $this;
    }

    /**
     * Get executionMode
     *
     * @return integer 
     */
    public function getExecutionMode()
    {
        return $this->executionMode;
    }

    /**
     * Set joid
     *
     * @param \Arii\ATSBundle\Entity\UjoJob $joid
     * @return UjoJobRuns
     */
    public function setJoid(\Arii\ATSBundle\Entity\UjoJob $joid = null)
    {
        $this->joid = $joid;

        return $this;
    }

    /**
     * Get joid
     *
     * @return \Arii\ATSBundle\Entity\UjoJob 
     */
    public function getJoid()
    {
        return $this->joid;
    }
}
