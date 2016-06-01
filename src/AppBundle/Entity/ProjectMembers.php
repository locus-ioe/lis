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
     * @var int
     *
     * @ORM\Column(name="projectID", type="integer")
     */
    private $projectID;

    /**
     * @var int
     *
     * @ORM\Column(name="memberID", type="integer")
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
