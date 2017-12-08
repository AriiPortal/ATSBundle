<?php

namespace Arii\ATSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UjoJob
 *
 * @ORM\Table(name="UJO_JOB", indexes={@ORM\Index(name="xak2ujo_job", columns={"JOB_NAME", "IS_ACTIVE", "IS_CURRVER", "WF_JOID"}), @ORM\Index(name="xak3ujo_job", columns={"BOX_JOID", "IS_ACTIVE", "IS_CURRVER", "JOID"}), @ORM\Index(name="xak1ujo_job", columns={"JOID", "IS_ACTIVE", "IS_CURRVER", "WF_JOID"})})
 * @ORM\Entity(readOnly=true)
 */
class UjoJob
{
    /**
     * @var string
     *
     * @ORM\Column(name="ALERT", type="string", length=128, nullable=true)
     */
    private $alert;

    /**
     * @var string
     *
     * @ORM\Column(name="AS_APPLIC", type="string", length=64, nullable=true)
     */
    private $asApplic;

    /**
     * @var string
     *
     * @ORM\Column(name="AS_GROUP", type="string", length=64, nullable=true)
     */
    private $asGroup;

    /**
     * @var integer
     *
     * @ORM\Column(name="BOX_JOID", type="integer", nullable=true)
     */
    private $boxJoid;

    /**
     * @var integer
     *
     * @ORM\Column(name="BOX_TERMINATOR", type="smallint", nullable=true)
     */
    private $boxTerminator;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CREATE_STAMP", type="date", nullable=true)
     */
    private $createStamp;

    /**
     * @var string
     *
     * @ORM\Column(name="CREATE_USERID", type="string", length=80, nullable=true)
     */
    private $createUserid;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPTION", type="string", length=500, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="DESTINATION_FILE", type="string", length=256, nullable=true)
     */
    private $destinationFile;

    /**
     * @var string
     *
     * @ORM\Column(name="EXTERNAL_APP", type="string", length=40, nullable=true)
     */
    private $externalApp;

    /**
     * @var integer
     *
     * @ORM\Column(name="HAS_BLOB", type="smallint", nullable=true)
     */
    private $hasBlob;

    /**
     * @var integer
     *
     * @ORM\Column(name="HAS_BOX_FAILURE", type="smallint", nullable=true)
     */
    private $hasBoxFailure;

    /**
     * @var integer
     *
     * @ORM\Column(name="HAS_BOX_SUCCESS", type="smallint", nullable=true)
     */
    private $hasBoxSuccess;

    /**
     * @var integer
     *
     * @ORM\Column(name="HAS_CONDITION", type="smallint", nullable=true)
     */
    private $hasCondition;

    /**
     * @var integer
     *
     * @ORM\Column(name="HAS_NOTIFICATION", type="smallint", nullable=true)
     */
    private $hasNotification;

    /**
     * @var integer
     *
     * @ORM\Column(name="HAS_OVERRIDE", type="smallint", nullable=true)
     */
    private $hasOverride;

    /**
     * @var integer
     *
     * @ORM\Column(name="HAS_RESOURCE", type="smallint", nullable=true)
     */
    private $hasResource;

    /**
     * @var integer
     *
     * @ORM\Column(name="HAS_SERVICE_DESK", type="smallint", nullable=true)
     */
    private $hasServiceDesk;

    /**
     * @var integer
     *
     * @ORM\Column(name="IS_ACTIVE", type="smallint", nullable=false)
     */
    private $isActive;

    /**
     * @var integer
     *
     * @ORM\Column(name="IS_CURRVER", type="smallint", nullable=false)
     */
    private $isCurrver;

    /**
     * @var string
     *
     * @ORM\Column(name="JOB_CLASS", type="string", length=32, nullable=true)
     */
    private $jobClass;

    /**
     * @var string
     *
     * @ORM\Column(name="JOB_NAME", type="string", length=64, nullable=false)
     */
    private $jobName;

    /**
     * @var string
     *
     * @ORM\Column(name="JOB_QUALIFIER", type="string", length=64, nullable=true)
     */
    private $jobQualifier;

    /**
     * @var integer
     *
     * @ORM\Column(name="JOB_TERMINATOR", type="smallint", nullable=true)
     */
    private $jobTerminator;

    /**
     * @var integer
     *
     * @ORM\Column(name="JOB_TYPE", type="integer", nullable=false)
     */
    private $jobType;

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
     * @var string
     *
     * @ORM\Column(name="MACH_NAME", type="string", length=80, nullable=true)
     */
    private $machName;

    /**
     * @var integer
     *
     * @ORM\Column(name="MAX_EXIT_SUCCESS", type="integer", nullable=true)
     */
    private $maxExitSuccess;

    /**
     * @var integer
     *
     * @ORM\Column(name="N_RETRYS", type="integer", nullable=true)
     */
    private $nRetrys;

    /**
     * @var integer
     *
     * @ORM\Column(name="NUMERO", type="integer", nullable=true)
     */
    private $numero;

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
     * @ORM\Column(name="OVER_SEED", type="integer", nullable=true)
     */
    private $overSeed;

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
     * @var string
     *
     * @ORM\Column(name="PROFILE", type="string", length=255, nullable=true)
     */
    private $profile;

