<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Exhibition
 *
 * @ORM\Table(name="exhibition")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ExhibitionRepository")
 */
class Exhibition
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
     * @ORM\Column(name="theme", type="string", length=50)
     */
    private $theme;
    public function setTheme($theme) {
        $this->theme = $theme;
        return $this;
    }
    public function getTheme() {
        return $this->theme;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=50, nullable=true, unique=true)
     */
    private $slug;
    public function setSlug($slug) {
        $this->slug = $slug;
        return $this;
    }
    public function getSlug() {
        return $this->slug;
    }

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="year", type="date", unique=true)
     */
    private $year;
    public function setYear($year) {
        $this->year = $year;
        return $this;
    }
    public function getYear() {
        return $this->year;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", unique=true)
     */
    private $date;
    public function setDate($date) {
        $this->date = $date;
        return $this;
    }
    public function getDate() {
        return $this->date;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="locationMap", type="string", length=50, nullable=true, unique=true)
     */
    private $locationMap;
    public function setLocationMap($locationMap) {
        $this->locationMap = $locationMap;
        return $this;
    }
    public function getLocationMap() {
        return $this->locationMap;
    }

    /**
     * @ORM\OneToMany(targetEntity="Event", mappedBy="exhibition")
     */
    protected $events;
    public function getEvents(){
        return $this->events;
    }

    /**
     * @ORM\OneToMany(targetEntity="Theme", mappedBy="exhibition")
     */
    protected $themes;
    public function getThemes(){
        return $this->themes;
    }

    /**
     * @ORM\OneToMany(targetEntity="Stall", mappedBy="exhibition")
     */
    protected $stalls;
    public function getStalls(){
        return $this->stalls;
    }

    public function __construct() {
        $this->events = new ArrayCollection();
        $this->stalls = new ArrayCollection();
        $this->themes = new ArrayCollection();
    }
}
