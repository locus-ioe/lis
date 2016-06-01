<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExhibitionEvent
 *
 * @ORM\Table(name="exhibition_event")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ExhibitionEventRepository")
 */
class ExhibitionEvent
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
     * @ORM\ManyToOne(targetEntity="Exhibition", inversedBy="id")
     * @ORM\JoinColumn(name="exhibitionID", referencedColumnName="id")
     */
    private $exhibitionID;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="id")
     * @ORM\JoinColumn(name="eventID", referencedColumnName="id")
     */
    private $eventID;


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
     * Set exhibitionID
     *
     * @param integer $exhibitionID
     * @return ExhibitionEvent
     */
    public function setExhibitionID($exhibitionID)
    {
        $this->exhibitionID = $exhibitionID;

        return $this;
    }

    /**
     * Get exhibitionID
     *
     * @return integer
     */
    public function getExhibitionID()
    {
        return $this->exhibitionID;
    }

    /**
     * Set eventID
     *
     * @param integer $eventID
     * @return ExhibitionEvent
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