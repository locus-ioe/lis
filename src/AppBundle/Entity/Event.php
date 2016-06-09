<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EventRepository")
 */
class Event
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
     * @ORM\Column(name="title", type="string", length=50)
     * @Assert\NotBlank()
     */
    private $title;
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }
    public function getTitle() {
        return $this->title;
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
     * @ORM\Column(name="datetime", type="datetime")
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     */
    private $datetime;
    public function setDatetime($datetime) {
        $this->datetime = $datetime;
        return $this;
    }
    public function getDatetime() {
        return $this->datetime;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="venue", type="string", length=30)
     * @Assert\NotBlank()
     */
    private $venue;
    public function setVenue($venue) {
        $this->venue = $venue;
        return $this;
    }
    public function getVenue() {
        return $this->venue;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=20)
     * @Assert\NotBlank()
     */
    private $type;
    public function setType($type) {
        $this->type = $type;
        return $this;
    }
    public function getType() {
        return $this->type;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $description;
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }
    public function getDescription() {
        return $this->description;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="report", type="text", nullable=true)
     */
    private $report;
    public function setReport($report) {
        $this->report = $report;
        return $this;
    }
    public function getReport() {
        return $this->report;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Member")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $owner;
    public function setOwner(Member $owner) {
        $this->owner = $owner;
    }
    public function getOwner() {
        return $this->owner;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Exhibition", inversedBy="events")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $exhibition;
    public function setExhibition(Exhibition $exhibition) {
        $this->exhibition = $exhibition;
    }
    public function getExhibition() {
        return $this->exhibition;
    }

    /**
     * @ORM\ManyToMany(targetEntity="Member")
     * @ORM\JoinTable("event_attendees")
     */
    protected $attendees;
    public function getAttendees() {
        return $this->attendees;
    }

    /**
     * @ORM\ManyToMany(targetEntity="Institution", mappedBy="collaborations")
     */
    protected $collaborators;
    public function getCollaborators() {
        return $this->collaborators;
    }

    /**
     * @ORM\ManyToMany(targetEntity="Member")
     * @ORM\JoinTable("event_organizers")
     */
    protected $organizers;
    public function getOrganizers() {
        return $this->organizers;
    }

    /**
     * @ORM\ManyToMany(targetEntity="Stall")
     * @ORM\JoinTable("event_stalls")
     */
    protected $stalls;
    public function getStalls() {
        return $this->stalls;
    }

    /**
     * @ORM\ManyToMany(targetEntity="Member")
     * @ORM\JoinTable("event_volunteers")
     */
    protected $volunteers;
    public function getVolunteers() {
        return $this->volunteers;
    }

    /**
     * @ORM\OneToMany(targetEntity="Finance", mappedBy="event")
     */
    protected $finances;
    public function getFinances(){
        return $this->finances;
    }

    public function __construct() {
        $this->attendees = new ArrayCollection();
        $this->collaborators = new ArrayCollection();
        $this->organizers = new ArrayCollection();
        $this->stalls = new ArrayCollection();
        $this->volunteers = new ArrayCollection();
    }
}
