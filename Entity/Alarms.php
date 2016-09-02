<?php

namespace Arii\ATSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cron
 *
 * @ORM\Table(name="ATS_ALARMS")
 * @ORM\Entity(repositoryClass="Arii\ATSBundle\Entity\AlarmsRepository")
 */
class Alarms
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
    * @ORM\ManyToOne(targetEntity="Arii\ATSBundle\Entity\Notes")
    * @ORM\JoinColumn(nullable=true)
    */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=16, nullable=true)
     */        
    private $status;
    
    /**
     * @var string
     *
     * @ORM\Column(name="exit_code", type="string", length=255, nullable=true)
     */        
    private $exit_codes;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=255, nullable=true)
     */        
    private $message;
    
    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=255, nullable=true)
     */        
    private $category;
    
    /**
     * @var string
     *
     * @ORM\Column(name="help", type="string", length=1024, nullable=true)
     */        
    private $todo;
    /**
     * @var string
     *
     * @ORM\Column(name="to", type="string", length=255, nullable=true)
     */        
    private $to;
    
    /**
     * @var string
     *
     * @ORM\Column(name="cc", type="string", length=255, nullable=true)
     */        
    private $cc;
    
    // Activer l'alarme
    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean" )
     */        
    private $active=true;
   

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
     * Set status
     *
     * @param string $status
     * @return Alarms
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set exit_codes
     *
     * @param string $exitCodes
     * @return Alarms
     */
    public function setExitCodes($exitCodes)
    {
        $this->exit_codes = $exitCodes;

        return $this;
    }

    /**
     * Get exit_codes
     *
     * @return string 
     */
    public function getExitCodes()
    {
        return $this->exit_codes;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return Alarms
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set to
     *
     * @param string $to
     * @return Alarms
     */
    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Get to
     *
     * @return string 
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Set cc
     *
     * @param string $cc
     * @return Alarms
     */
    public function setCc($cc)
    {
        $this->cc = $cc;

        return $this;
    }

    /**
     * Get cc
     *
     * @return string 
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return Alarms
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set note
     *
     * @param \Arii\ATSBundle\Entity\Notes $note
     * @return Alarms
     */
    public function setNote(\Arii\ATSBundle\Entity\Notes $note = null)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return \Arii\ATSBundle\Entity\Notes 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set todo
     *
     * @param string $todo
     * @return Alarms
     */
    public function setTodo($todo)
    {
        $this->todo = $todo;

        return $this;
    }

    /**
     * Get todo
     *
     * @return string 
     */
    public function getTodo()
    {
        return $this->todo;
    }

    /**
     * Set category
     *
     * @param string $category
     * @return Alarms
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
