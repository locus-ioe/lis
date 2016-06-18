<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notice
 *
 * @ORM\Table(name="notice")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NoticeRepository")
 */
class Notice
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
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=55, unique=true)
     */
    private $slug;
    public function setSlug($slug) {
        $this->slug = $slug;
        return $this;
    }
    public function getSlug() {
        return $this->slug;
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
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="noticing")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $publisher;
    public function getPublisher(){
        return $this->publisher;
    }
    public function setPublisher(Member $publisher){
        $this->publisher = $publisher;
    }
}