    /**
     * @var integer
     *
     * @ORM\Column(name="SEND_NOTIFICATION", type="smallint", nullable=true)
     */
    private $sendNotification;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERVICE_DESK", type="smallint", nullable=true)
     */
    private $serviceDesk;

    /**
     * @var string
     *
     * @ORM\Column(name="SUB_APPLICATION", type="string", length=8, nullable=true)
     */
    private $subApplication;

    /**
     * @var string
     *
     * @ORM\Column(name="TAG", type="string", length=64, nullable=true)
     */
    private $tag;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="UPDATE_STAMP", type="date", nullable=true)
     */
    private $updateStamp;

    /**
     * @var string
     *
     * @ORM\Column(name="UPDATE_USERID", type="string", length=80, nullable=true)
     */
    private $updateUserid;

    /**
     * @var integer
     *
     * @ORM\Column(name="WF_JOID", type="integer", nullable=false)
     */
    private $wfJoid;

    /**
     * @var integer
     *
     * @ORM\Column(name="HAS_NR_COND", type="smallint", nullable=true)
     */
    private $hasNrCond;



    /**
     * Set alert
     *
     * @param string $alert
     * @return UjoJob
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
     * Set asApplic
     *
     * @param string $asApplic
     * @return UjoJob
     */
    public function setAsApplic($asApplic)
    {
        $this->asApplic = $asApplic;

        return $this;
    }

    /**
     * Get asApplic
     *
     * @return string 
     */
    public function getAsApplic()
    {
        return $this->asApplic;
    }

    /**
     * Set asGroup
     *
     * @param string $asGroup
     * @return UjoJob
     */
    public function setAsGroup($asGroup)
    {
        $this->asGroup = $asGroup;

        return $this;
    }

    /**
     * Get asGroup
     *
     * @return string 
     */
    public function getAsGroup()
    {
        return $this->asGroup;
    }

    /**
     * Set boxJoid
     *
     * @param integer $boxJoid
     * @return UjoJob
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
     * Set boxTerminator
     *
     * @param integer $boxTerminator
     * @return UjoJob
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
     * Set createStamp
     *
     * @param \DateTime $createStamp
     * @return UjoJob
     */
    public function setCreateStamp($createStamp)
    {
        $this->createStamp = $createStamp;

        return $this;
    }

    /**
     * Get createStamp
     *
     * @return \DateTime 
     */
    public function getCreateStamp()
    {
        return $this->createStamp;
    }

    /**
     * Set createUserid
     *
     * @param string $createUserid
     * @return UjoJob
     */
    public function setCreateUserid($createUserid)
    {
        $this->createUserid = $createUserid;

        return $this;
    }

    /**
     * Get createUserid
     *
     * @return string 
     */
    public function getCreateUserid()
    {
        return $this->createUserid;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return UjoJob
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
     * Set destinationFile
     *
     * @param string $destinationFile
     * @return UjoJob
     */
    public function setDestinationFile($destinationFile)
    {
        $this->destinationFile = $destinationFile;

        return $this;
    }

    /**
     * Get destinationFile
     *
     * @return string 
     */
    public function getDestinationFile()
    {
        return $this->destinationFile;
    }

    /**
     * Set externalApp
     *
     * @param string $externalApp
     * @return UjoJob
     */
    public function setExternalApp($externalApp)
    {
        $this->externalApp = $externalApp;

        return $this;
    }

    /**
     * Get externalApp
     *
     * @return string 
     */
    public function getExternalApp()
    {
        return $this->externalApp;
    }

    /**
     * Set hasBlob
     *
     * @param integer $hasBlob
     * @return UjoJob
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
     * Set hasBoxFailure
     *
     * @param integer $hasBoxFailure
     * @return UjoJob
     */
    public function setHasBoxFailure($hasBoxFailure)
    {
        $this->hasBoxFailure = $hasBoxFailure;

        return $this;
    }

    /**
     * Get hasBoxFailure
     *
     * @return integer 
     */
    public function getHasBoxFailure()
    {
        return $this->hasBoxFailure;
    }

    /**
     * Set hasBoxSuccess
     *
     * @param integer $hasBoxSuccess
     * @return UjoJob
     */
    public function setHasBoxSuccess($hasBoxSuccess)
    {
        $this->hasBoxSuccess = $hasBoxSuccess;

        return $this;
    }

    /**
     * Get hasBoxSuccess
     *
     * @return integer 
     */
    public function getHasBoxSuccess()
    {
        return $this->hasBoxSuccess;
    }

    /**
     * Set hasCondition
     *
     * @param integer $hasCondition
     * @return UjoJob
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
     * Set hasNotification
     *
     * @param integer $hasNotification
     * @return UjoJob
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
     * Set hasOverride
     *
     * @param integer $hasOverride
     * @return UjoJob
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
     * Set hasResource
     *
     * @param integer $hasResource
     * @return UjoJob
     */
    public function setHasResource($hasResource)
    {
        $this->hasResource = $hasResource;

        return $this;
    }

    /**
     * Get hasResource
     *
     * @return integer 
     */
    public function getHasResource()
    {
        return $this->hasResource;
    }

    /**
     * Set hasServiceDesk
     *
     * @param integer $hasServiceDesk
     * @return UjoJob
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

    /**
     * Set isActive
     *
     * @param integer $isActive
     * @return UjoJob
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return integer 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set isCurrver
     *
     * @param integer $isCurrver
     * @return UjoJob
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
     * Set jobClass
     *
     * @param string $jobClass
     * @return UjoJob
     */
    public function setJobClass($jobClass)
    {
        $this->jobClass = $jobClass;

        return $this;
    }

    /**
     * Get jobClass
     *
     * @return string 
     */
    public function getJobClass()
    {
        return $this->jobClass;
    }

    /**
     * Set jobName
     *
     * @param string $jobName
     * @return UjoJob
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
     * Set jobQualifier
     *
     * @param string $jobQualifier
     * @return UjoJob
     */
    public function setJobQualifier($jobQualifier)
    {
        $this->jobQualifier = $jobQualifier;

        return $this;
    }

    /**
     * Get jobQualifier
     *
     * @return string 
     */
    public function getJobQualifier()
    {
        return $this->jobQualifier;
    }

    /**
     * Set jobTerminator
     *
     * @param integer $jobTerminator
     * @return UjoJob
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
     * Set jobType
     *
     * @param integer $jobType
     * @return UjoJob
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
     * Set jobVer
     *
     * @param integer $jobVer
     * @return UjoJob
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
     * @return UjoJob
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
     * @return UjoJob
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
     * Set maxExitSuccess
     *
     * @param integer $maxExitSuccess
     * @return UjoJob
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
     * Set nRetrys
     *
     * @param integer $nRetrys
     * @return UjoJob
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
     * Set numero
     *
     * @param integer $numero
     * @return UjoJob
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
     * Set overNum
     *
     * @param integer $overNum
     * @return UjoJob
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
     * Set overSeed
     *
     * @param integer $overSeed
     * @return UjoJob
     */
    public function setOverSeed($overSeed)
    {
        $this->overSeed = $overSeed;

        return $this;
    }

    /**
     * Get overSeed
     *
     * @return integer 
     */
    public function getOverSeed()
    {
        return $this->overSeed;
    }

    /**
     * Set owner
     *
     * @param string $owner
     * @return UjoJob
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
     * @return UjoJob
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
     * Set profile
     *
     * @param string $profile
     * @return UjoJob
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
     * Set sendNotification
     *
     * @param integer $sendNotification
     * @return UjoJob
     */
    public function setSendNotification($sendNotification)
    {
        $this->sendNotification = $sendNotification;

        return $this;
    }

    /**
     * Get sendNotification
     *
     * @return integer 
     */
    public function getSendNotification()
    {
        return $this->sendNotification;
    }

    /**
     * Set serviceDesk
     *
     * @param integer $serviceDesk
     * @return UjoJob
     */
    public function setServiceDesk($serviceDesk)
    {
        $this->serviceDesk = $serviceDesk;

        return $this;
    }

    /**
     * Get serviceDesk
     *
     * @return integer 
     */
    public function getServiceDesk()
    {
        return $this->serviceDesk;
    }

    /**
     * Set subApplication
     *
     * @param string $subApplication
     * @return UjoJob
     */
    public function setSubApplication($subApplication)
    {
        $this->subApplication = $subApplication;

        return $this;
    }

    /**
     * Get subApplication
     *
     * @return string 
     */
    public function getSubApplication()
    {
        return $this->subApplication;
    }

    /**
     * Set tag
     *
     * @param string $tag
     * @return UjoJob
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string 
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set updateStamp
     *
     * @param \DateTime $updateStamp
     * @return UjoJob
     */
    public function setUpdateStamp($updateStamp)
    {
        $this->updateStamp = $updateStamp;

        return $this;
    }

    /**
     * Get updateStamp
     *
     * @return \DateTime 
     */
    public function getUpdateStamp()
    {
        return $this->updateStamp;
    }

    /**
     * Set updateUserid
     *
     * @param string $updateUserid
     * @return UjoJob
     */
    public function setUpdateUserid($updateUserid)
    {
        $this->updateUserid = $updateUserid;

        return $this;
    }

    /**
     * Get updateUserid
     *
     * @return string 
     */
    public function getUpdateUserid()
    {
        return $this->updateUserid;
    }

    /**
     * Set wfJoid
     *
     * @param integer $wfJoid
     * @return UjoJob
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
     * Set hasNrCond
     *
     * @param integer $hasNrCond
     * @return UjoJob
     */
    public function setHasNrCond($hasNrCond)
    {
        $this->hasNrCond = $hasNrCond;

        return $this;
    }

    /**
     * Get hasNrCond
     *
     * @return integer 
     */
    public function getHasNrCond()
    {
        return $this->hasNrCond;
    }
}
