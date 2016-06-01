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
     *
     * @ORM\OneToMany(targetEntity="Advisor", mappedBy="memberID")
     * @ORM\OneToOne(targetEntity="Committee", mappedBy="memberID")
     * @ORM\OneToMany(targetEntity="EventAttendee", mappedBy="attendeeID")
     * @ORM\OneToMany(targetEntity="EventCollaborator", mappedBy="collaboratorID")
     * @ORM\OneToMany(targetEntity="EventOrganizer", mappedBy="organizerID")
     * @ORM\OneToMany(targetEntity="EventVolunteer", mappedBy="volunteerID")
     * @ORM\OneToMany(targetEntity="Finance", mappedBy="receiverID")
     * @ORM\OneToMany(targetEntity="Letter", mappedBy="publisherID")
     * @ORM\OneToOne(targetEntity="Letter", mappedBy="salutationID")
     * @ORM\OneToMany(targetEntity="MeetingAttendee", mappedBy="attendeeID")
     * @ORM\OneToMany(targetEntity="Notice", mappedBy="publisherID")
     * @ORM\OneToMany(targetEntity="NoticeCCBCC", mappedBy="ccbccID")
     * @ORM\OneToMany(targetEntity="ProjectMembers", mappedBy="memberID")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=20)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=30)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=20, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=50, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=40, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="string", length=15, nullable=true)
     */
    private $contact;

    /**
     * @var string
     *
     * @ORM\Column(name="crnPost", type="string", length=30, nullable=true)
     */
    private $crnPost;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Institution", inversedBy="id")
     * @ORM\JoinColumn(name="institutionID", referencedColumnName="id")
     */
    private $institutionID;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255, nullable=true)
     */
    private $token;

    /**
     * @var string
     *
     * @ORM\Column(name="dp", type="string", length=30, nullable=true)
     */
    private $dp;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Privilege", inversedBy="id")
     * @ORM\JoinColumn(name="privilegeID", referencedColumnName="id")
     */
    private $privilegeID;


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
     * Set firstname
     *
     * @param string $firstname
     * @return Member
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return Member
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Member
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Member
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Member
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set contact
     *
     * @param string $contact
     * @return Member
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set crnPost
     *
     * @param string $crnPost
     * @return Member
     */
    public function setCrnPost($crnPost)
    {
        $this->crnPost = $crnPost;

        return $this;
    }

    /**
     * Get crnPost
     *
     * @return string
     */
    public function getCrnPost()
    {
        return $this->crnPost;
    }

    /**
     * Set institutionID
     *
     * @param integer $institutionID
     * @return Member
     */
    public function setInstitutionID($institutionID)
    {
        $this->institutionID = $institutionID;

        return $this;
    }

    /**
     * Get institutionID
     *
     * @return integer
     */
    public function getInstitutionID()
    {
        return $this->institutionID;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Member
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return Member
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set dp
     *
     * @param string $dp
     * @return Member
     */
    public function setDp($dp)
    {
        $this->dp = $dp;

        return $this;
    }

    /**
     * Get dp
     *
     * @return string
     */
    public function getDp()
    {
        return $this->dp;
    }

    /**
     * Set privilegeID
     *
     * @param integer $privilegeID
     * @return Member
     */
    public function setPrivilegeID($privilegeID)
    {
        $this->privilegeID = $privilegeID;

        return $this;
    }

    /**
     * Get privilegeID
     *
     * @return integer
     */
    public function getPrivilegeID()
    {
        return $this->privilegeID;
    }
}
