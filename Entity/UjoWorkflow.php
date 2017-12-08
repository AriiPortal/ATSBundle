<?php

namespace Arii\ATSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UjoWorkflow
 *
 * @ORM\Table(name="UJO_WORKFLOW", indexes={@ORM\Index(name="xak2ujo_workflow", columns={"JOID", "IS_ACTIVE", "IS_CURRVER"}), @ORM\Index(name="xak3ujo_workflow", columns={"WF_NAME", "IS_ACTIVE", "IS_CURRVER"}), @ORM\Index(name="xak1ujo_workflow", columns={"WF_NAME", "WF_VER"})})
 * @ORM\Entity(readOnly=true)
 */
class UjoWorkflow
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CREATE_TIME", type="date", nullable=true)
     */
    private $createTime;

    /**
     * @var string
     *
     * @ORM\Column(name="CREATE_USERID", type="string", length=80, nullable=true)
     */
    private $createUserid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DELETE_TIME", type="date", nullable=true)
     */
    private $deleteTime;

    /**
     * @var string
     *
     * @ORM\Column(name="DELETE_USERID", type="string", length=80, nullable=true)
     */
    private $deleteUserid;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPTION", type="string", length=256, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="DOMAIN", type="string", length=64, nullable=true)
     */
    private $domain;

    /**
     * @var integer
     *
     * @ORM\Column(name="GENERATION", type="integer", nullable=false)
     */
    private $generation;

    /**
     * @var integer
     *
     * @ORM\Column(name="HAS_CONDITION", type="smallint", nullable=true)
     */
    private $hasCondition;

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
     * @ORM\Column(name="RUN_NAME", type="string", length=64, nullable=true)
     */
    private $runName;

    /**
     * @var integer
     *
     * @ORM\Column(name="RUN_NUM", type="integer", nullable=false)
     */
    private $runNum;

    /**
     * @var string
     *
     * @ORM\Column(name="STATE", type="string", length=64, nullable=true)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="TAG", type="string", length=64, nullable=true)
     */
    private $tag;

    /**
     * @var string
     *
     * @ORM\Column(name="WF_NAME", type="string", length=128, nullable=false)
     */
    private $wfName;

    /**
     * @var integer
     *
     * @ORM\Column(name="WF_VER", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $wfVer;



    /**
     * Set createTime
     *
     * @param \DateTime $createTime
     * @return UjoWorkflow
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;

        return $this;
    }

    /**
     * Get createTime
     *
     * @return \DateTime 
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * Set createUserid
     *
     * @param string $createUserid
     * @return UjoWorkflow
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
     * Set deleteTime
     *
     * @param \DateTime $deleteTime
     * @return UjoWorkflow
     */
    public function setDeleteTime($deleteTime)
    {
        $this->deleteTime = $deleteTime;

        return $this;
    }

    /**
     * Get deleteTime
     *
     * @return \DateTime 
     */
    public function getDeleteTime()
    {
        return $this->deleteTime;
    }

    /**
     * Set deleteUserid
     *
     * @param string $deleteUserid
     * @return UjoWorkflow
     */
    public function setDeleteUserid($deleteUserid)
    {
        $this->deleteUserid = $deleteUserid;

        return $this;
    }

    /**
     * Get deleteUserid
     *
     * @return string 
     */
    public function getDeleteUserid()
    {
        return $this->deleteUserid;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return UjoWorkflow
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
     * Set domain
     *
     * @param string $domain
     * @return UjoWorkflow
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return string 
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set generation
     *
     * @param integer $generation
     * @return UjoWorkflow
     */
    public function setGeneration($generation)
    {
        $this->generation = $generation;

        return $this;
    }

    /**
     * Get generation
     *
     * @return integer 
     */
    public function getGeneration()
    {
        return $this->generation;
    }

    /**
     * Set hasCondition
     *
     * @param integer $hasCondition
     * @return UjoWorkflow
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
     * Set isActive
     *
     * @param integer $isActive
     * @return UjoWorkflow
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
     * @return UjoWorkflow
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
     * Set joid
     *
     * @param integer $joid
     * @return UjoWorkflow
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
     * @return UjoWorkflow
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
     * Set owner
     *
     * @param string $owner
     * @return UjoWorkflow
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
     * @return UjoWorkflow
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
     * Set runName
     *
     * @param string $runName
     * @return UjoWorkflow
     */
    public function setRunName($runName)
    {
        $this->runName = $runName;

        return $this;
    }

    /**
     * Get runName
     *
     * @return string 
     */
    public function getRunName()
    {
        return $this->runName;
    }

    /**
     * Set runNum
     *
     * @param integer $runNum
     * @return UjoWorkflow
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
     * Set state
     *
     * @param string $state
     * @return UjoWorkflow
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set tag
     *
     * @param string $tag
     * @return UjoWorkflow
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
     * Set wfName
     *
     * @param string $wfName
     * @return UjoWorkflow
     */
    public function setWfName($wfName)
    {
        $this->wfName = $wfName;

        return $this;
    }

    /**
     * Get wfName
     *
     * @return string 
     */
    public function getWfName()
    {
        return $this->wfName;
    }

    /**
     * Set wfVer
     *
     * @param integer $wfVer
     * @return UjoWorkflow
     */
    public function setWfVer($wfVer)
    {
        $this->wfVer = $wfVer;

        return $this;
    }

    /**
     * Get wfVer
     *
     * @return integer 
     */
    public function getWfVer()
    {
        return $this->wfVer;
    }
}
