<?php

namespace Arii\ATSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UjoCred
 *
 * @ORM\Table(name="UJO_CRED")
 * @ORM\Entity(readOnly=true)
 */
class UjoCred
{
    /**
     * @var string
     *
     * @ORM\Column(name="CRED_DOMAIN", type="string", length=8, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $credDomain;

    /**
     * @var string
     *
     * @ORM\Column(name="CRED_VALUE", type="string", length=64, nullable=true)
     */
    private $credValue;

    /**
     * @var string
     *
     * @ORM\Column(name="DOMAIN_NAME", type="string", length=80, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $domainName;

    /**
     * @var string
     *
     * @ORM\Column(name="OWNER", type="string", length=145, nullable=true)
     */
    private $owner;

    /**
     * @var string
     *
     * @ORM\Column(name="PRINCIPAL", type="string", length=64, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $principal;

    /**
     * @var string
     *
     * @ORM\Column(name="KEYFILE", type="string", length=256, nullable=true)
     */
    private $keyfile;

    /**
     * @var string
     *
     * @ORM\Column(name="PASSPHRASE", type="string", length=256, nullable=true)
     */
    private $passphrase;

    /**
     * @var integer
     *
     * @ORM\Column(name="CRED_TYPE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $credType;



    /**
     * Set credDomain
     *
     * @param string $credDomain
     * @return UjoCred
     */
    public function setCredDomain($credDomain)
    {
        $this->credDomain = $credDomain;

        return $this;
    }

    /**
     * Get credDomain
     *
     * @return string 
     */
    public function getCredDomain()
    {
        return $this->credDomain;
    }

    /**
     * Set credValue
     *
     * @param string $credValue
     * @return UjoCred
     */
    public function setCredValue($credValue)
    {
        $this->credValue = $credValue;

        return $this;
    }

    /**
     * Get credValue
     *
     * @return string 
     */
    public function getCredValue()
    {
        return $this->credValue;
    }

    /**
     * Set domainName
     *
     * @param string $domainName
     * @return UjoCred
     */
    public function setDomainName($domainName)
    {
        $this->domainName = $domainName;

        return $this;
    }

    /**
     * Get domainName
     *
     * @return string 
     */
    public function getDomainName()
    {
        return $this->domainName;
    }

    /**
     * Set owner
     *
     * @param string $owner
     * @return UjoCred
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
     * Set principal
     *
     * @param string $principal
     * @return UjoCred
     */
    public function setPrincipal($principal)
    {
        $this->principal = $principal;

        return $this;
    }

    /**
     * Get principal
     *
     * @return string 
     */
    public function getPrincipal()
    {
        return $this->principal;
    }

    /**
     * Set keyfile
     *
     * @param string $keyfile
     * @return UjoCred
     */
    public function setKeyfile($keyfile)
    {
        $this->keyfile = $keyfile;

        return $this;
    }

    /**
     * Get keyfile
     *
     * @return string 
     */
    public function getKeyfile()
    {
        return $this->keyfile;
    }

    /**
     * Set passphrase
     *
     * @param string $passphrase
     * @return UjoCred
     */
    public function setPassphrase($passphrase)
    {
        $this->passphrase = $passphrase;

        return $this;
    }

    /**
     * Get passphrase
     *
     * @return string 
     */
    public function getPassphrase()
    {
        return $this->passphrase;
    }

    /**
     * Set credType
     *
     * @param integer $credType
     * @return UjoCred
     */
    public function setCredType($credType)
    {
        $this->credType = $credType;

        return $this;
    }

    /**
     * Get credType
     *
     * @return integer 
     */
    public function getCredType()
    {
        return $this->credType;
    }
}
