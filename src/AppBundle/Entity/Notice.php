<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notice
 */
class Notice
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var int
     */
    private $publisherID;

    /**
     * @var string
     */
    private $content;


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
     * @return Notice
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
     * Set subject
     *
     * @param string $subject
     * @return Notice
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
     * Set publisherID
     *
     * @param integer $publisherID
     * @return Notice
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

    /**
     * Set content
     *
     * @param string $content
     * @return Notice
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
}
