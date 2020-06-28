<?php

namespace MessagerieBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use \Datetime;

/**
 * Messagerie
 *
 * @ORM\Table(name="messagerie")
 * @ORM\Entity(repositoryClass="MessagerieBundle\Repository\MessagerieRepository")
 */
class Messagerie
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
     * @ORM\Column(name="message", type="text")
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="id_Demandeur", type="string", length=255)
     */
    private $idDemandeur;

    /**
     * @var string
     *
     * @ORM\Column(name="id_Professionnel", type="string", length=255)
     */
    private $idProfessionnel;

    /**
     * @var bool
     *
     * @ORM\Column(name="vu", type="boolean")
     */
    private $vu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_envoi", type="datetime", options={"default": "CURRENT_TIMESTAMP"} , nullable=true)
     */
    private $dateEnvoi;


    public function __construct()
    {
        $this->dateEnvoi = new DateTime(); 
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
     * Set message
     *
     * @param string $message
     *
     * @return Messagerie
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set idDemandeur
     *
     * @param string $idDemandeur
     *
     * @return Messagerie
     */
    public function setIdDemandeur($idDemandeur)
    {
        $this->idDemandeur = $idDemandeur;

        return $this;
    }

    /**
     * Get idDemandeur
     *
     * @return string
     */
    public function getIdDemandeur()
    {
        return $this->idDemandeur;
    }

    /**
     * Set idProfessionnel
     *
     * @param string $idProfessionnel
     *
     * @return Messagerie
     */
    public function setIdProfessionnel($idProfessionnel)
    {
        $this->idProfessionnel = $idProfessionnel;

        return $this;
    }

    /**
     * Get idProfessionnel
     *
     * @return string
     */
    public function getIdProfessionnel()
    {
        return $this->getIdProfessionnel;
    }

    /**
     * Set vue
     *
     * @param boolean $vu
     *
     * @return Messagerie
     */
    public function setVu($vu)
    {
        $this->vu = $vu;

        return $this;
    }

    /**
     * Get vue
     *
     * @return bool
     */
    public function getVu()
    {
        return $this->vu;
    }

    /**
     * Set dateEnvoi
     *
     * @param \DateTime $dateEnvoi
     *
     * @return Messagerie
     */
    public function setDateEnvoi($dateEnvoi)
    {
        $this->dateEnvoi = $dateEnvoi;

        return $this;
    }

    /**
     * Get dateEnvoi
     *
     * @return \DateTime
     */
    public function getDateEnvoi()
    {
        return $this->dateEnvoi;
    }
}

