<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 */
class Project
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $type;

    /**
     * @var int
     */
    private $themeID;

    /**
     * @var int
     */
    private $stallID;

    /**
     * @var string
     */
    private $description;


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
     * Set title
     *
     * @param string $title
     * @return Project
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Project
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set themeID
     *
     * @param integer $themeID
     * @return Project
     */
    public function setThemeID($themeID)
    {
        $this->themeID = $themeID;

        return $this;
    }

    /**
     * Get themeID
     *
     * @return integer 
     */
    public function getThemeID()
    {
        return $this->themeID;
    }

    /**
     * Set stallID
     *
     * @param integer $stallID
     * @return Project
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

    /**
     * Set description
     *
     * @param string $description
     * @return Project
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
}
