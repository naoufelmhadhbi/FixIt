<?php

namespace PortfolioBundle\Entity;

use AppBundle\Entity\Professionnel;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Metier
 *
 * @ORM\Table(name="metier")
 * @ORM\Entity(repositoryClass="PortfolioBundle\Repository\MetierRepository")
 */
class Metier
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     *  @ORM\ManyToMany(targetEntity="AppBundle\Entity\Professionnel", mappedBy="id_metier")
     */
    private $idProf;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User", mappedBy="id_metier", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="metier_professionnel")
     */
    private $id_prof;

    public function __construct()
    {
        $this->id_prof = new ArrayCollection();
    }

    public function addProfessionnels(Professionnel $professionnel)
    {
        $professionnel->addMetiers($this);
        $this->id_prof[] = $professionnel;
    }

    public function removeProfessionnel(Professionnel $professionnel)
    {
        if (!$this->id_prof->contains($professionnel)) {
            return;
        }
        $this->id_prof->removeElement($professionnel);
        $professionnel->removeMetier($this);
    }

    public function removeMetierProf(Professionnel $professionnel)
    {
        $this->id_prof->removeElement($professionnel);
    }

    /**
     * @return mixed
     */
    public function getIdProf()
    {
        return $this->id_prof;
    }

    /**
     * @param mixed $id_prof
     */
    public function setIdProf($id_prof)
    {
        $this->id_prof = $id_prof;
    }

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
     * Set nom
     *
     * @param string $nom
     *
     * @return Metier
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }
}

