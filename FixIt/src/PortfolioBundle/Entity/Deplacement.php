<?php

namespace PortfolioBundle\Entity;

use AppBundle\Entity\Professionnel;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Deplacement
 *
 * @ORM\Table(name="deplacement")
 * @ORM\Entity(repositoryClass="PortfolioBundle\Repository\DeplacementRepository")
 */
class Deplacement
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
    *  @ORM\ManyToMany(targetEntity="AppBundle\Entity\Professionnel", mappedBy="id_deplacement")     
    */
    private $idProf;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User", mappedBy="id_deplacement", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="metier_professionnel")
     */
    private $id_prof;

    public function __construct()
    {
        $this->id_prof = new ArrayCollection();
    }

    public function addProfessionnels(Professionnel $professionnel)
    {
        $professionnel->addDeplacement($this);
        $this->id_prof[] = $professionnel;
    }

    public function removeDepProf(Professionnel $professionnel)
    {
        $this->id_prof->removeElement($professionnel);
    }


    /**
     * @var string
     *
     * @ORM\Column(name="gouvernorat", type="string", length=255)
     */
    private $gouvernorat;

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
     * @param integer $id_prof
     *
     * @return Deplacement
     */
    public function setIdProf($id_prof)
    {
        $this->id_prof = $id_prof;

        return $this;
    }

    /**
     * Get idProf
     *
     * @return ArrayCollection
     */
    public function getIdProf()
    {
        return $this->id_prof;
    }

    /**
     * Set gouvernorat
     *
     * @param string $gouvernorat
     *
     * @return Deplacement
     */
    public function setGouvernorat($gouvernorat)
    {
        $this->gouvernorat = $gouvernorat;

        return $this;
    }

    /**
     * Get gouvernorat
     *
     * @return string
     */
    public function getGouvernorat()
    {
        return $this->gouvernorat;
    }
    public function __toString()
    {
        return(string)$this->getGouvernorat();
    }
}

