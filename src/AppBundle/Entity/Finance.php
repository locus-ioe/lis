<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Finance
 *
 * @ORM\Table(name="finance")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FinanceRepository")
 */
class Finance
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="billNumber", type="string", length=10, unique=true)
     */
    private $billNumber;

    /**
     * @var int
     *
     * @ORM\Column(name="institutionID", type="integer", nullable=true)
     */
    private $institutionID;

    /**
     * @var int
     *
     * @ORM\Column(name="eventID", type="integer", nullable=true)
     */
    private $eventID;

    /**
     * @var string
     *
     * @ORM\Column(name="amount", type="decimal", precision=10, scale=2)
     */
    private $amount;

    /**
     * @var int
     *
     * @ORM\Column(name="receiverID", type="integer")
     */
    private $receiverID;

    /**
     * @var string
     *
     * @ORM\Column(name="remarks", type="string", length=50, nullable=true)
     */
    private $remarks;

    /**
     * @var string
     *
     * @ORM\Column(name="direction", type="string", length=3)
     */
    private $direction;


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
     * Set date
     *
     * @param \DateTime $date
     * @return Finance
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set billNumber
     *
     * @param string $billNumber
     * @return Finance
     */
    public function setBillNumber($billNumber)
    {
        $this->billNumber = $billNumber;

        return $this;
    }

    /**
     * Get billNumber
     *
     * @return string 
     */
    public function getBillNumber()
    {
        return $this->billNumber;
    }

    /**
     * Set institutionID
     *
     * @param integer $institutionID
     * @return Finance
     */
    public function setInstitutionID($institutionID)
    {
        $this->institutionID = $institutionID;

        return $this;
    }

    /**
     * Get institutionID
     *
     * @return integer 
     */
    public function getInstitutionID()
    {
        return $this->institutionID;
    }

    /**
     * Set eventID
     *
     * @param integer $eventID
     * @return Finance
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
     * Set amount
     *
     * @param string $amount
     * @return Finance
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return string 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set receiverID
     *
     * @param integer $receiverID
     * @return Finance
     */
    public function setReceiverID($receiverID)
    {
        $this->receiverID = $receiverID;

        return $this;
    }

    /**
     * Get receiverID
     *
     * @return integer 
     */
    public function getReceiverID()
    {
        return $this->receiverID;
    }

    /**
     * Set remarks
     *
     * @param string $remarks
     * @return Finance
     */
    public function setRemarks($remarks)
    {
        $this->remarks = $remarks;

        return $this;
    }

    /**
     * Get remarks
     *
     * @return string 
     */
    public function getRemarks()
    {
        return $this->remarks;
    }

    /**
     * Set direction
     *
     * @param string $direction
     * @return Finance
     */
    public function setDirection($direction)
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * Get direction
     *
     * @return string 
     */
    public function getDirection()
    {
        return $this->direction;
    }
}
