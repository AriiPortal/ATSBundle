<?php

namespace Arii\ATSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Autosys
 *
 * @ORM\Table(name="ATS_CHECK")
 * @ORM\Entity()
 */
class Check
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128, unique=true)
     */
    private $name;
    
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var  boolean
     *
     * @ORM\Column(name="status", type="integer" )
     */
    private $status;
    
    /**
     * @var \datetime
     *
     * @ORM\Column(name="executed", type="datetime", nullable=true)
     */
    private $executed;

    /**
     * @var int
     *
     * @ORM\Column(name="run_time", type="integer", nullable=true)
     */
    private $run_time;

    /**
     * @var int
     *
     * @ORM\Column(name="results", type="integer", nullable=true)
     */
    private $results;

    /**
     * @var int
     *
     * @ORM\Column(name="min_success", type="integer", nullable=true)
     */
    private $min_success;

    /**
     * @var int
     *
     * @ORM\Column(name="max_success", type="integer", nullable=true)
     */
    private $max_success;
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Check
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

    /**
     * Set title
     *
     * @param string $title
     * @return Check
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return Check
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set executed
     *
     * @param \DateTime $executed
     * @return Check
     */
    public function setExecuted($executed)
    {
        $this->executed = $executed;

        return $this;
    }

    /**
     * Get executed
     *
     * @return \DateTime 
     */
    public function getExecuted()
    {
        return $this->executed;
    }

    /**
     * Set run_time
     *
     * @param integer $runTime
     * @return Check
     */
    public function setRunTime($runTime)
    {
        $this->run_time = $runTime;

        return $this;
    }

    /**
     * Get run_time
     *
     * @return integer 
     */
    public function getRunTime()
    {
        return $this->run_time;
    }

    /**
     * Set results
     *
     * @param integer $results
     * @return Check
     */
    public function setResults($results)
    {
        $this->results = $results;

        return $this;
    }

    /**
     * Get results
     *
     * @return integer 
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * Set min_success
     *
     * @param integer $minSuccess
     * @return Check
     */
    public function setMinSuccess($minSuccess)
    {
        $this->min_success = $minSuccess;

        return $this;
    }

    /**
     * Get min_success
     *
     * @return integer 
     */
    public function getMinSuccess()
    {
        return $this->min_success;
    }

    /**
     * Set max_success
     *
     * @param integer $maxSuccess
     * @return Check
     */
    public function setMaxSuccess($maxSuccess)
    {
        $this->max_success = $maxSuccess;

        return $this;
    }

    /**
     * Get max_success
     *
     * @return integer 
     */
    public function getMaxSuccess()
    {
        return $this->max_success;
    }
}
