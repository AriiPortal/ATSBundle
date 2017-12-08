<?php

namespace Arii\ATSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UjoAlamode
 *
 * @ORM\Table(name="UJO_ALAMODE")
 * @ORM\Entity(readOnly=true)
 */
class UjoAlamode
{
    /**
     * @var integer
     *
     * @ORM\Column(name="INT_VAL", type="integer", nullable=true)
     */
    private $intVal;

    /**
     * @var string
     *
     * @ORM\Column(name="STR_VAL", type="string", length=255, nullable=true)
     */
    private $strVal;

    /**
     * @var string
     *
     * @ORM\Column(name="TYPE", type="string", length=20, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="UJO_ALAMODE_TYPE_seq", allocationSize=1, initialValue=1)
     */
    private $type;



    /**
     * Set intVal
     *
     * @param integer $intVal
     * @return UjoAlamode
     */
    public function setIntVal($intVal)
    {
        $this->intVal = $intVal;

        return $this;
    }

    /**
     * Get intVal
     *
     * @return integer 
     */
    public function getIntVal()
    {
        return $this->intVal;
    }

    /**
     * Set strVal
     *
     * @param string $strVal
     * @return UjoAlamode
     */
    public function setStrVal($strVal)
    {
        $this->strVal = $strVal;

        return $this;
    }

    /**
     * Get strVal
     *
     * @return string 
     */
    public function getStrVal()
    {
        return $this->strVal;
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
