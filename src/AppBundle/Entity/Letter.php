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

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="regNo", type="string", length=15, unique=true)
     */
    private $regNo;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=50)
     */
    private $subject;

    /**
     * @var int
     *
     * @ORM\Column(name="salutationID", type="integer", nullable=true)
     */
    private $salutationID;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var int
     *
     * @ORM\Column(name="publisherID", type="integer", nullable=true)
     */
    private $publisherID;


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
     * @return Letter
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
     * Set regNo
     *
     * @param string $regNo
     * @return Letter
     */
    public function setRegNo($regNo)
    {
        $this->regNo = $regNo;

        return $this;
    }

    /**
     * Get regNo
     *
     * @return string 
     */
    public function getRegNo()
    {
        return $this->regNo;
    }

    /**
     * Set subject
     *
     * @param string $subject
     * @return Letter
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set salutationID
     *
     * @param integer $salutationID
     * @return Letter
     */
    public function setSalutationID($salutationID)
    {
        $this->salutationID = $salutationID;

        return $this;
    }

    /**
     * Get salutationID
     *
     * @return integer 
     */
    public function getSalutationID()
    {
        return $this->salutationID;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Letter
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set publisherID
     *
     * @param integer $publisherID
     * @return Letter
     */
    public function setPublisherID($publisherID)
    {
        $this->publisherID = $publisherID;

        return $this;
    }

    /**
     * Get publisherID
     *
     * @return integer 
     */
    public function getPublisherID()
    {
        return $this->publisherID;
    }
}
