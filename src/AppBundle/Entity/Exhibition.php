<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Exhibition
 */
class Exhibition
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $date;

    /**
     * @var string
     */
    private $theme;

    /**
     * @var string
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
