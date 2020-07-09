<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use PortfolioBundle\Entity\Deplacement;
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
<<<<<<< Updated upstream
    
=======

    public function __construct()
    {
        parent::__construct();
        $this->id_metier = new ArrayCollection();
        $this->id_deplacement = new ArrayCollection();
    }

>>>>>>> Stashed changes
    /**
     * @ORM\ManyToMany(targetEntity="PortfolioBundle\Entity\Deplacement", inversedBy="id_prof", cascade={"persist", "remove"})
     * @JoinTable(name="deplacement_professionnel",
     *      joinColumns={@JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="id_deplacement", referencedColumnName="id")}
     *      )
     */
    protected $id_deplacement;



    public function addMetiers(Metier $metier)
    {
        $this->id_metier[] = $metier;
    }

    public function addDeplacement(Deplacement $deplacement)
    {
        $this->id_deplacement[] = $deplacement;
    }

    public function removeMetier(Metier $metier)
    {
        if (!$this->id_metier->contains($metier)) {
            return;
        }
        $this->id_metier->removeElement($metier);
        $metier->removeProfessionnel($this);
    }

    public function removeProfMetier(Metier $metier)
    {
        $this->id_metier->removeElement($metier);
    }

    public function removeProfDep(Deplacement $deplacement)
    {
        $this->id_deplacement->removeElement($deplacement);
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

    public function setMetier($id_metier) {
        foreach($this->id_metier as $id => $metier) {
            if(!isset($id_metier[$id])) {
                //remove from old because it doesn't exist in new
                $this->id_metier->remove($id);
            }
            else {
                //the product already exists do not overwrite
                unset($id_metier[$id]);
            }
        }

        //add products that exist in new but not in old
        foreach($id_metier as $id => $metier) {
            $this->id_metier[$id] = $metier;
        }
    }

    public function setDeplacement($id_deplacement) {
        foreach($this->id_deplacement as $id => $deplacement) {
            if(!isset($id_deplacement[$id])) {
                //remove from old because it doesn't exist in new
                $this->id_deplacement->remove($id);
            }
            else {
                //the product already exists do not overwrite
                unset($id_deplacement[$id]);
            }
        }

        //add products that exist in new but not in old
        foreach($id_deplacement as $id => $deplacement) {
            $this->id_deplacement[$id] = $deplacement;
        }
    }

}

