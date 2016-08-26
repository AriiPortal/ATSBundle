<?php

namespace Arii\ATSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cron
 *
 * @ORM\Table(name="ATS_NOTES")
 * @ORM\Entity(repositoryClass="Arii\ATSBundle\Entity\RequestsRepository")
 */
class Notes
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
     * @ORM\Column(name="job_type", type="string", length=10, nullable=true)
     */        
    private $job_type="job";

    /**
     * @var string
     *
     * @ORM\Column(name="job_name", type="string", length=64, nullable=true)
     */        
    private $job_name;
    
    /**
     * @var string
     *
     * @ORM\Column(name="job_desc", type="string", length=255, nullable=true)
     */        
    private $job_desc;

    /**
     * @var string
     *
     * @ORM\Column(name="job_note", type="string", length=1024, nullable=true)
     */        
    private $job_note;
    
    /**
    * @ORM\ManyToOne(targetEntity="Arii\ATSBundle\Entity\Notes")
    * @ORM\JoinColumn(nullable=true)
    */
    private $template;

    /**
     * @var string
     *
     * @ORM\Column(name="is_template", type="boolean" )
     */        
    private $is_template=false;
    
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
     * Set job_type
     *
     * @param string $jobType
     * @return Notes
     */
    public function setJobType($jobType)
    {
        $this->job_type = $jobType;

        return $this;
    }

    /**
     * Get job_type
     *
     * @return string 
     */
    public function getJobType()
    {
        return $this->job_type;
    }

    /**
     * Set job_name
     *
     * @param string $jobName
     * @return Notes
     */
    public function setJobName($jobName)
    {
        $this->job_name = $jobName;

        return $this;
    }

    /**
     * Get job_name
     *
     * @return string 
     */
    public function getJobName()
    {
        return $this->job_name;
    }

    /**
     * Set job_desc
     *
     * @param string $jobDesc
     * @return Notes
     */
    public function setJobDesc($jobDesc)
    {
        $this->job_desc = $jobDesc;

        return $this;
    }

    /**
     * Get job_desc
     *
     * @return string 
     */
    public function getJobDesc()
    {
        return $this->job_desc;
    }

    /**
     * Set job_note
     *
     * @param string $jobNote
     * @return Notes
     */
    public function setJobNote($jobNote)
    {
        $this->job_note = $jobNote;

        return $this;
    }

    /**
     * Get job_note
     *
     * @return string 
     */
    public function getJobNote()
    {
        return $this->job_note;
    }

    /**
     * Set is_template
     *
     * @param boolean $isTemplate
     * @return Notes
     */
    public function setIsTemplate($isTemplate)
    {
        $this->is_template = $isTemplate;

        return $this;
    }

    /**
     * Get is_template
     *
     * @return boolean 
     */
    public function getIsTemplate()
    {
        return $this->is_template;
    }

    /**
     * Set template
     *
     * @param \Arii\ATSBundle\Entity\Notes $template
     * @return Notes
     */
    public function setTemplate(\Arii\ATSBundle\Entity\Notes $template = null)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Get template
     *
     * @return \Arii\ATSBundle\Entity\Notes 
     */
    public function getTemplate()
    {
        return $this->template;
    }
}
