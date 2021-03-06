<?php

namespace BestTripClient\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Signalisation
 *
 * @ORM\Table(name="signalisation", indexes={@ORM\Index(name="FKSignalisat615007", columns={"ID_Recommandation"}), @ORM\Index(name="FKSignalisat549783", columns={"ID_Itineraire"}), @ORM\Index(name="FKSignalisat982600", columns={"ID_OffreP"}), @ORM\Index(name="FKSignalisat186516", columns={"ID_Utilisateur"})})
 * @ORM\Entity
 */
class Signalisation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_Signalisation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSignalisation;

    /**
     * @var string
     *
     * @ORM\Column(name="Type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="Commentaire", type="string", length=255, nullable=true)
     */
    private $commentaire;

    /**
     * @var string
     *
     * @ORM\Column(name="Etat", type="string", length=255, nullable=true)
     */
    private $etat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Ajout", type="date", nullable=true)
     */
    private $dateAjout;

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
     * @var \OffrePersonnelle
     *
     * @ORM\ManyToOne(targetEntity="OffrePersonnelle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_OffreP", referencedColumnName="ID_OffreP")
     * })
     */
    private $idOffrep;



    /**
     * Get idSignalisation
     *
     * @return integer 
     */
    public function getIdSignalisation()
    {
        return $this->idSignalisation;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Signalisation
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     * @return Signalisation
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string 
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set etat
     *
     * @param string $etat
     * @return Signalisation
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
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     * @return Signalisation
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
     * Set idUtilisateur
     *
     * @param \BestTripClient\ClientBundle\Entity\Utilisateur $idUtilisateur
     * @return Signalisation
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

    /**
     * Set idItineraire
     *
     * @param \BestTripClient\ClientBundle\Entity\Itineraire $idItineraire
     * @return Signalisation
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
     * @return Signalisation
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
     * Set idOffrep
     *
     * @param \BestTripClient\ClientBundle\Entity\OffrePersonnelle $idOffrep
     * @return Signalisation
     */
    public function setIdOffrep(\BestTripClient\ClientBundle\Entity\OffrePersonnelle $idOffrep = null)
    {
        $this->idOffrep = $idOffrep;

        return $this;
    }

    /**
     * Get idOffrep
     *
     * @return \BestTripClient\ClientBundle\Entity\OffrePersonnelle 
     */
    public function getIdOffrep()
    {
        return $this->idOffrep;
    }
}
