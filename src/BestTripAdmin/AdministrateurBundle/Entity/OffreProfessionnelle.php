<?php

namespace BestTripAdmin\AdministrateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OffreProfessionnelle
 *
 * @ORM\Table(name="offre_professionnelle", indexes={@ORM\Index(name="FKOffre_Prof272391", columns={"ID_Compagnie"}), @ORM\Index(name="FKOffre_Prof141697", columns={"ID_Utilisateur"})})
 * @ORM\Entity
 */
class OffreProfessionnelle
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
     * @ORM\Column(name="Prix", type="integer", nullable=true)
     */
    private $prix;

    /**
     * @var integer
     *
     * @ORM\Column(name="Nb_Max", type="integer", nullable=true)
     */
    private $nbMax;

    /**
     * @var string
     *
     * @ORM\Column(name="Type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="Photo", type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Ajout", type="date", nullable=true)
     */
    private $dateAjout;

    /**
     * @var string
     *
     * @ORM\Column(name="Titre", type="string", length=255, nullable=true)
     */
    private $titre;

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
     * @var \Compagnie
     *
     * @ORM\ManyToOne(targetEntity="Compagnie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_Compagnie", referencedColumnName="ID_Compagnie")
     * })
     */
    private $idCompagnie;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Ville", mappedBy="idOffrep")
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
     * @return OffreProfessionnelle
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
     * @return OffreProfessionnelle
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
     * @return OffreProfessionnelle
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
     * @return OffreProfessionnelle
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
     * Set nbMax
     *
     * @param integer $nbMax
     * @return OffreProfessionnelle
     */
    public function setNbMax($nbMax)
    {
        $this->nbMax = $nbMax;

        return $this;
    }

    /**
     * Get nbMax
     *
     * @return integer 
     */
    public function getNbMax()
    {
        return $this->nbMax;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return OffreProfessionnelle
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
     * Set photo
     *
     * @param string $photo
     * @return OffreProfessionnelle
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     * @return OffreProfessionnelle
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
     * Set titre
     *
     * @param string $titre
     * @return OffreProfessionnelle
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
     * Set devise
     *
     * @param string $devise
     * @return OffreProfessionnelle
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
     * @return OffreProfessionnelle
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
     * Set idCompagnie
     *
     * @param \BestTripAdmin\AdministrateurBundle\Entity\Compagnie $idCompagnie
     * @return OffreProfessionnelle
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
     * Add idVille
     *
     * @param \BestTripAdmin\AdministrateurBundle\Entity\Ville $idVille
     * @return OffreProfessionnelle
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
