<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Meeting
 */
class Meeting
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $datetime;

    /**
     * @var string
     */
    private $venue;

    /**
     * @var string
     */
    private $agenda;

    /**
     * @var string
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
