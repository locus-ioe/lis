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
    public function getId() {
        return $this->id;
    }

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;
    public function setDate($date) {
        $this->date = $date;
        return $this;
    }
    public function getDate() {
        return $this->date;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="billNumber", type="string", length=10, unique=true)
     */
    private $billNumber;
    public function setBillNumber($billNumber) {
        $this->billNumber = $billNumber;
        return $this;
    }
    public function getBillNumber() {
        return $this->billNumber;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Institution", inversedBy="finances")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $institution;
    public function setInstitution($institution) {
        $this->institution = $institution;
        return $this;
    }
    public function getInstitution() {
        return $this->institution;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="finances")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $event;
    public function setEvent($event) {
        $this->event = $event;
        return $this;
    }
    public function getEvent() {
        return $this->event;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="amount", type="decimal", precision=10, scale=2)
     */
    private $amount;
    public function setAmount($amount) {
        $this->amount = $amount;
        return $this;
    }
    public function getAmount() {
        return $this->amount;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Member")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $receiver;
    public function setReceiver($receiver) {
        $this->receiver = $receiver;
        return $this;
    }
    public function getReceiver() {
        return $this->receiver;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="remarks", type="string", length=50, nullable=true)
     */
    private $remarks;
    public function setRemarks($remarks) {
        $this->remarks = $remarks;
        return $this;
    }
    public function getRemarks() {
        return $this->remarks;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="direction", type="string", length=3)
     */
    private $direction;
    public function setDirection($direction) {
        $this->direction = $direction;
        return $this;
    }
    public function getDirection() {
        return $this->direction;
    }
}
