<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExhibitionProject
 *
 * @ORM\Table(name="exhibition_project")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ExhibitionProjectRepository")
 */
class ExhibitionProject
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
     * @ORM\ManyToOne(targetEntity="Exhibition", inversedBy="id")
     * @ORM\JoinColumn(name="exhibitionID", referencedColumnName="id")
     */
    private $exhibitionID;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="id")
     * @ORM\JoinColumn(name="project", referencedColumnName="id")
     */
    private $projectID;


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
     * Set exhibitionID
     *
     * @param integer $exhibitionID
     * @return ExhibitionProject
     */
    public function setExhibitionID($exhibitionID)
    {
        $this->exhibitionID = $exhibitionID;

        return $this;
    }

    /**
     * Get exhibitionID
     *
     * @return integer
     */
    public function getExhibitionID()
    {
        return $this->exhibitionID;
    }

    /**
     * Set projectID
     *
     * @param integer $projectID
     * @return ExhibitionProject
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
}
