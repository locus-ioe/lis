<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventCollaborator
 *
 * @ORM\Table(name="event_collaborator")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EventCollaboratorRepository")
 */
class EventCollaborator
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
     * @ORM\JoinColumn(name="collaboratorID", referencedColumnName="id")
     */
    private $collaboratorID;


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
     * @return EventCollaborator
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
     * Set collaboratorID
     *
     * @param integer $collaboratorID
     * @return EventCollaborator
     */
    public function setCollaboratorID($collaboratorID)
    {
        $this->collaboratorID = $collaboratorID;

        return $this;
    }

    /**
     * Get collaboratorID
     *
     * @return integer
     */
    public function getCollaboratorID()
    {
        return $this->collaboratorID;
    }
}
