<?php

namespace EvaluationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FeedBack
 *
 * @ORM\Table(name="feed_back")
 * @ORM\Entity(repositoryClass="EvaluationBundle\Repository\FeedBackRepository")
 */
class FeedBack
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
     * @ORM\Column(name="avis", type="text", nullable=true)
     */
    private $avis;

    /**
     * @var int
     *
     * @ORM\Column(name="recommandation", type="integer", nullable=true)
     */
    private $recommandation;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Professionnel")
     * @ORM\JoinColumn(name="id_prof",referencedColumnName="id")
     */
    private $idProf;


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
     * Set avis
     *
     * @param string $avis
     *
     * @return FeedBack
     */
    public function setAvis($avis)
    {
        $this->avis = $avis;

        return $this;
    }

    /**
     * Get avis
     *
     * @return string
     */
    public function getAvis()
    {
        return $this->avis;
    }

    /**
     * Set recommandation
     *
     * @param integer $recommandation
     *
     * @return FeedBack
     */
    public function setRecommandation($recommandation)
    {
        $this->recommandation = $recommandation;

        return $this;
    }

    /**
     * Get recommandation
     *
     * @return int
     */
    public function getRecommandation()
    {
        return $this->recommandation;
    }

    /**
     * Set idProf
     *
     * @param integer $idProf
     *
     * @return FeedBack
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
}

