<?php

namespace BestTripClient\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;



/**
 * Media
 *
 * @ORM\Table(name="media", uniqueConstraints={@ORM\UniqueConstraint(name="ID_Ville", columns={"ID_Ville"}), @ORM\UniqueConstraint(name="ID_Pays", columns={"ID_Pays"})}, indexes={@ORM\Index(name="FKMedia913728", columns={"ID_Itineraire"}), @ORM\Index(name="FKMedia909624", columns={"ID_Lieu"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Media {

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_Media", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMedia;

    /**
     * @var string
     *
     * @ORM\Column(name="Type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="Lien", type="string", length=255, nullable=true)
     */
    private $lien;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Ajout", type="date", nullable=true)
     */
    private $dateAjout;

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
     * @var \Itineraire
     *
     * @ORM\ManyToOne(targetEntity="Itineraire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_Itineraire", referencedColumnName="ID_Itineraire")
     * })
     */
    private $idItineraire;
    
    
    public $file;

    public function getUploadRootDir() {
        return __DIR__ . '/../../../../web/uploads/Itineraire';
    }

    public function getAbsolutePath() {
        return null === $this->lien ? null : $this->getUploadRootDir() . '/' . $this->lien;
    }

    /**
     * @ORM\Prepersist()
     * @ORM\PreUpdate()
     */
    public function preUpload() {
        $this->tempFile = $this->getAbsolutePath();
        $this->oldFile = $this->getLien();

        if (null !== $this->file) {
            $this->lien = sha1(uniqid(mt_rand(), true)) . '.' . $this->file->guessExtension();
        }
    }

    /**
     * @ORM\Postpersist()
     * @ORM\PostUpdate()
     */
    public function upload() {
        if (null !== $this->file) {
            $this->file->move($this->getUploadRootDir(), $this->lien);
            unset($this->lien);

            if ($this->oldFile != null) {
                unlink($this->tempFile);
            }
        }
    }

    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload() {
        $this->tempFile = $this->getAbsolutePath();
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload() {
        if (file_exists($this->tempFile)) {
            unlink($this->tempFile);
        }
    }

    /**
     * Get idMedia
     *
     * @return integer 
     */
    public function getIdMedia() {
        return $this->idMedia;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Media
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
     * Set lien
     *
     * @param string $lien
     * @return Media
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
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     * @return Media
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
     * Set idPays
     *
     * @param \BestTripClient\ClientBundle\Entity\Pays $idPays
     * @return Media
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
     * @return Media
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

    /**
     * Set idLieu
     *
     * @param \BestTripClient\ClientBundle\Entity\Lieu $idLieu
     * @return Media
     */
    public function setIdLieu(\BestTripClient\ClientBundle\Entity\Lieu $idLieu = null) {
        $this->idLieu = $idLieu;

        return $this;
    }

    /**
     * Get idLieu
     *
     * @return \BestTripClient\ClientBundle\Entity\Lieu 
     */
    public function getIdLieu() {
        return $this->idLieu;
    }

    /**
     * Set idItineraire
     *
     * @param \BestTripClient\ClientBundle\Entity\Itineraire $idItineraire
     * @return Media
     */
    public function setIdItineraire(\BestTripClient\ClientBundle\Entity\Itineraire $idItineraire = null) {
        $this->idItineraire = $idItineraire;

        return $this;
    }

    /**
     * Get idItineraire
     *
     * @return \BestTripClient\ClientBundle\Entity\Itineraire 
     */
    public function getIdItineraire() {
        return $this->idItineraire;
    }

}
