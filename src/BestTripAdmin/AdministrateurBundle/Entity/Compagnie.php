<?php

namespace BestTripAdmin\AdministrateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Compagnie
 *
 * @ORM\Table(name="compagnie", uniqueConstraints={@ORM\UniqueConstraint(name="Nom", columns={"Nom"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 *
 */
class Compagnie {

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_Compagnie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCompagnie;

    /**
     * @Assert\File(mimeTypes = {"image/jpg", "image/jpeg", "image/gif", "image/png"},
     * mimeTypesMessage = "Veuillez entrer une image de type JPG, GIF ou PNG."
     * )
     */
    public $file;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message = "Veuillez entrer un nom du compagnie !")
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="Type", type="string", length=255, nullable=true)
     * 
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="Logo", type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="Lien", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message = "Veuillez entrer un lien pour le site de la compagnie ! ")
     */
    private $lien;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Ajout", type="date", nullable=true)
     */
    private $dateAjout;

    /**
     * Get idCompagnie
     *
     * @return integer 
     */
    public function getIdCompagnie() {
        return $this->idCompagnie;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Compagnie
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
     * Set type
     *
     * @param string $type
     * @return Compagnie
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
     * Set logo
     *
     * @param string $logo
     * @return Compagnie
     */
    public function setLogo($logo) {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo() {
        return $this->logo;
    }

    /**
     * Set lien
     *
     * @param string $lien
     * @return Compagnie
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
     * @return Compagnie
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

    public function getAbsolutePath() {
        return null === $this->logo ? null : $this->getUploadRootDir() . '/' . $this->logo;
    }

    public function getWebPath() {
        return null === $this->logo ? null : $this->getUploadDir() . '/' . $this->logo;
    }

    protected function getUploadRootDir() {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'uploads/Compagnie';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\Preupdate() 
     */
    public function preUpload() {

        $this->TmpFile = $this->getAbsolutePath();
        $this->oldFile = $this->getLogo();
        if (null !== $this->file) {

            // faites ce que vous voulez pour générer un nom unique
            $this->logo = sha1(uniqid(mt_rand(), true)) . '.' . $this->file->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate() 
     */
    public function upload() {
        if (null === $this->file) {
            return;
        }

        // s'il y a une erreur lors du déplacement du fichier, une exception
        // va automatiquement être lancée par la méthode move(). Cela va empêcher
        // proprement l'entité d'être persistée dans la base de données si
        // erreur il y a
        $this->file->move($this->getUploadRootDir(), $this->logo);

        unset($this->logo);
        if ($this->oldFile != null) unlink ($this->TmpFile);
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload() {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }

}
