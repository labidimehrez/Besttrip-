<?php

namespace BestTripAdmin\AdministrateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recommandation
 *
 * @ORM\Table(name="recommandation", uniqueConstraints={@ORM\UniqueConstraint(name="ID_Utilisateur", columns={"ID_Utilisateur", "ID_Ville"}), @ORM\UniqueConstraint(name="ID_Utilisateur_2", columns={"ID_Utilisateur", "ID_Compagnie"}), @ORM\UniqueConstraint(name="ID_Utilisateur_3", columns={"ID_Utilisateur", "ID_Lieu"})}, indexes={@ORM\Index(name="FKRecommenda941866", columns={"ID_Lieu"}), @ORM\Index(name="FKRecommenda571385", columns={"ID_Ville"}), @ORM\Index(name="FKRecommenda574495", columns={"ID_Utilisateur"}), @ORM\Index(name="FKRecommenda705189", columns={"ID_Compagnie"})})
 * @ORM\Entity
 */
class Recommandation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_Recommandation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRecommandation;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255, nullable=true)
     */
    private $description;

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
     * @var \Ville
     *
     * @ORM\ManyToOne(targetEntity="Ville")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_Ville", referencedColumnName="ID_Ville")
     * })
     */
    private $idVille;

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
     * @var \Lieu
     *
     * @ORM\ManyToOne(targetEntity="Lieu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_Lieu", referencedColumnName="ID_Lieu")
     * })
     */
    private $idLieu;



    /**
     * Get idRecommandation
     *
     * @return integer 
     */
    public function getIdRecommandation()
    {
        return $this->idRecommandation;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Recommandation
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
     * Set titre
     *
     * @param string $titre
     * @return Recommandation
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
     * @return Recommandation
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
     * Set idVille
     *
     * @param \BestTripAdmin\AdministrateurBundle\Entity\Ville $idVille
     * @return Recommandation
     */
    public function setIdVille(\BestTripAdmin\AdministrateurBundle\Entity\Ville $idVille = null)
    {
        $this->idVille = $idVille;

        return $this;
    }

    /**
     * Get idVille
     *
     * @return \BestTripAdmin\AdministrateurBundle\Entity\Ville 
     */
    public function getIdVille()
    {
        return $this->idVille;
    }

    /**
     * Set idUtilisateur
     *
     * @param \BestTripAdmin\AdministrateurBundle\Entity\Utilisateur $idUtilisateur
     * @return Recommandation
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
     * @return Recommandation
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
     * Set idLieu
     *
     * @param \BestTripAdmin\AdministrateurBundle\Entity\Lieu $idLieu
     * @return Recommandation
     */
    public function setIdLieu(\BestTripAdmin\AdministrateurBundle\Entity\Lieu $idLieu = null)
    {
        $this->idLieu = $idLieu;

        return $this;
    }

    /**
     * Get idLieu
     *
     * @return \BestTripAdmin\AdministrateurBundle\Entity\Lieu 
     */
    public function getIdLieu()
    {
        return $this->idLieu;
    }
}
