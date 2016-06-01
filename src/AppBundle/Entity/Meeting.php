<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Meeting
 *
 * @ORM\Table(name="meeting")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MeetingRepository")
 */
class Meeting
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @ORM\OneToMany(targetEntity="MeetingAttendee", mappedBy="meetingID")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime")
     */
    private $datetime;

    /**
     * @var string
     *
     * @ORM\Column(name="venue", type="string", length=30)
     */
    private $venue;

    /**
     * @var string
     *
     * @ORM\Column(name="agenda", type="text")
     */
    private $agenda;

    /**
     * @var string
     *
     * @ORM\Column(name="minute", type="text", nullable=true)
     */
    private $minute;


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
     * Set datetime
     *
     * @param \DateTime $datetime
     * @return Meeting
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
     * @return Meeting
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
     * Set agenda
     *
     * @param string $agenda
     * @return Meeting
     */
    public function setAgenda($agenda)
    {
        $this->agenda = $agenda;

        return $this;
    }

    /**
     * Get agenda
     *
     * @return string
     */
    public function getAgenda()
    {
        return $this->agenda;
    }

    /**
     * Set minute
     *
     * @param string $minute
     * @return Meeting
     */
    public function setMinute($minute)
    {
        $this->minute = $minute;

        return $this;
    }

    /**
     * Get minute
     *
     * @return string
     */
    public function getMinute()
    {
        return $this->minute;
    }
}
