<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectCompetition
 *
 * @ORM\Table(name="project_competition")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectCompetitionRepository")
 */
class ProjectCompetition
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
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="id")
     * @ORM\JoinColumn(name="projectID", referencedColumnName="id")
     */
    private $projectID;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="id")
     * @ORM\JoinColumn(name="competitionID", referencedColumnName="id")
     */
    private $competitionID;


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
     * @return ProjectCompetition
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
     * Set competitionID
     *
     * @param integer $competitionID
     * @return ProjectCompetition
     */
    public function setCompetitionID($competitionID)
    {
        $this->competitionID = $competitionID;

        return $this;
    }

    /**
     * Get competitionID
     *
     * @return integer
     */
    public function getCompetitionID()
    {
        return $this->competitionID;
    }
}
