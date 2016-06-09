<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Theme
 *
 * @ORM\Table(name="theme")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ThemeRepository")
 */
class Theme
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=30)
     */
    private $name;
    public function setName($name) {
        $this->name = $name;
        return $this;
    }
    public function getName() {
        return $this->name;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Exhibition", inversedBy="themes")
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
}
