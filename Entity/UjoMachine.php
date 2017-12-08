<?php

namespace Arii\ATSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UjoMachine
 *
 * @ORM\Table(name="UJO_MACHINE", indexes={@ORM\Index(name="xak1jo_machine", columns={"QUE_NAME"})})
 * @ORM\Entity(readOnly=true)
 */
class UjoMachine
{
    /**
     * @var string
     *
     * @ORM\Column(name="ADMINISTRATOR", type="string", length=64, nullable=true)
     */
    private $administrator;

    /**
     * @var string
     *
     * @ORM\Column(name="AGENT_NAME", type="string", length=80, nullable=true)
     */
    private $agentName;

    /**
     * @var string
     *
     * @ORM\Column(name="CHARACTER_CODE", type="string", length=36, nullable=true)
     */
    private $characterCode;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPTION", type="string", length=256, nullable=true)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="FACTOR", type="float", precision=126, scale=0, nullable=true)
     */
    private $factor;

    /**
     * @var integer
     *
     * @ORM\Column(name="HEARTBEAT_ATTEMPTS", type="integer", nullable=true)
     */
    private $heartbeatAttempts;

    /**
     * @var integer
     *
     * @ORM\Column(name="HEARTBEAT_FREQ", type="integer", nullable=true)
     */
    private $heartbeatFreq;

    /**
     * @var string
     *
     * @ORM\Column(name="MACH_NAME", type="string", length=80, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $machName;

    /**
     * @var string
     *
     * @ORM\Column(name="MACH_STATUS", type="string", length=1, nullable=true)
     */
    private $machStatus;

    /**
     * @var integer
     *
     * @ORM\Column(name="MAX_LOAD", type="integer", nullable=true)
     */
    private $maxLoad;

    /**
     * @var string
     *
     * @ORM\Column(name="NODE_NAME", type="string", length=80, nullable=true)
     */
    private $nodeName;

    /**
     * @var integer
     *
     * @ORM\Column(name="OPSYS", type="smallint", nullable=true)
     */
    private $opsys;

    /**
     * @var string
     *
     * @ORM\Column(name="PARENT_NAME", type="string", length=80, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $parentName;

    /**
     * @var integer
     *
     * @ORM\Column(name="PORT", type="integer", nullable=true)
     */
    private $port;

    /**
     * @var string
     *
     * @ORM\Column(name="PREPJOBID", type="string", length=64, nullable=true)
     */
    private $prepjobid;

    /**
     * @var integer
     *
     * @ORM\Column(name="PROVISION", type="smallint", nullable=true)
     */
    private $provision;

    /**
     * @var string
     *
     * @ORM\Column(name="QUE_NAME", type="string", length=161, nullable=true)
     */
    private $queName;

    /**
     * @var string
     *
     * @ORM\Column(name="TYPE", type="string", length=1, nullable=true)
     */
    private $type;



    /**
     * Set administrator
     *
     * @param string $administrator
     * @return UjoMachine
     */
    public function setAdministrator($administrator)
    {
        $this->administrator = $administrator;

        return $this;
    }

    /**
     * Get administrator
     *
     * @return string 
     */
    public function getAdministrator()
    {
        return $this->administrator;
    }

    /**
     * Set agentName
     *
     * @param string $agentName
     * @return UjoMachine
     */
    public function setAgentName($agentName)
    {
        $this->agentName = $agentName;

        return $this;
    }

    /**
     * Get agentName
     *
     * @return string 
     */
    public function getAgentName()
    {
        return $this->agentName;
    }

    /**
     * Set characterCode
     *
     * @param string $characterCode
     * @return UjoMachine
     */
    public function setCharacterCode($characterCode)
    {
        $this->characterCode = $characterCode;

        return $this;
    }

