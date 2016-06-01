<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventStall
 *
 * @ORM\Table(name="event_stall")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EventStallRepository")
 */
class EventStall
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
     * @ORM\ManyToOne(targetEntity="Stall", inversedBy="id")
     * @ORM\JoinColumn(name="stallID", referencedColumnName="id")
     */
    private $stallID;


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
     * @return EventStall
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
     * Set stallID
     *
     * @param integer $stallID
     * @return EventStall
     */
    public function setStallID($stallID)
    {
        $this->stallID = $stallID;

        return $this;
    }

    /**
     * Get stallID
     *
     * @return integer
     */
    public function getStallID()
    {
        return $this->stallID;
    }
}
