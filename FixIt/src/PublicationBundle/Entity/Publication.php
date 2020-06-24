<?php

namespace PublicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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

    private $id_professionnel;
// N'oubliez pas d'ajouter les champs ( recommandation,avis ) dans la table associative publication_professionnel
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Demandeur")
     * @ORM\JoinColumn(name="id_demandeur",referencedColumnName="id")
     */
    private $idDemandeur;

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
     * Set idDemandeur
     *
     * @param integer $idDemandeur
     *
     * @return Publication
     */
    public function setIdDemandeur($idDemandeur)
    {
        $this->idDemandeur = $idDemandeur;

        return $this;
    }

    /**
     * Get idDemandeur
     *
     * @return int
     */
    public function getIdDemandeur()
    {
        return $this->idDemandeur;
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
}

