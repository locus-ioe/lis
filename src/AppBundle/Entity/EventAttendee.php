<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventAttendee
 *
 * @ORM\Table(name="event_attendee")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EventAttendeeRepository")
 */
class EventAttendee
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
     * @ORM\Column(name="eventID", type="integer")
     */
    private $eventID;

    /**
     * @var int
     *
     * @ORM\Column(name="attendeeID", type="integer")
     */
    private $attendeeID;


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
     * Set eventID
     *
     * @param integer $eventID
     * @return EventAttendee
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

    /**
     * Set attendeeID
     *
     * @param integer $attendeeID
     * @return EventAttendee
     */
    public function setAttendeeID($attendeeID)
    {
        $this->attendeeID = $attendeeID;

        return $this;
    }

    /**
     * Get attendeeID
     *
     * @return integer 
     */
    public function getAttendeeID()
    {
        return $this->attendeeID;
    }
}
