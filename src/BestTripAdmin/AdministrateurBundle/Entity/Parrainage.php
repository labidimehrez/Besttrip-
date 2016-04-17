<?php

namespace BestTripAdmin\AdministrateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parrainage
 *
 * @ORM\Table(name="parrainage", indexes={@ORM\Index(name="FKParrainage86828", columns={"ID_Utilisateur"}), @ORM\Index(name="FKParrainage549904", columns={"ID_Itineraire"}), @ORM\Index(name="FKParrainage782477", columns={"ID_Compagnie"})})
 * @ORM\Entity
 */
class Parrainage
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Prix", type="integer", nullable=true)
     */
    private $prix;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateDebut", type="date", nullable=true)
     */
    private $datedebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Datefin", type="date", nullable=true)
     */
    private $datefin;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="NbMax", type="integer", nullable=true)
     */
    private $nbmax;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_Parrainage", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idParrainage;

    /**
     * @var string
     *
     * @ORM\Column(name="Titre", type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Ajout", type="date", nullable=true)
     */
    private $dateAjout;

    /**
     * @var string
     *
     * @ORM\Column(name="Devise", type="string", length=255, nullable=true)
     */
    private $devise;

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
     * @var \Compagnie
     *
     * @ORM\ManyToOne(targetEntity="Compagnie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_Compagnie", referencedColumnName="ID_Compagnie")
     * })
     */
    private $idCompagnie;

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
     * Set prix
     *
     * @param integer $prix
     * @return Parrainage
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return integer 
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set datedebut
     *
     * @param \DateTime $datedebut
     * @return Parrainage
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    /**
     * Get datedebut
     *
     * @return \DateTime 
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * Set datefin
     *
     * @param \DateTime $datefin
     * @return Parrainage
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;

        return $this;
    }

    /**
     * Get datefin
     *
     * @return \DateTime 
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Parrainage
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

    /**
     * Set nbmax
     *
     * @param integer $nbmax
     * @return Parrainage
     */
    public function setNbmax($nbmax)
    {
        $this->nbmax = $nbmax;

        return $this;
    }

    /**
     * Get nbmax
     *
     * @return integer 
     */
    public function getNbmax()
    {
        return $this->nbmax;
    }

    /**
     * Get idParrainage
     *
     * @return integer 
     */
    public function getIdParrainage()
    {
        return $this->idParrainage;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Parrainage
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
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     * @return Parrainage
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
     * Set devise
     *
     * @param string $devise
     * @return Parrainage
     */
    public function setDevise($devise)
    {
        $this->devise = $devise;

        return $this;
    }

    /**
     * Get devise
     *
     * @return string 
     */
    public function getDevise()
    {
        return $this->devise;
    }

    /**
     * Set idItineraire
     *
     * @param \BestTripAdmin\AdministrateurBundle\Entity\Itineraire $idItineraire
     * @return Parrainage
     */
    public function setIdItineraire(\BestTripAdmin\AdministrateurBundle\Entity\Itineraire $idItineraire = null)
    {
        $this->idItineraire = $idItineraire;

        return $this;
    }

    /**
     * Get idItineraire
     *
     * @return \BestTripAdmin\AdministrateurBundle\Entity\Itineraire 
     */
    public function getIdItineraire()
    {
        return $this->idItineraire;
    }

    /**
     * Set idCompagnie
     *
     * @param \BestTripAdmin\AdministrateurBundle\Entity\Compagnie $idCompagnie
     * @return Parrainage
     */
    public function setIdCompagnie(\BestTripAdmin\AdministrateurBundle\Entity\Compagnie $idCompagnie = null)
    {
        $this->idCompagnie = $idCompagnie;

        return $this;
    }

    /**
     * Get idCompagnie
     *
     * @return \BestTripAdmin\AdministrateurBundle\Entity\Compagnie 
     */
    public function getIdCompagnie()
    {
        return $this->idCompagnie;
    }

    /**
     * Set idUtilisateur
     *
     * @param \BestTripAdmin\AdministrateurBundle\Entity\Utilisateur $idUtilisateur
     * @return Parrainage
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
