<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    public function getId(){
        return $this->id;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=50)
     */
    private $title;
    public function setTitle($title){
        $this->title = $title;
        return $this;
    }
    public function getTitle(){
        return $this->title;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=20)
     */
    private $type;
    public function setType($type){
        $this->type = $type;
        return $this;
    }
    public function getType(){
        return $this->type;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Theme")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $theme;
    public function setTheme($theme){
        $this->theme = $theme;
        return $this;
    }
    public function getTheme(){
        return $this->theme;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Stall")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $stall;
    public function setStall($stall){
        $this->stall = $stall;
        return $this;
    }
    public function getStall(){
        return $this->stall;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;
    public function setDescription($description){
        $this->description = $description;
        return $this;
    }
    public function getDescription(){
        return $this->description;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="detail", type="text", nullable=true)
     */
    private $detail;
    public function setDetail($detail){
        $this->detail = $detail;
        return $this;
    }
    public function getDetail(){
        return $this->detail;
    }
}
