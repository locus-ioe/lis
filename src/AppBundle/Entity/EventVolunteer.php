<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventVolunteer
 *
 * @ORM\Table(name="event_volunteer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EventVolunteerRepository")
 */
class EventVolunteer
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
     * @var intint
     *
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="id")
     * @ORM\JoinColumn(name="eventID", referencedColumnName="id")
     */
    private $eventID;

    /**
     * @var intint
     *
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="id")
     * @ORM\JoinColumn(name="volunteerID", referencedColumnName="id")
     */
    private $volunteerID;


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
     * @return EventVolunteer
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
     * Set volunteerID
     *
     * @param integer $volunteerID
     * @return EventVolunteer
     */
    public function setVolunteerID($volunteerID)
    {
        $this->volunteerID = $volunteerID;

        return $this;
    }

    /**
     * Get volunteerID
     *
     * @return integer
     */
    public function getVolunteerID()
    {
        return $this->volunteerID;
    }
}
