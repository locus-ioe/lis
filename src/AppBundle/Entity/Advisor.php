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
    public function getId() {
        return $this->id;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="post", type="string", length=50, nullable=true)
     */
    private $post;
    public function setPost($post) {
        $this->post = $post;
        return $this;
    }
    public function getPost() {
        return $this->post;
    }

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="year", type="date", nullable=true)
     */
    private $year;
    public function setYear($year) {
        $this->year = $year;
        return $this;
    }
    public function getYear() {
        return $this->year;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="advisers")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $member;
    public function getMember() {
        return $this->member;
    }
    public function setMember(Member $member) {
        $this->member = $member;
    }
}
