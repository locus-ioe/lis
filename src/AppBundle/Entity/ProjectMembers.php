<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectMembers
 *
 * @ORM\Table(name="project_members")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectMembersRepository")
 */
class ProjectMembers
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
     * @var
     *
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="id")
     * @ORM\JoinColumn(name="projectID", referencedColumnName="id")
     */
    private $projectID;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="id")
     * @ORM\JoinColumn(name="memberID", referencedColumnName="id")
     */
    private $memberID;


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
     * Set projectID
     *
     * @param integer $projectID
     * @return ProjectMembers
     */
    public function setProjectID($projectID)
    {
        $this->projectID = $projectID;

        return $this;
    }

    /**
     * Get projectID
     *
     * @return integer
     */
    public function getProjectID()
    {
        return $this->projectID;
    }

    /**
     * Set memberID
     *
     * @param integer $memberID
     * @return ProjectMembers
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
}
