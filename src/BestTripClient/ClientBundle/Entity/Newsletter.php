<?php

namespace BestTripClient\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Newsletter
 *
 * @ORM\Table(name="newsletter")
 * @ORM\Entity
 */
class Newsletter
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_NewsLetter", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idNewsletter;

    /**
     * @var string
     *
     * @ORM\Column(name="Sujet", type="string", length=255, nullable=true)
     */
    private $sujet;

    /**
     * @var string
     *
     * @ORM\Column(name="Message", type="string", length=255, nullable=true)
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Ajout", type="date", nullable=true)
     */
    private $dateAjout;



    /**
     * Get idNewsletter
     *
     * @return integer 
     */
    public function getIdNewsletter()
    {
        return $this->idNewsletter;
    }

    /**
     * Set sujet
     *
     * @param string $sujet
     * @return Newsletter
     */
    public function setSujet($sujet)
    {
        $this->sujet = $sujet;

        return $this;
    }

    /**
     * Get sujet
     *
     * @return string 
     */
    public function getSujet()
    {
        return $this->sujet;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return Newsletter
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     * @return Newsletter
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
}
