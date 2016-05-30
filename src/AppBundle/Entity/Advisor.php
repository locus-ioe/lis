<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Advisor
 */
class Advisor
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $memberID;

    /**
     * @var string
     */
    private $post;

    /**
     * @var \DateTime
     */
    private $year;


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
     * Set memberID
     *
     * @param integer $memberID
     * @return Advisor
     */
    public function setMemberID($memberID)
    {
        $this->memberID = $memberID;

        return $this;
    }

    /**
     * Get memberID
     *
     * @return integer 
     */
    public function getMemberID()
    {
        return $this->memberID;
    }

    /**
     * Set post
     *
     * @param string $post
     * @return Advisor
     */
    public function setPost($post)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return string 
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set year
     *
     * @param \DateTime $year
     * @return Advisor
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return \DateTime 
     */
    public function getYear()
    {
        return $this->year;
    }
}
