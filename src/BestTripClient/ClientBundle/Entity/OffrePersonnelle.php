<?php

namespace BestTripClient\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * OffrePersonnelle
 *
 * @ORM\Table(name="offre_personnelle", indexes={@ORM\Index(name="FKOffre_Pers511268", columns={"ID_Utilisateur"}), @ORM\Index(name="FKOffre_Pers685558", columns={"ID_Ville"})})
 * @ORM\Entity
 */
class OffrePersonnelle
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_OffreP", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOffrep;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Debut", type="date", nullable=true)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_fin", type="date", nullable=true)
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message = "Veuillez entrer une description pour votre offre !")
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="Prix", type="integer", nullable=true)
     * @Assert\NotBlank(message = "Veuillez entrer le prix de cette offre !")
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="Contact", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message = "Veuillez entrer comment on peut vous contacter !")
     */
    private $contact;

    /**
     * @var string
     *@Assert\NotBlank(message = "Veuillez entrer un titre !")
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
     * @var \Ville
     *
     * @ORM\ManyToOne(targetEntity="Ville")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_Ville", referencedColumnName="ID_Ville")
     * })
     */
    private $idVille;


    private $image;
    private $imagepays;
    function getImagepays() {
        return $this->imagepays;
    }

    function setImagepays($imagepays) {
        $this->imagepays = $imagepays;
    }

        function getImage() {
        return $this->image;
    }

    function setImage($image) {
        $this->image = $image;
    }

    
    /**
     * Get idOffrep
     *
     * @return integer 
     */
    public function getIdOffrep()
    {
        return $this->idOffrep;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return OffrePersonnelle
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
     * @return OffrePersonnelle
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
     * @return OffrePersonnelle
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
     * Set prix
     *
     * @param integer $prix
     * @return OffrePersonnelle
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
     * Set contact
     *
     * @param string $contact
     * @return OffrePersonnelle
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string 
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return OffrePersonnelle
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
     * @return OffrePersonnelle
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
     * @return OffrePersonnelle
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
     * @param \BestTripClient\ClientBundle\Entity\Utilisateur $idUtilisateur
     * @return OffrePersonnelle
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
     * Set idVille
     *
     * @param \BestTripClient\ClientBundle\Entity\Ville $idVille
     * @return OffrePersonnelle
     */
    public function setIdVille(\BestTripClient\ClientBundle\Entity\Ville $idVille = null)
    {
        $this->idVille = $idVille;

        return $this;
    }

    /**
     * Get idVille
     *
     * @return \BestTripClient\ClientBundle\Entity\Ville 
     */
    public function getIdVille()
    {
        return $this->idVille;
    }
}
