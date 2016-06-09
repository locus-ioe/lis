<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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

    /**
     * @var string
     *
     * @ORM\Column(name="theme", type="string", length=50)
     */
    private $theme;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=50, nullable=true, unique=true)
     */
    private $slug;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="year", type="date", unique=true)
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", unique=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="locationMap", type="string", length=50, nullable=true, unique=true)
     */
    private $locationMap;


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
     * Set theme
     *
     * @param string $theme
     * @return Exhibition
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Exhibiion
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set year
     *
     * @param \DateTime $year
     * @return Exhibition
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return \DateTime
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set date
     *
     * @param string $date
     * @return Exhibition
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
     * Set locationMap
     *
     * @param string $locationMap
     * @return Exhibition
     */
    public function setLocationMap($locationMap)
    {
        $this->locationMap = $locationMap;

        return $this;
    }

    /**
     * Get locationMap
     *
     * @return string
     */
    public function getLocationMap()
    {
        return $this->locationMap;
    }
}
