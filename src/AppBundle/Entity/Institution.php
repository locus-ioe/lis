<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Institution
 *
 * @ORM\Table(name="institution")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InstitutionRepository")
 */
class Institution
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
     * @ORM\Column(name="name", type="string", length=50)
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
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=99)
     */
    private $address;
    public function setAddress($address){
        $this->address = $address;
        return $this;
    }
    public function getAddress(){
        return $this->address;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="string", length=15)
     */
    private $contact;
    public function setContact($contact){
        $this->contact = $contact;
        return $this;
    }
    public function getContact(){
        return $this->contact;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=40)
     */
    private $email;
    public function setEmail($email){
        $this->email = $email;
        return $this;
    }
    public function getEmail(){
        return $this->email;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=30, nullable=true, unique=true)
     */
    private $logo;
    public function setLogo($logo){
        $this->logo = $logo;
        return $this;
    }
    public function getLogo(){
        return $this->logo;
    }

    /**
     * @ORM\ManyToMany(targetEntity="Event", mappedBy="collaborators")
     */
    protected $collaborating;
    public function getCollaborating() {
        return $this->collaborating;
    }

    /**
     * @ORM\ManyToMany(targetEntity="Stall", inversedBy="institutions")
     * @ORM\JoinTable("institution_stalls")
     */
    protected $stalls;
    public function getStalls() {
        return $this->stalls;
    }

    /**
     * @ORM\OneToMany(targetEntity="Finance", mappedBy="institution")
     */
    protected $finances;
    public function getFinances(){
        return $this->finances;
    }

    /**
     * @ORM\OneToMany(targetEntity="Member", mappedBy="institution")
     */
    protected $members;
    public function getMembers(){
        return $this->members;
    }

    public function __construct() {
        $this->collaborating = new ArrayCollection();
        $this->finances = new ArrayCollection();
        $this->members = new ArrayCollection();
        $this->stalls = new ArrayCollection();
    }
}
