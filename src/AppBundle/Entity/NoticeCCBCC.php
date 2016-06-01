<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NoticeCCBCC
 *
 * @ORM\Table(name="notice_ccbcc")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NoticeCCBCCRepository")
 */
class NoticeCCBCC
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
     * @ORM\Column(name="noticeID", type="integer")
     */
    private $noticeID;

    /**
     * @var int
     *
     * @ORM\Column(name="ccbccID", type="integer")
     */
    private $ccbccID;


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
     * Set noticeID
     *
     * @param integer $noticeID
     * @return NoticeCCBCC
     */
    public function setNoticeID($noticeID)
    {
        $this->noticeID = $noticeID;

        return $this;
    }

    /**
     * Get noticeID
     *
     * @return integer
     */
    public function getNoticeID()
    {
        return $this->noticeID;
    }

    /**
     * Set ccbccID
     *
     * @param integer $ccbccID
     * @return NoticeCCBCC
     */
    public function setCcbccID($ccbccID)
    {
        $this->ccbccID = $ccbccID;

        return $this;
    }

    /**
     * Get ccbccID
     *
     * @return integer
     */
    public function getCcbccID()
    {
        return $this->ccbccID;
    }
}
