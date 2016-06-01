<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InstitutionStall
 *
 * @ORM\Table(name="institution_stall")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InstitutionStallRepository")
 */
class InstitutionStall
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="institutionID", type="integer")
     */
    private $institutionID;

    /**
     * @var int
     *
     * @ORM\Column(name="stallID", type="integer")
     */
    private $stallID;


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
     * Set institutionID
     *
     * @param integer $institutionID
     * @return InstitutionStall
     */
    public function setInstitutionID($institutionID)
    {
        $this->institutionID = $institutionID;

        return $this;
    }

    /**
     * Get institutionID
     *
     * @return integer 
     */
    public function getInstitutionID()
    {
        return $this->institutionID;
    }

    /**
     * Set stallID
     *
     * @param integer $stallID
     * @return InstitutionStall
     */
    public function setStallID($stallID)
    {
        $this->stallID = $stallID;

        return $this;
    }

    /**
     * Get stallID
     *
     * @return integer 
     */
    public function getStallID()
    {
        return $this->stallID;
    }
}
