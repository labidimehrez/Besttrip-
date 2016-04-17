<?php

namespace BestTripClient\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Compagnie
 *
 * @ORM\Table(name="compagnie", uniqueConstraints={@ORM\UniqueConstraint(name="Nom", columns={"Nom"})})
 * @ORM\Entity
 */
class Compagnie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_Compagnie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCompagnie;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="Type", type="string", length=255, nullable=true)
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
    public function getIdCompagnie()
    {
        return $this->idCompagnie;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Compagnie
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Compagnie
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
     * Set logo
     *
     * @param string $logo
     * @return Compagnie
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set lien
     *
     * @param string $lien
     * @return Compagnie
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
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     * @return Compagnie
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
            public function __toString() {
        return $this->nom;
    }
}
