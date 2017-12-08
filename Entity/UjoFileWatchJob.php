<?php

namespace Arii\ATSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UjoFileWatchJob
 *
 * @ORM\Table(name="UJO_FILE_WATCH_JOB")
 * @ORM\Entity(readOnly=true)
 */
class UjoFileWatchJob
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CHANGE_TYPE", type="smallint", nullable=true)
     */
    private $changeType;

    /**
     * @var integer
     *
     * @ORM\Column(name="CHANGE_VALUE", type="integer", nullable=true)
     */
    private $changeValue;

    /**
     * @var string
     *
     * @ORM\Column(name="FILE_NAME", type="string", length=256, nullable=false)
     */
    private $fileName;

    /**
     * @var string
     *
     * @ORM\Column(name="FILE_OWNER", type="string", length=80, nullable=true)
     */
    private $fileOwner;

    /**
     * @var integer
     *
     * @ORM\Column(name="FILE_SIZE", type="integer", nullable=true)
     */
    private $fileSize;

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
     * @var integer
     *
     * @ORM\Column(name="POLL", type="integer", nullable=true)
     */
    private $poll;

    /**
     * @var integer
     *
     * @ORM\Column(name="RECURSIVE", type="smallint", nullable=true)
     */
    private $recursive;

    /**
     * @var string
     *
     * @ORM\Column(name="UNC_PASSWORD", type="string", length=128, nullable=true)
     */
    private $uncPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="UNC_USERID", type="string", length=80, nullable=true)
     */
    private $uncUserid;

    /**
     * @var string
     *
     * @ORM\Column(name="USER_GROUP", type="string", length=80, nullable=true)
     */
    private $userGroup;

    /**
     * @var integer
     *
     * @ORM\Column(name="WATCH_TYPE", type="smallint", nullable=true)
     */
    private $watchType;

    /**
     * @var string
     *
     * @ORM\Column(name="NOCHANGE_POLL", type="string", length=21, nullable=true)
     */
    private $nochangePoll;



    /**
     * Set changeType
     *
     * @param integer $changeType
     * @return UjoFileWatchJob
     */
    public function setChangeType($changeType)
    {
        $this->changeType = $changeType;

        return $this;
    }

    /**
     * Get changeType
     *
     * @return integer 
     */
    public function getChangeType()
    {
        return $this->changeType;
    }

    /**
     * Set changeValue
     *
     * @param integer $changeValue
     * @return UjoFileWatchJob
     */
    public function setChangeValue($changeValue)
    {
        $this->changeValue = $changeValue;

        return $this;
    }

    /**
     * Get changeValue
     *
     * @return integer 
     */
    public function getChangeValue()
    {
        return $this->changeValue;
    }

    /**
     * Set fileName
     *
     * @param string $fileName
     * @return UjoFileWatchJob
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get fileName
     *
     * @return string 
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set fileOwner
     *
     * @param string $fileOwner
     * @return UjoFileWatchJob
     */
    public function setFileOwner($fileOwner)
    {
        $this->fileOwner = $fileOwner;

        return $this;
    }

    /**
     * Get fileOwner
     *
     * @return string 
     */
    public function getFileOwner()
    {
        return $this->fileOwner;
    }

    /**
     * Set fileSize
     *
     * @param integer $fileSize
     * @return UjoFileWatchJob
     */
    public function setFileSize($fileSize)
    {
        $this->fileSize = $fileSize;

        return $this;
    }

    /**
     * Get fileSize
     *
     * @return integer 
     */
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     * Set jobVer
     *
     * @param integer $jobVer
     * @return UjoFileWatchJob
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
     * @return UjoFileWatchJob
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
     * @return UjoFileWatchJob
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
     * Set poll
     *
     * @param integer $poll
     * @return UjoFileWatchJob
     */
    public function setPoll($poll)
    {
        $this->poll = $poll;

        return $this;
    }

    /**
     * Get poll
     *
     * @return integer 
     */
    public function getPoll()
    {
        return $this->poll;
    }

    /**
     * Set recursive
     *
     * @param integer $recursive
     * @return UjoFileWatchJob
     */
    public function setRecursive($recursive)
    {
        $this->recursive = $recursive;

        return $this;
    }

    /**
     * Get recursive
     *
     * @return integer 
     */
    public function getRecursive()
    {
        return $this->recursive;
    }

    /**
     * Set uncPassword
     *
     * @param string $uncPassword
     * @return UjoFileWatchJob
     */
    public function setUncPassword($uncPassword)
    {
        $this->uncPassword = $uncPassword;

        return $this;
    }

    /**
     * Get uncPassword
     *
     * @return string 
     */
    public function getUncPassword()
    {
        return $this->uncPassword;
    }

    /**
     * Set uncUserid
     *
     * @param string $uncUserid
     * @return UjoFileWatchJob
     */
    public function setUncUserid($uncUserid)
    {
        $this->uncUserid = $uncUserid;

        return $this;
    }

    /**
     * Get uncUserid
     *
     * @return string 
     */
    public function getUncUserid()
    {
        return $this->uncUserid;
    }

    /**
     * Set userGroup
     *
     * @param string $userGroup
     * @return UjoFileWatchJob
     */
    public function setUserGroup($userGroup)
    {
        $this->userGroup = $userGroup;

        return $this;
    }

    /**
     * Get userGroup
     *
     * @return string 
     */
    public function getUserGroup()
    {
        return $this->userGroup;
    }

    /**
     * Set watchType
     *
     * @param integer $watchType
     * @return UjoFileWatchJob
     */
    public function setWatchType($watchType)
    {
        $this->watchType = $watchType;

        return $this;
    }

    /**
     * Get watchType
     *
     * @return integer 
     */
    public function getWatchType()
    {
        return $this->watchType;
    }

    /**
     * Set nochangePoll
     *
     * @param string $nochangePoll
     * @return UjoFileWatchJob
     */
    public function setNochangePoll($nochangePoll)
    {
        $this->nochangePoll = $nochangePoll;

        return $this;
    }

    /**
     * Get nochangePoll
     *
     * @return string 
     */
    public function getNochangePoll()
    {
        return $this->nochangePoll;
    }
}
