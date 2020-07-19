<?php

namespace PublicationBundle\Entity;

use AppBundle\Entity\Professionnel;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;

/**
 * Publication
 *
 * @ORM\Table(name="publication")
 * @ORM\Entity(repositoryClass="PublicationBundle\Repository\PublicationRepository")
 */
class Publication
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
     * @ORM\Column(name="id_professionnel", nullable=true)
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User", mappedBy="id_professionnel", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="publication_professionnel")
     */
    private $id_professionnel;

    /**
     *@ORM\Column(name="id_demandeur", nullable=true)
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Demandeur")
     * @ORM\JoinColumn(name="id_demandeur",referencedColumnName="id")
     *
     */
    private $id_demandeur ;

    /**
     *@ORM\Column(name="id_metier", nullable=true)
     * @ORM\ManyToOne(targetEntity="PortfolioBundle\Entity\Metier")
     * @ORM\JoinColumn(name="id_metier",referencedColumnName="id")
     *
     */
    private $id_metier ;

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
     * @return int
     */
    public function getIdDemandeur()
    {
        return $this->id_demandeur;
    }

    /**
     * @param int $id_demandeur
     */
    public function setIdDemandeur($id_demandeur)
    {
        $this->id_demandeur = $id_demandeur;
    }




    /**
     * @return mixed
     */
    public function getIdProfessionnel()
    {
        return $this->id_professionnel;
    }

    /**
     * @param mixed $id_professionnel
     */
    public function setIdProfessionnel($id_professionnel)
    {
        $this->id_professionnel = $id_professionnel;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="detail", type="text")
     */
    private $detail;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255)
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="piece_jointe", type="string", length=255)
     */
    private $pieceJointe;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_pub", type="date")
     */
    private $datePub;


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
     * Set titre
     *
     * @param string $titre
     *
     * @return Publication
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set detail
     *
     * @param string $detail
     *
     * @return Publication
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * Get detail
     *
     * @return string
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Publication
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set pieceJointe
     *
     * @param string $pieceJointe
     *
     * @return Publication
     */
    public function setPieceJointe($pieceJointe)
    {
        $this->pieceJointe = $pieceJointe;

        return $this;
    }

    /**
     * Get pieceJointe
     *
     * @return string
     */
    public function getPieceJointe()
    {
        return $this->pieceJointe;
    }

    /**
     * Set datePub
     *
     * @param \DateTime $datePub
     *
     * @return Publication
     */
    public function setDatePub($datePub)
    {
        $this->datePub = $datePub;

        return $this;
    }

    /**
     * Get datePub
     *
     * @return \DateTime
     */
    public function getDatePub()
    {
        return $this->datePub;
    }
    public function addProfessionnels(Professionnel $professionnel)
    {
        $professionnel->addPublication($this);
        $this->id_professionnel[] = $professionnel;
    }

}

