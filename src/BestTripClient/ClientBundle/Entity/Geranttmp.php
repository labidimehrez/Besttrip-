<?php

namespace BestTripClient\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Geranttmp
 *
 * @ORM\Table(name="geranttmp", uniqueConstraints={@ORM\UniqueConstraint(name="EMail", columns={"EMail"})})
 * @ORM\Entity
 */
class Geranttmp
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_Gerant", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idGerant;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom_Agence", type="string", length=255, nullable=true)
     */
    private $nomAgence;

    /**
     * @var string
     *
     * @ORM\Column(name="Adresse", type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="Logo", type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="EMail", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="Mot_De_Passe", type="string", length=255, nullable=true)
     */
    private $motDePasse;



    /**
     * Get idGerant
     *
     * @return integer 
     */
    public function getIdGerant()
    {
        return $this->idGerant;
    }

    /**
     * Set nomAgence
     *
     * @param string $nomAgence
     * @return Geranttmp
     */
    public function setNomAgence($nomAgence)
    {
        $this->nomAgence = $nomAgence;

        return $this;
    }

    /**
     * Get nomAgence
     *
     * @return string 
     */
    public function getNomAgence()
    {
        return $this->nomAgence;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Geranttmp
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set logo
     *
     * @param string $logo
     * @return Geranttmp
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
     * Set email
     *
     * @param string $email
     * @return Geranttmp
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set motDePasse
     *
     * @param string $motDePasse
     * @return Geranttmp
     */
    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    /**
     * Get motDePasse
     *
     * @return string 
     */
    public function getMotDePasse()
    {
        return $this->motDePasse;
    }
}
