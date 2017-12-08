<?php

namespace Arii\ATSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UjoCalendar
 *
 * @ORM\Table(name="UJO_CALENDAR")
 * @ORM\Entity(readOnly=true)
 */
class UjoCalendar
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CAL_ID", type="integer", nullable=false)
     */
    private $calId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DAY", type="date", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $day;

    /**
     * @var string
     *
     * @ORM\Column(name="NAME", type="string", length=64, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $name;



    /**
     * Set calId
     *
     * @param integer $calId
     * @return UjoCalendar
     */
    public function setCalId($calId)
    {
        $this->calId = $calId;

        return $this;
    }

    /**
     * Get calId
     *
     * @return integer 
     */
    public function getCalId()
    {
        return $this->calId;
    }

    /**
     * Set day
     *
     * @param \DateTime $day
     * @return UjoCalendar
     */
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return \DateTime 
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return UjoCalendar
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
}
