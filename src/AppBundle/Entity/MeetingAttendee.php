<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MeetingAttendee
 *
 * @ORM\Table(name="meeting_attendee")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MeetingAttendeeRepository")
 */
class MeetingAttendee
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
     * @ORM\ManyToOne(targetEntity="Meeting", inversedBy="id")
     * @ORM\JoinColumn(name="meetingID", referencedColumnName="id")
     */
    private $meetingID;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="id")
     * @ORM\JoinColumn(name="attendeeID", referencedColumnName="id")
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
     * Set meetingID
     *
     * @param integer $meetingID
     * @return MeetingAttendee
     */
    public function setMeetingID($meetingID)
    {
        $this->meetingID = $meetingID;

        return $this;
    }

    /**
     * Get meetingID
     *
     * @return integer
     */
    public function getMeetingID()
    {
        return $this->meetingID;
    }

    /**
     * Set attendeeID
     *
     * @param integer $attendeeID
     * @return MeetingAttendee
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