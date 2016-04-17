<?php

namespace BestTripClient\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evaluation
 *
 * @ORM\Table(name="evaluation", uniqueConstraints={@ORM\UniqueConstraint(name="ID_Utilisateur", columns={"ID_Utilisateur", "ID_OffreProfessionnelle"}), @ORM\UniqueConstraint(name="ID_Utilisateur_2", columns={"ID_Utilisateur", "ID_OffrePersonnelle"}), @ORM\UniqueConstraint(name="ID_Utilisateur_3", columns={"ID_Utilisateur", "ID_Guide"}), @ORM\UniqueConstraint(name="ID_Utilisateur_4", columns={"ID_Utilisateur", "ID_Recommandation"}), @ORM\UniqueConstraint(name="ID_Utilisateur_5", columns={"ID_Utilisateur", "ID_Itineraire"}), @ORM\UniqueConstraint(name="ID_Utilisateur_6", columns={"ID_Utilisateur", "ID_Lieu"})}, indexes={@ORM\Index(name="FKEvaluation286228", columns={"ID_Itineraire"}), @ORM\Index(name="FKEvaluation351452", columns={"ID_Recommandation"}), @ORM\Index(name="FKEvaluation727517", columns={"ID_Guide"}), @ORM\Index(name="FKEvaluation246156", columns={"ID_OffrePersonnelle"}), @ORM\Index(name="FKEvaluation667068", columns={"ID_OffreProfessionnelle"}), @ORM\Index(name="FKEvaluation922960", columns={"ID_Utilisateur"}), @ORM\Index(name="FKEvaluation351855", columns={"ID_Lieu"})})
 * @ORM\Entity
 */
