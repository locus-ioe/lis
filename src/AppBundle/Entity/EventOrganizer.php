<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventOrganizer
 *
 * @ORM\Table(name="event_organizer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EventOrganizerRepository")
 */
class EventOrganizer
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
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="id")
     * @ORM\JoinColumn(name="eventID", referencedColumnName="id")
     */
    private $eventID;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="id")
     * @ORM\JoinColumn(name="organizerID", referencedColumnName="id")
     */
    private $organizerID;


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
     * Set eventOrganizer
     *
     * @param integer $eventOrganizer
     * @return EventOrganizer
     */
    public function setEventOrganizer($eventOrganizer)
    {
        $this->eventOrganizer = $eventOrganizer;

        return $this;
    }

    /**
     * Get eventOrganizer
     *
     * @return integer
     */
    public function getEventOrganizer()
    {
        return $this->eventOrganizer;
    }

    /**
     * Set organizerID
     *
     * @param integer $organizerID
     * @return EventOrganizer
     */
    public function setOrganizerID($organizerID)
    {
        $this->organizerID = $organizerID;

        return $this;
    }

    /**
     * Get organizerID
     *
     * @return integer
     */
    public function getOrganizerID()
    {
        return $this->organizerID;
    }

    /**
     * Set eventID
     *
     * @param integer $eventID
     * @return EventOrganizer
     */
    public function setEventID($eventID)
    {
        $this->eventID = $eventID;

        return $this;
    }

    /**
     * Get eventID
     *
     * @return integer
     */
    public function getEventID()
    {
        return $this->eventID;
    }
}
