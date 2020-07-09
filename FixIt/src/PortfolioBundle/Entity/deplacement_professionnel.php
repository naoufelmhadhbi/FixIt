<?php

namespace PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * deplacement_professionnel
 *
 * @ORM\Table(name="deplacement_professionnel")
 * @ORM\Entity(repositoryClass="PortfolioBundle\Repository\deplacement_professionnelRepository")
 */
class deplacement_professionnel
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
     * @ORM\Column(name="id_prof", type="integer")
     */
    private $idProf;

    /**
     * @var int
     *
     * @ORM\Column(name="id_deplacement", type="integer")
     */
    private $idDeplacement;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idProf
     *
     * @param integer $idProf
     *
     * @return deplacement_professionnel
     */
    public function setIdProf($idProf)
    {
        $this->idProf = $idProf;

        return $this;
    }

    /**
     * Get idProf
     *
     * @return int
     */
    public function getIdProf()
    {
        return $this->idProf;
    }

    /**
     * Set idDeplacement
     *
     * @param integer $idDeplacement
     *
     * @return deplacement_professionnel
     */
    public function setIdDeplacement($idDeplacement)
    {
        $this->idDeplacement = $idDeplacement;

        return $this;
    }

    /**
     * Get idDeplacement
     *
     * @return int
     */
    public function getIdDeplacement()
    {
        return $this->idDeplacement;
    }
}