    /**
     * Get characterCode
     *
     * @return string 
     */
    public function getCharacterCode()
    {
        return $this->characterCode;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return UjoMachine
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
     * Set factor
     *
     * @param float $factor
     * @return UjoMachine
     */
    public function setFactor($factor)
    {
        $this->factor = $factor;

        return $this;
    }

    /**
     * Get factor
     *
     * @return float 
     */
    public function getFactor()
    {
        return $this->factor;
    }

    /**
     * Set heartbeatAttempts
     *
     * @param integer $heartbeatAttempts
     * @return UjoMachine
     */
    public function setHeartbeatAttempts($heartbeatAttempts)
    {
        $this->heartbeatAttempts = $heartbeatAttempts;

        return $this;
    }

    /**
     * Get heartbeatAttempts
     *
     * @return integer 
     */
    public function getHeartbeatAttempts()
    {
        return $this->heartbeatAttempts;
    }

    /**
     * Set heartbeatFreq
     *
     * @param integer $heartbeatFreq
     * @return UjoMachine
     */
    public function setHeartbeatFreq($heartbeatFreq)
    {
        $this->heartbeatFreq = $heartbeatFreq;

        return $this;
    }

    /**
     * Get heartbeatFreq
     *
     * @return integer 
     */
    public function getHeartbeatFreq()
    {
        return $this->heartbeatFreq;
    }

    /**
     * Set machName
     *
     * @param string $machName
     * @return UjoMachine
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
     * Set machStatus
     *
     * @param string $machStatus
     * @return UjoMachine
     */
    public function setMachStatus($machStatus)
    {
        $this->machStatus = $machStatus;

        return $this;
    }

    /**
     * Get machStatus
     *
     * @return string 
     */
    public function getMachStatus()
    {
        return $this->machStatus;
    }

    /**
     * Set maxLoad
     *
     * @param integer $maxLoad
     * @return UjoMachine
     */
    public function setMaxLoad($maxLoad)
    {
        $this->maxLoad = $maxLoad;

        return $this;
    }

    /**
     * Get maxLoad
     *
     * @return integer 
     */
    public function getMaxLoad()
    {
        return $this->maxLoad;
    }

    /**
     * Set nodeName
     *
     * @param string $nodeName
     * @return UjoMachine
     */
    public function setNodeName($nodeName)
    {
        $this->nodeName = $nodeName;

        return $this;
    }

    /**
     * Get nodeName
     *
     * @return string 
     */
    public function getNodeName()
    {
        return $this->nodeName;
    }

    /**
     * Set opsys
     *
     * @param integer $opsys
     * @return UjoMachine
     */
    public function setOpsys($opsys)
    {
        $this->opsys = $opsys;

        return $this;
    }

    /**
     * Get opsys
     *
     * @return integer 
     */
    public function getOpsys()
    {
        return $this->opsys;
    }

    /**
     * Set parentName
     *
     * @param string $parentName
     * @return UjoMachine
     */
    public function setParentName($parentName)
    {
        $this->parentName = $parentName;

        return $this;
    }

    /**
     * Get parentName
     *
     * @return string 
     */
    public function getParentName()
    {
        return $this->parentName;
    }

    /**
     * Set port
     *
     * @param integer $port
     * @return UjoMachine
     */
    public function setPort($port)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * Get port
     *
     * @return integer 
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Set prepjobid
     *
     * @param string $prepjobid
     * @return UjoMachine
     */
    public function setPrepjobid($prepjobid)
    {
        $this->prepjobid = $prepjobid;

        return $this;
    }

    /**
     * Get prepjobid
     *
     * @return string 
     */
    public function getPrepjobid()
    {
        return $this->prepjobid;
    }

    /**
     * Set provision
     *
     * @param integer $provision
     * @return UjoMachine
     */
    public function setProvision($provision)
    {
        $this->provision = $provision;

        return $this;
    }

    /**
     * Get provision
     *
     * @return integer 
     */
    public function getProvision()
    {
        return $this->provision;
    }

    /**
     * Set queName
     *
     * @param string $queName
     * @return UjoMachine
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
     * Set type
     *
     * @param string $type
     * @return UjoMachine
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }
}
