<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Professionnel
 *
 * @ORM\Table(name="professionnel")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProfessionnelRepository")
 */
class Professionnel extends User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    protected $description;
    /**
     * @ORM\ManyToMany(targetEntity="PublicationBundle\Entity\Publication", mappedBy="id_professionnel")
     */
    protected $id_pub;
// N'oubliez pas d'ajouter les champs ( recommandation,avis ) dans la table associative publication_professionnel

    /**
     * @ORM\ManyToMany(targetEntity="PortfolioBundle\Entity\Metier", mappedBy="id_professionnel")
     */
    protected $id_metier;
    /**
     * @ORM\ManyToMany(targetEntity="PortfolioBundle\Entity\Deplacement", mappedBy="id_professionnel")
     */
    protected $id_deplacement;

    /**
     * @return mixed
     */
    public function getIdDeplacement()
    {
        return $this->id_deplacement;
    }

    /**
     * @param mixed $id_deplacement
     */
    public function setIdDeplacement($id_deplacement)
    {
        $this->id_deplacement = $id_deplacement;
    }

    /**
     * @return mixed
     */
    public function getIdPub()
    {
        return $this->id_pub;
    }

    /**
     * @return mixed
     */
    public function getIdMetier()
    {
        return $this->id_metier;
    }

    /**
     * @param mixed $id_metier
     */
    public function setIdMetier($id_metier)
    {
        $this->id_metier = $id_metier;
    }

    /**
     * @param mixed $id_pub
     */
    public function setIdPub($id_pub)
    {
        $this->id_pub = $id_pub;
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
     * Set description
     *
     * @param string $description
     *
     * @return Professionnel
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}

