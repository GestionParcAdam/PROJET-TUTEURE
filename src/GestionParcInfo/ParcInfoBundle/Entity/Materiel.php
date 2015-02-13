<<<<<<< HEAD
<?php

namespace GestionParcInfo\ParcInfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DoctrineCommonCollectionsArrayCollection;


/**
 * Materiel
 *
 * @ORM\Table("materiel")
 * @ORM\Entity(repositoryClass="GestionParcInfo\ParcInfoBundle\Repository\MaterielRepository")
 */
class Materiel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_mat", type="string", length=100)
     */
    private $nomMat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_garantie", type="date")
     */
    private $dateGarantie;

    /** 
     * @ORM\ManyToOne(targetEntity="GestionParcInfo\ParcInfoBundle\Entity\Site", inversedBy="materiels", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false, referencedColumnName="id")
     */
    private $numSite;
    
    /**
     * @ORM\ManyToOne(targetEntity="GestionParcInfo\ParcInfoBundle\Entity\Etat", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $numEtat;
    
    /**
     * @ORM\ManyToOne(targetEntity="GestionParcInfo\ParcInfoBundle\Entity\Statut", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $numStatut;
    
    /**
     * @ORM\OneToMany(targetEntity="GestionParcInfo\ParcInfoBundle\Entity\Historique", mappedBy="materiel", cascade={"persist","remove"}, orphanRemoval=true)  
    */
    private $historiques;
    
    /**
    * @var ArrayCollection Materiel $utilisateurs
    * 
    * @ORM\ManyToMany(targetEntity="GestionParcInfo\ParcInfoBundle\Entity\Utilisateur", inversedBy="materiels", cascade={"persist", "merge"})
    * @ORM\JoinTable(name="utilisateurs_materiels")
    */
    private $utilisateurs;
    
    /**
     * @ORM\ManyToOne(targetEntity="GestionParcInfo\ParcInfoBundle\Entity\Caracteristique", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $numCarac;
    
    /**
     * @ORM\ManyToOne(targetEntity="GestionParcInfo\ParcInfoBundle\Entity\Type", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $numType;
    
    /**
     *
     * @var \DateTime
     * 
     * @ORM\Column(name="dateLastModif", type="date")
     */
    private $dateLastModif;
    
   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->historiques = new \Doctrine\Common\Collections\ArrayCollection();
        $this->utilisateurs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomMat
     *
     * @param string $nomMat
     * @return Materiel
     */
    public function setNomMat($nomMat)
    {
        $this->nomMat = $nomMat;
    
        return $this;
    }

    /**
     * Get nomMat
     *
     * @return string 
     */
    public function getNomMat()
    {
        return $this->nomMat;
    }

    /**
     * Set dateGarantie
     *
     * @param \DateTime $dateGarantie
     * @return Materiel
     */
    public function setDateGarantie($dateGarantie)
    {
        $this->dateGarantie = $dateGarantie;
    
        return $this;
    }

    /**
     * Get dateGarantie
     *
     * @return \DateTime 
     */
    public function getDateGarantie()
    {
        return $this->dateGarantie;
    }

    /**
     * Set dateLastModif
     *
     * @param \DateTime $dateLastModif
     * @return Materiel
     */
    public function setDateLastModif($dateLastModif)
    {
        $this->dateLastModif = $dateLastModif;
    
        return $this;
    }

    /**
     * Get dateLastModif
     *
     * @return \DateTime 
     */
    public function getDateLastModif()
    {
        return $this->dateLastModif;
    }

    /**
     * Set numSite
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\Site $numSite
     * @return Materiel
     */
    public function setNumSite(\GestionParcInfo\ParcInfoBundle\Entity\Site $numSite)
    {
        $this->numSite = $numSite;
    
        return $this;
    }

    /**
     * Get numSite
     *
     * @return \GestionParcInfo\ParcInfoBundle\Entity\Site 
     */
    public function getNumSite()
    {
        return $this->numSite;
    }

    /**
     * Set numEtat
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\Etat $numEtat
     * @return Materiel
     */
    public function setNumEtat(\GestionParcInfo\ParcInfoBundle\Entity\Etat $numEtat = null)
    {
        $this->numEtat = $numEtat;
    
        return $this;
    }

    /**
     * Get numEtat
     *
     * @return \GestionParcInfo\ParcInfoBundle\Entity\Etat 
     */
    public function getNumEtat()
    {
        return $this->numEtat;
    }

    /**
     * Set numStatut
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\Statut $numStatut
     * @return Materiel
     */
    public function setNumStatut(\GestionParcInfo\ParcInfoBundle\Entity\Statut $numStatut)
    {
        $this->numStatut = $numStatut;
    
        return $this;
    }

    /**
     * Get numStatut
     *
     * @return \GestionParcInfo\ParcInfoBundle\Entity\Statut 
     */
    public function getNumStatut()
    {
        return $this->numStatut;
    }

    /**
     * Add historiques
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\Historique $historiques
     * @return Materiel
     */
    public function addHistorique(\GestionParcInfo\ParcInfoBundle\Entity\Historique $historiques)
    {
        $this->historiques[] = $historiques;
    
        return $this;
    }

    /**
     * Remove historiques
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\Historique $historiques
     */
    public function removeHistorique(\GestionParcInfo\ParcInfoBundle\Entity\Historique $historiques)
    {
        $this->historiques->removeElement($historiques);
    }

    /**
     * Get historiques
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHistoriques()
    {
        return $this->historiques;
    }

    /**
     * Add utilisateurs
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\Utilisateur $utilisateurs
     * @return Materiel
     */
    public function addUtilisateur(\GestionParcInfo\ParcInfoBundle\Entity\Utilisateur $utilisateurs)
    {
        $this->utilisateurs[] = $utilisateurs;
    
        return $this;
    }

    /**
     * Remove utilisateurs
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\Utilisateur $utilisateurs
     */
    public function removeUtilisateur(\GestionParcInfo\ParcInfoBundle\Entity\Utilisateur $utilisateurs)
    {
        $this->utilisateurs->removeElement($utilisateurs);
    }

    /**
     * Get utilisateurs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUtilisateurs()
    {
        return $this->utilisateurs;
    }

    /**
     * Set numCarac
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\Caracteristique $numCarac
     * @return Materiel
     */
    public function setNumCarac(\GestionParcInfo\ParcInfoBundle\Entity\Caracteristique $numCarac = null)
    {
        $this->numCarac = $numCarac;
    
        return $this;
    }

    /**
     * Get numCarac
     *
     * @return \GestionParcInfo\ParcInfoBundle\Entity\Caracteristique 
     */
    public function getNumCarac()
    {
        return $this->numCarac;
    }

    /**
     * Set numType
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\Type $numType
     * @return Materiel
     */
    public function setNumType(\GestionParcInfo\ParcInfoBundle\Entity\Type $numType = null)
    {
        $this->numType = $numType;
    
        return $this;
    }

    /**
     * Get numType
     *
     * @return \GestionParcInfo\ParcInfoBundle\Entity\Type 
     */
    public function getNumType()
    {
        return $this->numType;
    }
