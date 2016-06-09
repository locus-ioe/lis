<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Letter
 *
 * @ORM\Table(name="letter")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LetterRepository")
 */
class Letter
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
     * @ORM\Column(name="date", type="date")
     */
    private $date;
    public function setDate($date){
        $this->date = $date;
        return $this;
    }
    public function getDate(){
        return $this->date;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="regNo", type="string", length=15, unique=true)
     */
    private $regNo;
    public function setRegNo($regNo){
        $this->regNo = $regNo;
        return $this;
    }
        public function getRegNo(){
        return $this->regNo;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=50)
     */
    private $subject;
    public function setSubject($subject){
        $this->subject = $subject;
        return $this;
    }
    public function getSubject(){
        return $this->subject;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Member")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $salutation;
    public function setSalutation($salutation){
        $this->salutation = $salutation;
        return $this;
    }
    public function getSalutation(){
        return $this->salutation;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;
    public function setContent($content){
        $this->content = $content;
        return $this;
    }
    public function getContent(){
        return $this->content;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Member")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $publisher;
    public function setPublisher($publisher){
        $this->publisher = $publisher;
        return $this;
    }
    public function getPublisher(){
        return $this->publisher;
    }
}
