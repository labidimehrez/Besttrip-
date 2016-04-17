<?php

namespace BestTripAdmin\AdministrateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Guide
 *
 * @ORM\Table(name="guide", uniqueConstraints={@ORM\UniqueConstraint(name="ID_Pays", columns={"ID_Pays"}), @ORM\UniqueConstraint(name="ID_Ville", columns={"ID_Ville"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Guide
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_Guide", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idGuide;

    /**
     * @Assert\File(mimeTypes = {"application/pdf", "application/x-pdf", "image/gif", "image/png"},
     * mimeTypesMessage = "Veuillez choisir un guide de type pdf !"
     * )
     */
    public $file;
    
    /**
     * @var string
     *
     * @ORM\Column(name="Titre", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message = "Veuillez entrer un titre pour le guide !")
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message = "Veuillez entrer une description pour le guide")
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
     * 
     */
    private $idVille;



    /**
     * Get idGuide
     *
     * @return integer 
     */
    public function getIdGuide()
    {
        return $this->idGuide;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Guide
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
     * Set description
     *
     * @param string $description
     * @return Guide
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
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     * @return Guide
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
     * Set lien
     *
     * @param string $lien
     * @return Guide
     */
    public function setLien($lien)
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string 
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * Set idPays
     *
     * @param \BestTripAdmin\AdministrateurBundle\Entity\Pays $idPays
     * @return Guide
     */
    public function setIdPays(\BestTripAdmin\AdministrateurBundle\Entity\Pays $idPays = null)
    {
        $this->idPays = $idPays;

        return $this;
    }

    /**
     * Get idPays
     *
     * @return \BestTripAdmin\AdministrateurBundle\Entity\Pays 
     */
    public function getIdPays()
    {
        return $this->idPays;
    }

    /**
     * Set idVille
     *
     * @param \BestTripAdmin\AdministrateurBundle\Entity\Ville $idVille
     * @return Guide
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
    
     public function getAbsolutePath() {
        return null === $this->lien ? null : $this->getUploadRootDir() . '/' . $this->lien;
    }

    public function getWebPath() {
        return null === $this->lien ? null : $this->getUploadDir() . '/' . $this->lien;
    }

    protected function getUploadRootDir() {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return $this->getUploadDir();
    }

    protected function getUploadDir() {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'uploads/Guide';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload() {
        if (null !== $this->file) {
            // faites ce que vous voulez pour générer un nom unique
            $this->lien = sha1(uniqid(mt_rand(), true)) . '.' . $this->file->guessExtension();
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
        $this->file->move($this->getUploadRootDir(), $this->lien);

        unset($this->lien);
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
