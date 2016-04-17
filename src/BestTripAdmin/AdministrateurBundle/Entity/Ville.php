<?php

namespace BestTripAdmin\AdministrateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ville
 *
 * @ORM\Table(name="ville", indexes={@ORM\Index(name="FKVille684553", columns={"ID_Pays"})})
 * @ORM\Entity
 */
class Ville
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_Ville", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idVille;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255, nullable=true)
     */
    private $description;

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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Itineraire", mappedBy="idVille")
     */
    private $idItineraire;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="OffreProfessionnelle", inversedBy="idVille")
     * @ORM\JoinTable(name="ville_offre_professionnelle",
     *   joinColumns={
     *     @ORM\JoinColumn(name="ID_Ville", referencedColumnName="ID_Ville")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="ID_OffreP", referencedColumnName="ID_OffreP")
     *   }
     * )
     */
    private $idOffrep;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idItineraire = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idOffrep = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get idVille
     *
     * @return integer 
     */
    public function getIdVille()
    {
        return $this->idVille;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Ville
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
     * Set description
     *
     * @param string $description
     * @return Ville
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
     * Set idPays
     *
     * @param \BestTripAdmin\AdministrateurBundle\Entity\Pays $idPays
     * @return Ville
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
     * Add idItineraire
     *
     * @param \BestTripAdmin\AdministrateurBundle\Entity\Itineraire $idItineraire
     * @return Ville
     */
    public function addIdItineraire(\BestTripAdmin\AdministrateurBundle\Entity\Itineraire $idItineraire)
    {
        $this->idItineraire[] = $idItineraire;

        return $this;
    }

    /**
     * Remove idItineraire
     *
     * @param \BestTripAdmin\AdministrateurBundle\Entity\Itineraire $idItineraire
     */
    public function removeIdItineraire(\BestTripAdmin\AdministrateurBundle\Entity\Itineraire $idItineraire)
    {
        $this->idItineraire->removeElement($idItineraire);
    }

    /**
     * Get idItineraire
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdItineraire()
    {
        return $this->idItineraire;
    }

    /**
     * Add idOffrep
     *
     * @param \BestTripAdmin\AdministrateurBundle\Entity\OffreProfessionnelle $idOffrep
     * @return Ville
     */
    public function addIdOffrep(\BestTripAdmin\AdministrateurBundle\Entity\OffreProfessionnelle $idOffrep)
    {
        $this->idOffrep[] = $idOffrep;

        return $this;
    }

    /**
     * Remove idOffrep
     *
     * @param \BestTripAdmin\AdministrateurBundle\Entity\OffreProfessionnelle $idOffrep
     */
    public function removeIdOffrep(\BestTripAdmin\AdministrateurBundle\Entity\OffreProfessionnelle $idOffrep)
    {
        $this->idOffrep->removeElement($idOffrep);
    }

    /**
     * Get idOffrep
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdOffrep()
    {
        return $this->idOffrep;
    }
    public function __toString() {
         return $this->nom;
    }

    
}
