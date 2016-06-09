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
     */
    private $id;
    public function getId() {
        return $this->id;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="number", type="integer")
     */
    private $number;
    public function setNumber($number) {
        $this->number = $number;
        return $this;
    }
    public function getNumber() {
        return $this->number;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Exhibition", inversedBy="stalls")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $exhibition;
    public function setExhibition($exhibition) {
        $this->exhibition = $exhibition;
        return $this;
    }
    public function getExhibition() {
        return $this->exhibition;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="size", type="string", length=1)
     */
    private $size;
    public function setSize($size) {
        $this->size = $size;
        return $this;
    }
    public function getSize() {
        return $this->size;
    }
}
