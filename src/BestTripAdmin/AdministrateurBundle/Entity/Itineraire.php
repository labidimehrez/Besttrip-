<?php

namespace BestTripAdmin\AdministrateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Itineraire
 *
 * @ORM\Table(name="itineraire", indexes={@ORM\Index(name="FKItineraire378777", columns={"ID_Utilisateur"})})
 * @ORM\Entity
 */
class Itineraire
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_Itineraire", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idItineraire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Debut", type="date", nullable=true)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Fin", type="date", nullable=true)
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="Depense", type="integer", nullable=true)
     */
    private $depense;

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
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_Utilisateur", referencedColumnName="ID_Utilisateur")
     * })
     */
    private $idUtilisateur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Ville", inversedBy="idItineraire")
     * @ORM\JoinTable(name="itineraire_ville",
     *   joinColumns={
     *     @ORM\JoinColumn(name="ID_Itineraire", referencedColumnName="ID_Itineraire")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="ID_Ville", referencedColumnName="ID_Ville")
     *   }
     * )
     */
    private $idVille;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idVille = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get idItineraire
     *
     * @return integer 
     */
    public function getIdItineraire()
    {
        return $this->idItineraire;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return Itineraire
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime 
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     * @return Itineraire
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime 
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Itineraire
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
     * Set depense
     *
     * @param integer $depense
     * @return Itineraire
     */
    public function setDepense($depense)
    {
        $this->depense = $depense;

        return $this;
    }

    /**
     * Get depense
     *
     * @return integer 
     */
    public function getDepense()
    {
        return $this->depense;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Itineraire
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
     * @return Itineraire
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
     * @return Itineraire
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
     * Set idUtilisateur
     *
     * @param \BestTripAdmin\AdministrateurBundle\Entity\Utilisateur $idUtilisateur
     * @return Itineraire
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

    /**
     * Add idVille
     *
     * @param \BestTripAdmin\AdministrateurBundle\Entity\Ville $idVille
     * @return Itineraire
     */
    public function addIdVille(\BestTripAdmin\AdministrateurBundle\Entity\Ville $idVille)
    {
        $this->idVille[] = $idVille;

        return $this;
    }

    /**
     * Remove idVille
     *
     * @param \BestTripAdmin\AdministrateurBundle\Entity\Ville $idVille
     */
    public function removeIdVille(\BestTripAdmin\AdministrateurBundle\Entity\Ville $idVille)
    {
        $this->idVille->removeElement($idVille);
    }

    /**
     * Get idVille
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdVille()
    {
        return $this->idVille;
    }
}
