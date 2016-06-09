<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Privilege
 *
 * @ORM\Table(name="privilege")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PrivilegeRepository")
 */
class Privilege
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
     * @ORM\Column(name="name", type="string", length=20, unique=true)
     */
    private $name;
    public function setName($name){
        $this->name = $name;
        return $this;
    }
    public function getName(){
        return $this->name;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=50, nullable=true, unique=true)
     */
    private $slug;
    public function setSlug($slug){
        $this->slug = $slug;
        return $this;
    }
    public function getSlug(){
        return $this->slug;
    }

    /**
     * @ORM\OneToMany(targetEntity="Member", mappedBy="privilege")
     */
    protected $members;
    public function getMembers(){
        return $this->members;
    }

    public function __construct() {
        $this->attendees = new ArrayCollection();
    }
}
