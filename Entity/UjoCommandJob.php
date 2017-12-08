<?php

namespace Arii\ATSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UjoCommandJob
 *
 * @ORM\Table(name="UJO_COMMAND_JOB")
 * @ORM\Entity(readOnly=true)
 */
class UjoCommandJob
{
    /**
     * @var string
     *
     * @ORM\Column(name="CHK_FILES", type="string", length=255, nullable=true)
     */
    private $chkFiles;

    /**
     * @var string
     *
     * @ORM\Column(name="COMMAND", type="string", length=1000, nullable=true)
     */
    private $command;

    /**
     * @var integer
     *
     * @ORM\Column(name="ENVVARS", type="integer", nullable=true)
     */
    private $envvars;

    /**
     * @var integer
     *
     * @ORM\Column(name="HEARTBEAT_INTERVAL", type="integer", nullable=true)
     */
    private $heartbeatInterval;

    /**
     * @var integer
     *
     * @ORM\Column(name="INTERACTIVE", type="smallint", nullable=true)
     */
    private $interactive;

    /**
     * @var integer
     *
     * @ORM\Column(name="IS_SCRIPT", type="smallint", nullable=true)
     */
    private $isScript;

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
     * @ORM\Column(name="OVER_NUM", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $overNum;

    /**
     * @var string
     *
     * @ORM\Column(name="SHELL", type="string", length=20, nullable=true)
     */
    private $shell;

    /**
     * @var string
     *
     * @ORM\Column(name="STD_ERR_FILE", type="string", length=255, nullable=true)
     */
    private $stdErrFile;

    /**
     * @var string
     *
     * @ORM\Column(name="STD_IN_FILE", type="string", length=255, nullable=true)
     */
    private $stdInFile;

    /**
     * @var string
     *
     * @ORM\Column(name="STD_OUT_FILE", type="string", length=255, nullable=true)
     */
    private $stdOutFile;

    /**
     * @var integer
     *
     * @ORM\Column(name="ULIMIT", type="integer", nullable=true)
     */
    private $ulimit;

    /**
     * @var string
     *
     * @ORM\Column(name="USERID", type="string", length=80, nullable=true)
     */
    private $userid;

    /**
     * @var integer
     *
     * @ORM\Column(name="ELEVATED", type="smallint", nullable=true)
     */
    private $elevated;



    /**
     * Set chkFiles
     *
     * @param string $chkFiles
     * @return UjoCommandJob
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
     * Set command
     *
     * @param string $command
     * @return UjoCommandJob
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
     * Set envvars
     *
     * @param integer $envvars
     * @return UjoCommandJob
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
     * Set heartbeatInterval
     *
     * @param integer $heartbeatInterval
     * @return UjoCommandJob
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
     * Set interactive
     *
     * @param integer $interactive
     * @return UjoCommandJob
     */
    public function setInteractive($interactive)
    {
        $this->interactive = $interactive;

        return $this;
    }

    /**
     * Get interactive
     *
     * @return integer 
     */
    public function getInteractive()
    {
        return $this->interactive;
    }

    /**
     * Set isScript
     *
     * @param integer $isScript
     * @return UjoCommandJob
     */
    public function setIsScript($isScript)
    {
        $this->isScript = $isScript;

        return $this;
    }

    /**
     * Get isScript
     *
     * @return integer 
     */
    public function getIsScript()
    {
        return $this->isScript;
    }

    /**
     * Set jobVer
     *
     * @param integer $jobVer
     * @return UjoCommandJob
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
     * @return UjoCommandJob
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
     * Set overNum
     *
     * @param integer $overNum
     * @return UjoCommandJob
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
     * Set shell
     *
     * @param string $shell
     * @return UjoCommandJob
     */
    public function setShell($shell)
    {
        $this->shell = $shell;

        return $this;
    }

    /**
     * Get shell
     *
     * @return string 
     */
    public function getShell()
    {
        return $this->shell;
    }

    /**
     * Set stdErrFile
     *
     * @param string $stdErrFile
     * @return UjoCommandJob
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
     * Set stdInFile
     *
     * @param string $stdInFile
     * @return UjoCommandJob
     */
    public function setStdInFile($stdInFile)
    {
        $this->stdInFile = $stdInFile;

        return $this;
    }

    /**
     * Get stdInFile
     *
     * @return string 
     */
    public function getStdInFile()
    {
        return $this->stdInFile;
    }

    /**
     * Set stdOutFile
     *
     * @param string $stdOutFile
     * @return UjoCommandJob
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
     * Set ulimit
     *
     * @param integer $ulimit
     * @return UjoCommandJob
     */
    public function setUlimit($ulimit)
    {
        $this->ulimit = $ulimit;

        return $this;
    }

    /**
     * Get ulimit
     *
     * @return integer 
     */
    public function getUlimit()
    {
        return $this->ulimit;
    }

    /**
     * Set userid
     *
     * @param string $userid
     * @return UjoCommandJob
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Get userid
     *
     * @return string 
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set elevated
     *
     * @param integer $elevated
     * @return UjoCommandJob
     */
    public function setElevated($elevated)
    {
        $this->elevated = $elevated;

        return $this;
    }

    /**
     * Get elevated
     *
     * @return integer 
     */
    public function getElevated()
    {
        return $this->elevated;
    }
}
