<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use PortfolioBundle\Entity\Metier;

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
     * @ORM\ManyToMany(targetEntity="PublicationBundle\Entity\Publication")
     * @JoinTable(name="publication_professionnel",
     *      joinColumns={@JoinColumn(name="professionnel_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="publication_id", referencedColumnName="id")}
     *      )
     */
    protected $id_pub;
// N'oubliez pas d'ajouter les champs ( recommandation,avis ) dans la table associative publication_professionnel

    /**
     * @ORM\ManyToMany(targetEntity="PortfolioBundle\Entity\Metier", inversedBy="id_prof", cascade={"persist", "remove"})
     * @JoinTable(name="metier_professionnel",
     *      joinColumns={@JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="metier_id", referencedColumnName="id")}
     *      )
     */
    protected $id_metier;
    
    /**
     * @ORM\ManyToMany(targetEntity="PortfolioBundle\Entity\Deplacement")
     * @JoinTable(name="deplacement_professionnel",
     *      joinColumns={@JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="deplacement_id", referencedColumnName="id")}
     *      )
     */
    protected $id_deplacement;


    public function addMetiers(Metier $metier)
    {
        $this->id_metier[] = $metier;
    }
    public function removeMetier(Metier $metier)
    {
        if (!$this->id_metier->contains($metier)) {
            return;
        }
        $this->id_metier->removeElement($metier);
        $metier->removeProfessionnel($this);
    }

    public function removeScientistGenus(Metier $metier)
    {
        $this->id_metier->removeElement($metier);
    }

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
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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

//    public function addAnswer(Answer $answer)
//    {
//        $this->answers->add($answer);
//        $answer->setQuestion($this);
//    }
    public function __toString()
    {
        return(string)$this->getDescription(); //(string) pour caster

    }
}

