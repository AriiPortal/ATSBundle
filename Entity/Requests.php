<?php

namespace Arii\ATSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cron
 *
 * @ORM\Table(name="ATS_REQUESTS")
 * @ORM\Entity(repositoryClass="Arii\ATSBundle\Entity\RequestsRepository")
 */
class Requests
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
     * @ORM\Column(name="name", type="string", length=64, nullable=true)
     */        
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="app_name", type="string", length=64, nullable=true)
     */        
    private $app_name;

    /**
     * @var string
     *
     * @ORM\Column(name="group_name", type="string", length=64, nullable=true)
     */        
    private $group_name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=64, nullable=true)
     */        
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="command", type="string", length=64, nullable=true)
     */        
    private $command;

    /**
     * @var string
     *
     * @ORM\Column(name="owner", type="string", length=64, nullable=true)
     */        
    private $owner;

    /**
     * @var string
     *
     * @ORM\Column(name="machine", type="string", length=64, nullable=true)
     */        
    private $machine;

    /**
     * @var string
     *
     * @ORM\Column(name="triggers", type="string", length=64, nullable=true)
     */        
    private $triggers;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=64, nullable=true)
     */        
    private $date;
    
    /**
     * @var string
     *
     * @ORM\Column(name="days_of_week", type="string", length=64, nullable=true)
     */        
    private $days_of_week;
    
    /**
     * @var string
     *
     * @ORM\Column(name="calendar", type="string", length=64, nullable=true)
     */        
    private $calendar;
    
    /**
     * @var string
     *
     * @ORM\Column(name="start_times", type="string", length=64, nullable=true)
     */        
    private $start_times;

    /**
     * @var string
     *
     * @ORM\Column(name="dependencies", type="string", length=64, nullable=true)
     */        
    private $dependencies;
    
    /**
     * @var string
     *
     * @ORM\Column(name="not_running", type="string", length=64, nullable=true)
     */        
    private $not_running;

    /**
     * @var string
     *
     * @ORM\Column(name="resources", type="string", length=64, nullable=true)
     */        
    private $resources;    
    
    /**
     * @var string
     *
     * @ORM\Column(name="resources_value", type="integer", nullable=true)
     */        
    private $resources_value;    
    

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
     * @return Requests
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
     * Set app_name
     *
     * @param string $appName
     * @return Requests
     */
    public function setAppName($appName)
    {
        $this->app_name = $appName;

        return $this;
    }

    /**
     * Get app_name
     *
     * @return string 
     */
    public function getAppName()
    {
        return $this->app_name;
    }

    /**
     * Set group_name
     *
     * @param string $groupName
     * @return Requests
     */
    public function setGroupName($groupName)
    {
        $this->group_name = $groupName;

        return $this;
    }

    /**
     * Get group_name
     *
     * @return string 
     */
    public function getGroupName()
    {
        return $this->group_name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Requests
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
     * Set command
     *
     * @param string $command
     * @return Requests
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
     * Set owner
     *
     * @param string $owner
     * @return Requests
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
     * Set machine
     *
     * @param string $machine
     * @return Requests
     */
    public function setMachine($machine)
    {
        $this->machine = $machine;

        return $this;
    }

    /**
     * Get machine
     *
     * @return string 
     */
    public function getMachine()
    {
        return $this->machine;
    }

    /**
     * Set triggers
     *
     * @param string $triggers
     * @return Requests
     */
    public function setTriggers($triggers)
    {
        $this->triggers = $triggers;

        return $this;
    }

    /**
     * Get triggers
     *
     * @return string 
     */
    public function getTriggers()
    {
        return $this->triggers;
    }

    /**
     * Set date
     *
     * @param string $date
     * @return Requests
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set days_of_week
     *
     * @param string $daysOfWeek
     * @return Requests
     */
    public function setDaysOfWeek($daysOfWeek)
    {
        $this->days_of_week = $daysOfWeek;

        return $this;
    }

    /**
     * Get days_of_week
     *
     * @return string 
     */
    public function getDaysOfWeek()
    {
        return $this->days_of_week;
    }

    /**
     * Set calendar
     *
     * @param string $calendar
     * @return Requests
     */
    public function setCalendar($calendar)
    {
        $this->calendar = $calendar;

        return $this;
    }

    /**
     * Get calendar
     *
     * @return string 
     */
    public function getCalendar()
    {
        return $this->calendar;
    }

    /**
     * Set start_times
     *
     * @param string $startTimes
     * @return Requests
     */
    public function setStartTimes($startTimes)
    {
        $this->start_times = $startTimes;

        return $this;
    }

    /**
     * Get start_times
     *
     * @return string 
     */
    public function getStartTimes()
    {
        return $this->start_times;
    }

    /**
     * Set dependencies
     *
     * @param string $dependencies
     * @return Requests
     */
    public function setDependencies($dependencies)
    {
        $this->dependencies = $dependencies;

        return $this;
    }

    /**
     * Get dependencies
     *
     * @return string 
     */
    public function getDependencies()
    {
        return $this->dependencies;
    }

    /**
     * Set not_running
     *
     * @param string $notRunning
     * @return Requests
     */
    public function setNotRunning($notRunning)
    {
        $this->not_running = $notRunning;

        return $this;
    }

    /**
     * Get not_running
     *
     * @return string 
     */
    public function getNotRunning()
    {
        return $this->not_running;
    }

    /**
     * Set resources
     *
     * @param string $resources
     * @return Requests
     */
    public function setResources($resources)
    {
        $this->resources = $resources;

        return $this;
    }

    /**
     * Get resources
     *
     * @return string 
     */
    public function getResources()
    {
        return $this->resources;
    }

    /**
     * Set resources_value
     *
     * @param integer $resourcesValue
     * @return Requests
     */
    public function setResourcesValue($resourcesValue)
    {
        $this->resources_value = $resourcesValue;

        return $this;
    }

    /**
     * Get resources_value
     *
     * @return integer 
     */
    public function getResourcesValue()
    {
        return $this->resources_value;
    }
}
