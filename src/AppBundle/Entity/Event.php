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
     *
     * @ORM\OneToMany(targetEntity="EventAttendee", mappedBy="eventID")
     * @ORM\OneToMany(targetEntity="EventCollaborator", mappedBy="eventID")
     * @ORM\OneToMany(targetEntity="EventOrganizer", mappedBy="eventID")
     * @ORM\OneToMany(targetEntity="EventStall", mappedBy="eventID")
     * @ORM\OneToMany(targetEntity="EventVolunteer", mappedBy="eventID")
     * @ORM\OneToMany(targetEntity="Finance", mappedBy="eventID")
     * @ORM\OneToMany(targetEntity="ProjectCompetition", mappedBy="competitionID")
     * @ORM\OneToMany(targetEntity="Finance", mappedBy="eventID")
     * @ORM\OneToMany(targetEntity="ProjectCompetition", mappedBy="competitionID")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\OneToMany(targetEntity="ExhibitionEvent", mappedBy="eventID")
     */
    private $exhibitions;
    public function __construct()
    {
        $this->exhibition = new ArrayCollection();
    }
    public function getExhibitions()
    {
        return $this->exhibitions;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=50)
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime")
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     */
    private $datetime;

    /**
     * @var string
     *
     * @ORM\Column(name="venue", type="string", length=30)
     * @Assert\NotBlank()
     */
    private $venue;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=20)
     * @Assert\NotBlank()
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="report", type="text", nullable=true)
     */
    private $report;


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
     * @return Event
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
     * Set datetime
     *
     * @param \DateTime $datetime
     * @return Event
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set venue
     *
     * @param string $venue
     * @return Event
     */
    public function setVenue($venue)
    {
        $this->venue = $venue;

        return $this;
    }

    /**
     * Get venue
     *
     * @return string
     */
    public function getVenue()
    {
        return $this->venue;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Event
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
     * Set description
     *
     * @param string $description
     * @return Event
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

    /**
     * Set report
     *
     * @param string $report
     * @return Event
     */
    public function setReport($report)
    {
        $this->report = $report;

        return $this;
    }

    /**
     * Get report
     *
     * @return string
     */
    public function getReport()
    {
        return $this->report;
    }
}
