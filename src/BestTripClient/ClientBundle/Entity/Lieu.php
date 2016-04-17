<?php

namespace BestTripClient\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=255, nullable=true)
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
    private $image;
    private $nbrec;

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
     * @param \BestTripClient\ClientBundle\Entity\Ville $idVille
     * @return Lieu
     */
    public function setIdVille(\BestTripClient\ClientBundle\Entity\Ville $idVille = null) {
        $this->idVille = $idVille;

        return $this;
    }

    /**
     * Get idVille
     *
     * @return \BestTripClient\ClientBundle\Entity\Ville 
     */
    public function getIdVille() {
        return $this->idVille;
    }

    public function __toString() {
        return $this->nom;
    }

    function getImage() {
        return $this->image;
    }

    function setImage($image) {
        $this->image = $image;
    }
    function getNbrec() {
        return $this->nbrec;
    }

    function setNbrec($nbrec) {
        $this->nbrec = $nbrec;
    }


}
