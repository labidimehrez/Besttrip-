<?php

namespace BestTripAdmin\AdministrateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Lieu
 *
 * @ORM\Table(name="lieu", indexes={@ORM\Index(name="FKLieu399976", columns={"ID_Ville"})})
 * @ORM\Entity
 */
class Lieu {

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_Lieu", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLieu;

    /**
     * @var string
     *
     * @ORM\Column(name="Type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="Adresse", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Veuillez entrez une adresse pour le lieu")
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Veuillez entrez un nom pour le lieu")
     */
    private $nom;

    /**
     * @var \Ville
     *
     * @ORM\ManyToOne(targetEntity="Ville")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_Ville", referencedColumnName="ID_Ville")
     * })
     */
    private $idVille;

    private $attachement;

    function getAttachement() {
        return $this->attachement;
    }

    function setAttachement($attachement) {
        $this->attachement = $attachement;
    }

    /**
     * Get idLieu
     *
     * @return integer 
     */
    public function getIdLieu() {
        return $this->idLieu;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Lieu
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Lieu
     */
    public function setAdresse($adresse) {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse() {
        return $this->adresse;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Lieu
     */
    public function setNom($nom) {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * Set idVille
     *
     * @param \BestTripAdmin\AdministrateurBundle\Entity\Ville $idVille
     * @return Lieu
     */
    public function setIdVille(\BestTripAdmin\AdministrateurBundle\Entity\Ville $idVille = null) {
        $this->idVille = $idVille;

        return $this;
    }

    /**
     * Get idVille
     *
     * @return \BestTripAdmin\AdministrateurBundle\Entity\Ville 
     */
    public function getIdVille() {
        return $this->idVille;
    }

}
