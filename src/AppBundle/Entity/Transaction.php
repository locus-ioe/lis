<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transaction
 */
class Transaction
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
    private $billNumber;

    /**
     * @var int
     */
    private $institutionID;

    /**
     * @var int
     */
    private $eventID;

    /**
     * @var string
     */
    private $amount;

    /**
     * @var int
     */
    private $receiverID;

    /**
     * @var string
     */
    private $remarks;

    /**
     * @var string
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
     * Set datetime
     *
     * @param \DateTime $datetime
     * @return Transaction
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
     * Set billNumber
     *
     * @param string $billNumber
     * @return Transaction
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
     * @return Transaction
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
     * @return Transaction
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
     * @return Transaction
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
     * @return Transaction
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
     * @return Transaction
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
     * @return Transaction
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
