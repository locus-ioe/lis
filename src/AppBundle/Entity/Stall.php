<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stall
 *
 * @ORM\Table(name="stall")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StallRepository")
 */
class Stall
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @ORM\OneToMany(targetEntity="InstitutionStall", mappedBy="stallID")
     * @ORM\OneToMany(targetEntity="Project", mappedBy="stallID")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="number", type="integer")
     */
    private $number;

    /**
     * @var int
     *
     * @ORM\Column(name="exhibitionID", type="integer")
     */
    private $exhibitionID;

    /**
     * @var string
     *
     * @ORM\Column(name="size", type="string", length=1)
     */
    private $size;


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
     * Set number
     *
     * @param integer $number
     * @return Stall
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set exhibitionID
     *
     * @param integer $exhibitionID
     * @return Stall
     */
    public function setExhibitionID($exhibitionID)
    {
        $this->exhibitionID = $exhibitionID;

        return $this;
    }

    /**
     * Get exhibitionID
     *
     * @return integer
     */
    public function getExhibitionID()
    {
        return $this->exhibitionID;
    }

    /**
     * Set size
     *
     * @param string $size
     * @return Stall
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }
}