class Evaluation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_Evaluation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEvaluation;

    /**
     * @var integer
     *
     * @ORM\Column(name="Note", type="integer", nullable=true)
     */
    private $note;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Ajout", type="date", nullable=true)
     */
    private $dateAjout;

    /**
     * @var \OffrePersonnelle
     *
     * @ORM\ManyToOne(targetEntity="OffrePersonnelle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_OffrePersonnelle", referencedColumnName="ID_OffreP")
     * })
     */
    private $idOffrepersonnelle;

    /**
     * @var \Itineraire
     *
     * @ORM\ManyToOne(targetEntity="Itineraire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_Itineraire", referencedColumnName="ID_Itineraire")
     * })
     */
    private $idItineraire;

    /**
     * @var \Recommandation
     *
     * @ORM\ManyToOne(targetEntity="Recommandation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_Recommandation", referencedColumnName="ID_Recommandation")
     * })
     */
    private $idRecommandation;

    /**
     * @var \Lieu
     *
     * @ORM\ManyToOne(targetEntity="Lieu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_Lieu", referencedColumnName="ID_Lieu")
     * })
     */
    private $idLieu;

    /**
     * @var \OffreProfessionnelle
     *
     * @ORM\ManyToOne(targetEntity="OffreProfessionnelle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_OffreProfessionnelle", referencedColumnName="ID_OffreP")
     * })
     */
    private $idOffreprofessionnelle;

    /**
     * @var \Guide
     *
     * @ORM\ManyToOne(targetEntity="Guide")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_Guide", referencedColumnName="ID_Guide")
     * })
     */
    private $idGuide;

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
     * Get idEvaluation
     *
     * @return integer 
     */
    public function getIdEvaluation()
    {
        return $this->idEvaluation;
    }

    /**
     * Set note
     *
     * @param integer $note
     * @return Evaluation
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return integer 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     * @return Evaluation
     */
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = $dateAjout;

        return $this;
    }

    /**
     * Get dateAjout
     *
     * @return \DateTime 
     */
    public function getDateAjout()
    {
        return $this->dateAjout;
    }

    /**
     * Set idOffrepersonnelle
     *
     * @param \BestTripClient\ClientBundle\Entity\OffrePersonnelle $idOffrepersonnelle
     * @return Evaluation
     */
    public function setIdOffrepersonnelle(\BestTripClient\ClientBundle\Entity\OffrePersonnelle $idOffrepersonnelle = null)
    {
        $this->idOffrepersonnelle = $idOffrepersonnelle;

        return $this;
    }

    /**
     * Get idOffrepersonnelle
     *
     * @return \BestTripClient\ClientBundle\Entity\OffrePersonnelle 
     */
    public function getIdOffrepersonnelle()
    {
        return $this->idOffrepersonnelle;
    }

    /**
     * Set idItineraire
     *
     * @param \BestTripClient\ClientBundle\Entity\Itineraire $idItineraire
     * @return Evaluation
     */
    public function setIdItineraire(\BestTripClient\ClientBundle\Entity\Itineraire $idItineraire = null)
    {
        $this->idItineraire = $idItineraire;

        return $this;
    }

    /**
     * Get idItineraire
     *
     * @return \BestTripClient\ClientBundle\Entity\Itineraire 
     */
    public function getIdItineraire()
    {
        return $this->idItineraire;
    }

    /**
     * Set idRecommandation
     *
     * @param \BestTripClient\ClientBundle\Entity\Recommandation $idRecommandation
     * @return Evaluation
     */
    public function setIdRecommandation(\BestTripClient\ClientBundle\Entity\Recommandation $idRecommandation = null)
    {
        $this->idRecommandation = $idRecommandation;

        return $this;
    }

    /**
     * Get idRecommandation
     *
     * @return \BestTripClient\ClientBundle\Entity\Recommandation 
     */
    public function getIdRecommandation()
    {
        return $this->idRecommandation;
    }

    /**
     * Set idLieu
     *
     * @param \BestTripClient\ClientBundle\Entity\Lieu $idLieu
     * @return Evaluation
     */
    public function setIdLieu(\BestTripClient\ClientBundle\Entity\Lieu $idLieu = null)
    {
        $this->idLieu = $idLieu;

        return $this;
    }

    /**
     * Get idLieu
     *
     * @return \BestTripClient\ClientBundle\Entity\Lieu 
     */
    public function getIdLieu()
    {
        return $this->idLieu;
    }

    /**
     * Set idOffreprofessionnelle
     *
     * @param \BestTripClient\ClientBundle\Entity\OffreProfessionnelle $idOffreprofessionnelle
     * @return Evaluation
     */
    public function setIdOffreprofessionnelle(\BestTripClient\ClientBundle\Entity\OffreProfessionnelle $idOffreprofessionnelle = null)
    {
        $this->idOffreprofessionnelle = $idOffreprofessionnelle;

        return $this;
    }

    /**
     * Get idOffreprofessionnelle
     *
     * @return \BestTripClient\ClientBundle\Entity\OffreProfessionnelle 
     */
    public function getIdOffreprofessionnelle()
    {
        return $this->idOffreprofessionnelle;
    }

    /**
     * Set idGuide
     *
     * @param \BestTripClient\ClientBundle\Entity\Guide $idGuide
     * @return Evaluation
     */
    public function setIdGuide(\BestTripClient\ClientBundle\Entity\Guide $idGuide = null)
    {
        $this->idGuide = $idGuide;

        return $this;
    }

    /**
     * Get idGuide
     *
     * @return \BestTripClient\ClientBundle\Entity\Guide 
     */
    public function getIdGuide()
    {
        return $this->idGuide;
    }

    /**
     * Set idUtilisateur
     *
     * @param \BestTripClient\ClientBundle\Entity\Utilisateur $idUtilisateur
     * @return Evaluation
     */
    public function setIdUtilisateur(\BestTripClient\ClientBundle\Entity\Utilisateur $idUtilisateur = null)
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }

    /**
     * Get idUtilisateur
     *
     * @return \BestTripClient\ClientBundle\Entity\Utilisateur 
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }
}
