<?php

namespace BestTripClient\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Guide
 *
 * @ORM\Table(name="guide", uniqueConstraints={@ORM\UniqueConstraint(name="ID_Pays", columns={"ID_Pays"}), @ORM\UniqueConstraint(name="ID_Ville", columns={"ID_Ville"})})
 * @ORM\Entity
 */
class Guide {

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_Guide", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idGuide;

    /**
     * @var string
     *
     * @ORM\Column(name="Titre", type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Ajout", type="date", nullable=true)
     */
    private $dateAjout;

    /**
     * @var string
     *
     * @ORM\Column(name="Lien", type="string", length=250, nullable=false)
     */
    private $lien;

    /**
     * @var \Pays
     *
     * @ORM\ManyToOne(targetEntity="Pays")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_Pays", referencedColumnName="ID_Pays")
     * })
     */
    private $idPays;

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

    /**
     * Get idGuide
     *
     * @return integer 
     */
    public function getIdGuide() {
        return $this->idGuide;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Guide
     */
    public function setTitre($titre) {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre() {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Guide
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     * @return Guide
     */
    public function setDateAjout($dateAjout) {
        $this->dateAjout = $dateAjout;

        return $this;
    }

    /**
     * Get dateAjout
     *
     * @return \DateTime 
     */
    public function getDateAjout() {
        return $this->dateAjout;
    }

    /**
     * Set lien
     *
     * @param string $lien
     * @return Guide
     */
    public function setLien($lien) {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string 
     */
    public function getLien() {
        return $this->lien;
    }

    /**
     * Set idPays
     *
     * @param \BestTripClient\ClientBundle\Entity\Pays $idPays
     * @return Guide
     */
    public function setIdPays(\BestTripClient\ClientBundle\Entity\Pays $idPays = null) {
        $this->idPays = $idPays;

        return $this;
    }

    /**
     * Get idPays
     *
     * @return \BestTripClient\ClientBundle\Entity\Pays 
     */
    public function getIdPays() {
        return $this->idPays;
    }

    /**
     * Set idVille
     *
     * @param \BestTripClient\ClientBundle\Entity\Ville $idVille
     * @return Guide
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
    function getImage() {
        return $this->image;
    }

    function setImage($image) {
        $this->image = $image;
    }



}