=======
<?php

namespace GestionParcInfo\ParcInfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DoctrineCommonCollectionsArrayCollection;


/**
 * Materiel
 *
 * @ORM\Table("materiel")
 * @ORM\Entity(repositoryClass="GestionParcInfo\ParcInfoBundle\Repository\MaterielRepository")
 */
class Materiel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_mat", type="string", length=100)
     */
    private $nomMat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_garantie", type="date")
     */
    private $dateGarantie;

    /** 
     * @ORM\ManyToOne(targetEntity="GestionParcInfo\ParcInfoBundle\Entity\Site", inversedBy="materiels", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false, referencedColumnName="id")
     */
    private $numSite;
    
    /**
     * @ORM\ManyToOne(targetEntity="GestionParcInfo\ParcInfoBundle\Entity\Etat", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $numEtat;
    
    /**
     * @ORM\ManyToOne(targetEntity="GestionParcInfo\ParcInfoBundle\Entity\Statut", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $numStatut;
    
    /**
     * @ORM\OneToMany(targetEntity="GestionParcInfo\ParcInfoBundle\Entity\Historique", mappedBy="materiel")
     */
    private $historiques;
    
    /**
    * @var ArrayCollection Materiel $utilisateurs
    * 
    * @ORM\ManyToMany(targetEntity="GestionParcInfo\ParcInfoBundle\Entity\Utilisateur", inversedBy="materiels", cascade={"persist", "merge"})
    * @ORM\JoinTable(name="utilisateurs_materiels")
    */
    private $utilisateurs;
    
    /**
     * @ORM\ManyToOne(targetEntity="GestionParcInfo\ParcInfoBundle\Entity\Caracteristique", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $numCarac;
    
    /**
     * @ORM\ManyToOne(targetEntity="GestionParcInfo\ParcInfoBundle\Entity\Type", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $numType;
    
    /**
     *
     * @var \DateTime
     * 
     * @ORM\Column(name="dateLastModif", type="date")
     */
    private $dateLastModif;
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomMat
     *
     * @param string $nomMat
     * @return Materiel
     */
    public function setNomMat($nomMat)
    {
        $this->nomMat = $nomMat;

        return $this;
    }

    /**
     * Get nomMat
     *
     * @return string 
     */
    public function getNomMat()
    {
        return $this->nomMat;
    }

    /**
     * Set dateGarantie
     *
     * @param \DateTime $dateGarantie
     * @return Materiel
     */
    public function setDateGarantie($dateGarantie)
    {
        $this->dateGarantie = $dateGarantie;

        return $this;
    }

    /**
     * Get dateGarantie
     *
     * @return \DateTime 
     */
    public function getDateGarantie()
    {
        return $this->dateGarantie;
    }

    /**
     * Set numSite
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\Site $numSite
     * @return Materiel
     */
    public function setNumSite(\GestionParcInfo\ParcInfoBundle\Entity\Site $numSite)
    {
        $this->numSite = $numSite;

        return $this;
    }

    /**
     * Get numSite
     *
     * @return \GestionParcInfo\ParcInfoBundle\Entity\Site 
     */
    public function getNumSite()
    {
        return $this->numSite;
    }

    /**
     * Set numEtat
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\Etat $numEtat
     * @return Materiel
     */
    public function setNumEtat(\GestionParcInfo\ParcInfoBundle\Entity\Etat $numEtat)
    {
        $this->numEtat = $numEtat;

        return $this;
    }

    /**
     * Get numEtat
     *
     * @return \GestionParcInfo\ParcInfoBundle\Entity\Etat 
     */
    public function getNumEtat()
    {
        return $this->numEtat;
    }

    /**
     * Set numStatut
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\Statut $numStatut
     * @return Materiel
     */
    public function setNumStatut(\GestionParcInfo\ParcInfoBundle\Entity\Statut $numStatut)
    {
        $this->numStatut = $numStatut;

        return $this;
    }

    /**
     * Get numStatut
     *
     * @return \GestionParcInfo\ParcInfoBundle\Entity\Statut 
     */
    public function getNumStatut()
    {
        return $this->numStatut;
    }
    
    /**
     * Set numCarac
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\Caracteristique $numCarac
     * @return Materiel
     */
    public function setNumCarac(\GestionParcInfo\ParcInfoBundle\Entity\Caracteristique $numCarac)
    {
        $this->numCarac = $numCarac;

        return $this;
    }

    /**
     * Get numCarac
     *
     * @return \GestionParcInfo\ParcInfoBundle\Entity\Caracteristique 
     */
    public function getNumCarac()
    {
        return $this->numCarac;
    }

    /**
     * Set numType
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\Type $numType
     * @return Materiel
     */
    public function setNumType(\GestionParcInfo\ParcInfoBundle\Entity\Type $numType = null)
    {
        $this->numType = $numType;

        return $this;
    }

    /**
     * Get numType
     *
     * @return \GestionParcInfo\ParcInfoBundle\Entity\Type 
     */
    public function getNumType()
    {
        return $this->numType;
    }

    /**
     * Set dateLastModif
     *
     * @param \DateTime $dateLastModif
     * @return Materiel
     */
    public function setDateLastModif($dateLastModif)
    {
        $this->dateLastModif = $dateLastModif;
    
        return $this;
    }

    /**
     * Get dateLastModif
     *
     * @return \DateTime 
     */
    public function getDateLastModif()
    {
        return $this->dateLastModif;
    }
  
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->historiques = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add historiques
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\Historique $historiques
     * @return Materiel
     */
    public function addHistorique(\GestionParcInfo\ParcInfoBundle\Entity\Historique $historiques)
    {
        $this->historiques[] = $historiques;

        return $this;
    }

    /**
     * Remove historiques
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\Historique $historiques
     */
    public function removeHistorique(\GestionParcInfo\ParcInfoBundle\Entity\Historique $historiques)
    {
        $this->historiques->removeElement($historiques);
    }

    /**
     * Get historiques
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHistoriques()
    {
        return $this->historiques;
    }

    /**
     * Add utilisateurs
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\Utilisateur $utilisateurs
     * @return Materiel
     */
    public function addUtilisateur(\GestionParcInfo\ParcInfoBundle\Entity\Utilisateur $utilisateurs)
    {
        $this->utilisateurs[] = $utilisateurs;
        
        return $this;
    }

    /**
     * Remove utilisateurs
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\Utilisateur $utilisateurs
     */
    public function removeUtilisateur(\GestionParcInfo\ParcInfoBundle\Entity\Utilisateur $utilisateurs)
    {
        $this->utilisateurs->removeElement($utilisateurs);
    }

    /**
     * Get utilisateurs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUtilisateurs()
    {
        return $this->utilisateurs;
    }
>>>>>>> origin/master
}
