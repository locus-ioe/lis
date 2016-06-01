<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Advisor
 *
 * @ORM\Table(name="advisor")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AdvisorRepository")
 */
class Advisor
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
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="id")
     * @ORM\JoinColumn(name="memberID", referencedColumnName="id")
     */
    private $memberID;

    /**
     * @var string
     *
     * @ORM\Column(name="post", type="string", length=50, nullable=true)
     */
    private $post;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="year", type="date", nullable=true)
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
