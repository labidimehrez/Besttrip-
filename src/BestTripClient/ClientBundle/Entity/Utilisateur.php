<?php
namespace BestTripClient\ClientBundle\Entity;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur", uniqueConstraints={@ORM\UniqueConstraint(name="EMail", columns={"EMail"}), @ORM\UniqueConstraint(name="Nom_Agence", columns={"Nom_Agence"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Utilisateur implements UserInterface,  \Serializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_Utilisateur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUtilisateur;
    /**
     * @var string
     *
     * @ORM\Column(name="EMail", type="string", length=255, nullable=true)
     * @Assert\Email(message = "{{ value }}' n'est pas un email valide !")
     */
    private $email;
    /**
     * @var string
     *
     * @ORM\Column(name="Mot_De_Passe", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min = "6",
     *      max = "50",
     *      minMessage = "Votre mot de passe doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre mot de passe ne peut pas être plus long que {{ limit }} caractères")
     */
    private $motDePasse;
    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message = "Veuillez entrer votre nom !")
     */
    private $nom;
    /**
     * @var string
     *
     * @ORM\Column(name="Prenom", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message = "Veuillez entrer votre prenom !")
     */
    private $prenom;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Naissance", type="date", nullable=true)
     * @Assert\Date()
     */
    private $dateNaissance;
    /**
     * @var string
     *
     * @ORM\Column(name="Sexe", type="string", length=255, nullable=true)
     */
    private $sexe;
    /**
     * @var string
     *
     * @ORM\Column(name="Telephone", type="string", length=255, nullable=true)
     */
    private $telephone;
    /**
     * @var string
     *
     * @ORM\Column(name="Photo", type="string", length=255, nullable=true)
     */
    private $photo;
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
     * @Assert\NotBlank(message = "Veuillez entrer votre nom agence !")
     */
    private $adresse;
    /**
     * @var string
     *
     * @ORM\Column(name="Logo", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message = "Veuillez entrer votre adresse !")
     */
    private $logo;
    /**
     * @var string
     *
     * @ORM\Column(name="Type", type="string", length=255, nullable=true)
     */
    private $type;
    /**
     * @var boolean
     *
     * @ORM\Column(name="AbbNewslettre", type="boolean", nullable=true)
     */
    private $abbnewslettre;
    /**
     * @var boolean
     *
     * @ORM\Column(name="Etat_Compte", type="boolean", nullable=true)
     */
    private $etatCompte;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Ajout", type="date", nullable=true)
     */
    private $dateAjout;
    
    /**
     * @Assert\File(mimeTypes = {"image/jpg", "image/jpeg", "image/gif", "image/png"},
     * mimeTypesMessage = "Veuillez entrer une image de type JPG, GIF ou PNG."
     * )
     */
    private $file;
    /**
     * Get idUtilisateur
     *
     * @return integer 
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }
    /**
     * Set email
     *
     * @param string $email
     * @return Utilisateur
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
    public function getFile()
    {
        return $this->file;
    }
    
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }
    
    /**
     * Set motDePasse
     *
     * @param string $motDePasse
     * @return Utilisateur
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
    /**
     * Set nom
     *
     * @param string $nom
     * @return Utilisateur
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
     * Set prenom
     *
     * @param string $prenom
     * @return Utilisateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }
    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }
    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     * @return Utilisateur
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
        return $this;
    }
    /**
     * Get dateNaissance
     *
     * @return \DateTime 
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }
    /**
     * Set sexe
     *
     * @param string $sexe
     * @return Utilisateur
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
        return $this;
    }
    /**
     * Get sexe
     *
     * @return string 
     */
    public function getSexe()
    {
        return $this->sexe;
    }
    /**
     * Set telephone
     *
     * @param string $telephone
     * @return Utilisateur
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
        return $this;
    }
    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }
    /**
     * Set photo
     *
     * @param string $photo
     * @return Utilisateur
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
        return $this;
    }
    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }
    /**
     * Set nomAgence
     *
     * @param string $nomAgence
     * @return Utilisateur
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
     * @return Utilisateur
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
     * @return Utilisateur
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
     * Set type
     *
     * @param string $type
     * @return Utilisateur
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
     * Set abbnewslettre
     *
     * @param boolean $abbnewslettre
     * @return Utilisateur
     */
    public function setAbbnewslettre($abbnewslettre)
    {
        $this->abbnewslettre = $abbnewslettre;
        return $this;
    }
    /**
     * Get abbnewslettre
     *
     * @return boolean 
     */
    public function getAbbnewslettre()
    {
        return $this->abbnewslettre;
    }
    /**
     * Set etatCompte
     *
     * @param boolean $etatCompte
     * @return Utilisateur
     */
    public function setEtatCompte($etatCompte)
    {
        $this->etatCompte = $etatCompte;
        return $this;
    }
    /**
     * Get etatCompte
     *
     * @return boolean 
     */
    public function getEtatCompte()
    {
        return $this->etatCompte;
    }
    /**
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     * @return Utilisateur
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
    public function eraseCredentials() {
        
    }
        public function getUsername() {
        if ((($this->type == "Client")||($this->type == "Gerant"))&&($this->etatCompte==1))
            return $this->email;
    }
    public function getPassword() {
        if ((($this->type == "Client")||($this->type == "Gerant"))&&($this->etatCompte==1))
            return $this->motDePasse;
    }
    public function getRoles() {
        if (($this->type == "Client")&&($this->etatCompte==1))
            return array('ROLE_Client');
        if (($this->type == "Gerant")&&($this->etatCompte==1))
            return array('ROLE_Gerant');
    }
    public function getSalt() {
        return "";
    }
    public function getAbsolutePath() {
        if ($this->type == "Client")
            return null === $this->photo ? null : $this->getUploadRootDir() . '/' . $this->photo;
        if ($this->type == "Gerant")
            return null === $this->logo ? null : $this->getUploadRootDir() . '/' . $this->logo;
    }
    public function getWebPath() {
        if ($this->type == "Client")
            return null === $this->photo ? null : $this->getUploadDir() . '/' . $this->photo;
        if ($this->type == "Gerant")
            return null === $this->logo ? null : $this->getUploadDir() . '/' . $this->logo;
    }
    protected function getUploadRootDir() {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }
    protected function getUploadDir() {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'uploads/Utilisateurs';
    }
    /**
     * @ORM\PrePersist()
     * @ORM\Preupdate() 
     */
    public function preUpload() {
        $this->TmpFile = $this->getAbsolutePath();
        if (null !== $this->file) {
            // faites ce que vous voulez pour générer un nom unique
            if ($this->type == "Gerant")
            {
                $this->logo = sha1(uniqid(mt_rand(), true)) . '.' . $this->file->guessExtension();
                $this->oldFile = $this->getLogo();
            }   
            if ($this->type == "Client")
            {
                $this->photo = sha1(uniqid(mt_rand(), true)) . '.' . $this->file->guessExtension();
                $this->oldFile = $this->getPhoto();
            }
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
        if ($this->type == "Client")
        {
            $this->file->move($this->getUploadRootDir(), $this->photo);
            unset($this->photo);
        }
        else
        {
            $this->file->move($this->getUploadRootDir(), $this->logo);
            unset($this->logo);
        }
//        if ($this->oldFile != null) {
//        unlink ($this->TmpFile);
//        
//        }
    }
    /**
     * @ORM\PostRemove()
     */
    public function removeUpload() {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }

    public function serialize() {
        return serialize(array(
            $this->idUtilisateur,
            $this->email,
            $this->motDePasse,
        ));
    }

    public function unserialize($serialized) {
        list (
            $this->idUtilisateur,
            $this->email,
            $this->motDePasse,
        ) = unserialize($serialized);
 
    }

}