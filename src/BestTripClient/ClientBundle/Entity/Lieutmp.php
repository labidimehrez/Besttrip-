<?php

namespace BestTripClient\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lieutmp
 *
 * @ORM\Table(name="lieutmp", indexes={@ORM\Index(name="FKLieuxTMP307640", columns={"ID_Ville"}), @ORM\Index(name="ID_Rec", columns={"ID_Rec"})})
 * @ORM\Entity
 */
class Lieutmp
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_lieux", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLieux;

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

    /**
     * @var \Recommandation
     *
     * @ORM\ManyToOne(targetEntity="Recommandation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_Rec", referencedColumnName="ID_Recommandation")
     * })
     */
    private $idRec;



    /**
     * Get idLieux
     *
     * @return integer 
     */
    public function getIdLieux()
    {
        return $this->idLieux;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Lieutmp
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
     * Set adresse
     *
     * @param string $adresse
     * @return Lieutmp
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
     * Set nom
     *
     * @param string $nom
     * @return Lieutmp
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
     * Set idVille
     *
     * @param \BestTripClient\ClientBundle\Entity\Ville $idVille
     * @return Lieutmp
     */
    public function setIdVille(\BestTripClient\ClientBundle\Entity\Ville $idVille = null)
    {
        $this->idVille = $idVille;

        return $this;
    }

    /**
     * Get idVille
     *
     * @return \BestTripClient\ClientBundle\Entity\Ville 
     */
    public function getIdVille()
    {
        return $this->idVille;
    }

    /**
     * Set idRec
     *
     * @param \BestTripClient\ClientBundle\Entity\Recommandation $idRec
     * @return Lieutmp
     */
    public function setIdRec(\BestTripClient\ClientBundle\Entity\Recommandation $idRec = null)
    {
        $this->idRec = $idRec;

        return $this;
    }

    /**
     * Get idRec
     *
     * @return \BestTripClient\ClientBundle\Entity\Recommandation 
     */
    public function getIdRec()
    {
        return $this->idRec;
    }
}
