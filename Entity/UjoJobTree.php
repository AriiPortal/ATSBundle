<?php

namespace Arii\ATSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UjoJobTree
 *
 * @ORM\Table(name="UJO_JOB_TREE")
 * @ORM\Entity(readOnly=true)
 */
class UjoJobTree
{
    /**
     * @var integer
     *
     * @ORM\Column(name="DEPTH", type="integer", nullable=true)
     */
    private $depth;

    /**
     * @var integer
     *
     * @ORM\Column(name="JOID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="UJO_JOB_TREE_JOID_seq", allocationSize=1, initialValue=1)
     */
    private $joid;

    /**
     * @var string
     *
     * @ORM\Column(name="LINEAGE", type="string", length=2048, nullable=true)
     */
    private $lineage;

    /**
     * @var integer
     *
     * @ORM\Column(name="PARENT_JOID", type="integer", nullable=true)
     */
    private $parentJoid;



    /**
     * Set depth
     *
     * @param integer $depth
     * @return UjoJobTree
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;

        return $this;
    }

    /**
     * Get depth
     *
     * @return integer 
     */
    public function getDepth()
    {
        return $this->depth;
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
     * Set lineage
     *
     * @param string $lineage
     * @return UjoJobTree
     */
    public function setLineage($lineage)
    {
        $this->lineage = $lineage;

        return $this;
    }

    /**
     * Get lineage
     *
     * @return string 
     */
    public function getLineage()
    {
        return $this->lineage;
    }

    /**
     * Set parentJoid
     *
     * @param integer $parentJoid
     * @return UjoJobTree
     */
    public function setParentJoid($parentJoid)
    {
        $this->parentJoid = $parentJoid;

        return $this;
    }

    /**
     * Get parentJoid
     *
     * @return integer 
     */
    public function getParentJoid()
    {
        return $this->parentJoid;
    }
}
