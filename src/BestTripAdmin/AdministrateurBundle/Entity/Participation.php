<?php

namespace BestTripAdmin\AdministrateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="participation", indexes={@ORM\Index(name="FKParticipat907569", columns={"ID_Utilisateur"}), @ORM\Index(name="FKParticipat877483", columns={"ID_OffreP"}), @ORM\Index(name="FKParticipat114840", columns={"ID_parrainage"})})
 * @ORM\Entity
 */
class Participation
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Participation", type="date", nullable=false)
     */
    private $dateParticipation;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_participation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idParticipation;

    /**
     * @var \Parrainage
     *
     * @ORM\ManyToOne(targetEntity="Parrainage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_parrainage", referencedColumnName="ID_Parrainage")
     * })
     */
    private $idParrainage;

    /**
     * @var \OffreProfessionnelle
     *
     * @ORM\ManyToOne(targetEntity="OffreProfessionnelle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_OffreP", referencedColumnName="ID_OffreP")
     * })
     */
    private $idOffrep;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_Utilisateur", referencedColumnName="ID_Utilisateur")
     * })
     */
    private $idUtilisateur;



    /**
     * Set dateParticipation
     *
     * @param \DateTime $dateParticipation
     * @return Participation
     */
    public function setDateParticipation($dateParticipation)
    {
        $this->dateParticipation = $dateParticipation;

        return $this;
    }

    /**
     * Get dateParticipation
     *
     * @return \DateTime 
     */
    public function getDateParticipation()
    {
        return $this->dateParticipation;
    }

    /**
     * Get idParticipation
     *
     * @return integer 
     */
    public function getIdParticipation()
    {
        return $this->idParticipation;
    }

    /**
     * Set idParrainage
     *
     * @param \BestTripAdmin\AdministrateurBundle\Entity\Parrainage $idParrainage
     * @return Participation
     */
    public function setIdParrainage(\BestTripAdmin\AdministrateurBundle\Entity\Parrainage $idParrainage = null)
    {
        $this->idParrainage = $idParrainage;

        return $this;
    }

    /**
     * Get idParrainage
     *
     * @return \BestTripAdmin\AdministrateurBundle\Entity\Parrainage 
     */
    public function getIdParrainage()
    {
        return $this->idParrainage;
    }

    /**
     * Set idOffrep
     *
     * @param \BestTripAdmin\AdministrateurBundle\Entity\OffreProfessionnelle $idOffrep
     * @return Participation
     */
    public function setIdOffrep(\BestTripAdmin\AdministrateurBundle\Entity\OffreProfessionnelle $idOffrep = null)
    {
        $this->idOffrep = $idOffrep;

        return $this;
    }

    /**
     * Get idOffrep
     *
     * @return \BestTripAdmin\AdministrateurBundle\Entity\OffreProfessionnelle 
     */
    public function getIdOffrep()
    {
        return $this->idOffrep;
    }

    /**
     * Set idUtilisateur
     *
     * @param \BestTripAdmin\AdministrateurBundle\Entity\Utilisateur $idUtilisateur
     * @return Participation
     */
    public function setIdUtilisateur(\BestTripAdmin\AdministrateurBundle\Entity\Utilisateur $idUtilisateur = null)
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }

    /**
     * Get idUtilisateur
     *
     * @return \BestTripAdmin\AdministrateurBundle\Entity\Utilisateur 
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }
}
