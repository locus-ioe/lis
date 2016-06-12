<?php

namespace AppBundle\Entity;

// Doctrine collections
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Member
 *
 * @ORM\Table(name="member")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MemberRepository")
 */
class Member
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
     * @ORM\Column(name="firstname", type="string", length=20)
     */
    private $firstname;
    public function setFirstname($firstname){
        $this->firstname = $firstname;
        return $this;
    }
    public function getFirstname(){
        return $this->firstname;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=30)
     */
    private $lastname;
    public function setLastname($lastname){
        $this->lastname = $lastname;
        return $this;
    }
    public function getLastname(){
        return $this->lastname;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=20, unique=true)
     */
    private $username;
    public function setUsername($username){
        $this->username = $username;
        return $this;
    }
    public function getUsername(){
        return $this->username;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=50, nullable=true)
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
     * @ORM\Column(name="email", type="string", length=40, nullable=true)
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
     * @ORM\Column(name="contact", type="string", length=15, nullable=true)
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
     * @ORM\Column(name="crnPost", type="string", length=30, nullable=true)
     */
    private $crnPost;
    public function setCrnPost($crnPost){
        $this->crnPost = $crnPost;
        return $this;
    }
    public function getCrnPost(){
        return $this->crnPost;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;
    public function setPassword($password){
        $this->password = $password;
        return $this;
    }
    public function getPassword(){
        return $this->password;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255, nullable=true)
     */
    private $token;
    public function setToken($token){
        $this->token = $token;
        return $this;
    }
    public function getToken(){
        return $this->token;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="dp", type="string", length=30, nullable=true)
     */
    private $dp;
    public function setDp($dp){
        $this->dp = $dp;
        return $this;
    }
    public function getDp(){
        return $this->dp;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Institution", inversedBy="members")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $institution;
    public function setInstitution($institution){
        $this->institution = $institution;
        return $this;
    }
    public function getInstitution(){
        return $this->institution;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Privilege", inversedBy="members")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $privilege;
    public function setPrivilege($privilege){
        $this->privilege = $privilege;
        return $this;
    }
    public function getPrivilege(){
        return $this->privilege;
    }

    /**
     * @ORM\OneToMany(targetEntity="Advisor", mappedBy="member")
     */
    protected $advisers;
    public function getAdvisers(){
        return $this->advisers;
    }

    /**
     * @ORM\OneToOne(targetEntity="Committee", mappedBy="member")
     */
    protected $committee;
    public function getCommittee(){
        return $this->committee;
    }

    /**
     * @ORM\ManyToMany(targetEntity="Event", mappedBy="attendees")
     */
    protected $participating;
    public function getParticipating() {
        return $this->participating;
    }

    /**
     * @ORM\ManyToMany(targetEntity="Event", mappedBy="organizers")
     */
    protected $organizing;
    public function getOrganizing() {
        return $this->organizing;
    }

    /**
     * @ORM\ManyToMany(targetEntity="Event", mappedBy="volunteers")
     */
    protected $volunteering;
    public function getVolunteering() {
        return $this->volunteering;
    }

    /**
     * @ORM\ManyToMany(targetEntity="Meeting", mappedBy="attendees")
     */
    protected $attending;
    public function getAttending() {
        return $this->attending;
    }

    /**
     * @ORM\ManyToMany(targetEntity="Project", mappedBy="members")
     */
    protected $developing;
    public function getDeveloping() {
        return $this->developing;
    }

    /**
     * @ORM\OneToMany(targetEntity="Event", mappedBy="owner")
     */
    protected $owing;
    public function getOwing() {
        return $this->owing;
    }

    /**
     * @ORM\OneToMany(targetEntity="Finance", mappedBy="receiver")
     */
    protected $receiving;
    public function getReceiving() {
        return $this->receiving;
    }

    /**
     * @ORM\OneToMany(targetEntity="Notice", mappedBy="publisher")
     */
    protected $noticing;
    public function getNoticing() {
        return $this->noticing;
    }

    /**
     * @ORM\OneToMany(targetEntity="Letter", mappedBy="salutation")
     */
    protected $salutations;
    public function getSalutations() {
        return $this->salutations;
    }

    /**
     * @ORM\OneToMany(targetEntity="Letter", mappedBy="publisher")
     */
    protected $publishing;
    public function getPublishing() {
        return $this->publishing;
    }

    public function __construct() {
        $this->attending = new ArrayCollection();
        $this->advisers = new ArrayCollection();
        $this->participating = new ArrayCollection();
        $this->noticing = new ArrayCollection();
        $this->organizing = new ArrayCollection();
        $this->volunteering = new ArrayCollection();
        $this->owing = new ArrayCollection();
        $this->receiving = new ArrayCollection();
        $this->developing = new ArrayCollection();
        $this->salutations = new ArrayCollection();
        $this->publishing = new ArrayCollection();
    }
}
