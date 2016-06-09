<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

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
     */
    private $id;
    public function getId(){
        return $this->id;
    }

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime")
     */
    private $datetime;
    public function setDatetime($datetime){
        $this->datetime = $datetime;
        return $this;
    }
    public function getDatetime(){
        return $this->datetime;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=50, nullable=true, unique=true)
     */
    private $slug;
    public function setSlug($slug){
        $this->slug = $slug;
        return $this;
    }
    public function getSlug(){
        return $this->slug;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="venue", type="string", length=30)
     */
    private $venue;
    public function setVenue($venue){
        $this->venue = $venue;
        return $this;
    }
    public function getVenue(){
        return $this->venue;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="agenda", type="text")
     */
    private $agenda;
    public function setAgenda($agenda){
        $this->agenda = $agenda;
        return $this;
    }
    public function getAgenda(){
        return $this->agenda;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="minute", type="text", nullable=true)
     */
    private $minute;
    public function setMinute($minute){
        $this->minute = $minute;
        return $this;
    }
    public function getMinute(){
        return $this->minute;
    }
    /**
     * @ORM\ManyToMany(targetEntity="Member")
     * @ORM\JoinTable("meeting_attendees")
     */
    protected $attendees;
    public function getAttendees() {
        return $this->attendees;
    }

    public function __construct() {
        $this->attendees = new ArrayCollection();
    }
}
