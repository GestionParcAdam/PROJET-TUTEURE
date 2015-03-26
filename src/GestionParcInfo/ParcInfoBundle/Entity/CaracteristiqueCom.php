<?php

namespace GestionParcInfo\ParcInfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CaracteristiqueCom
 *
 * @ORM\Table("caracteristiquecom")
 * @ORM\Entity(repositoryClass="GestionParcInfo\ParcInfoBundle\Repository\CaracteristiqueComRepository")
 */
class CaracteristiqueCom
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAchat", type="date", nullable=true)
     */
    private $dateAchat;

    /**
     * @var string
     *
     * @ORM\Column(name="prixAchat", type="string", length=255, nullable=true)
     */
    private $prixAchat;
    
    /**
     * @var string
     *
     * @ORM\Column(name="numFacture", type="string", length=255, nullable=true)
     */
    private $numFacture;

    /**
     * @var string
     *
     * @ORM\Column(name="libelleModele", type="string", length=255, nullable=true)
     */
    private $libelleModele;
    
    /**
     * @var string
     *
     * @ORM\Column(name="numImmo", type="string", length=255, nullable=true)
     */
    private $numImmo;
    
    /**
     * @ORM\ManyToOne(targetEntity="GestionParcInfo\ParcInfoBundle\Entity\Fabricant", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $numFabricant = null;
    
    /**
     * @ORM\ManyToOne(targetEntity="GestionParcInfo\ParcInfoBundle\Entity\Revendeur", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $numRevendeur = null;
    /**
     * @ORM\OneToMany(targetEntity="GestionParcInfo\ParcInfoBundle\Entity\Caracteristique", mappedBy="numCaracCom",cascade={"persist","remove"})
     */
    private $carac;

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->carac = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set dateAchat
     *
     * @param \DateTime $dateAchat
     * @return CaracteristiqueCom
     */
    public function setDateAchat($dateAchat)
    {
        $this->dateAchat = $dateAchat;
    
        return $this;
    }

    /**
     * Get dateAchat
     *
     * @return \DateTime 
     */
    public function getDateAchat()
    {
        return $this->dateAchat;
    }

    /**
     * Set prixAchat
     *
     * @param string $prixAchat
     * @return CaracteristiqueCom
     */
    public function setPrixAchat($prixAchat)
    {
        $this->prixAchat = $prixAchat;
    
        return $this;
    }

    /**
     * Get prixAchat
     *
     * @return string 
     */
    public function getPrixAchat()
    {
        return $this->prixAchat;
    }

    /**
     * Set numFacture
     *
     * @param string $numFacture
     * @return CaracteristiqueCom
     */
    public function setNumFacture($numFacture)
    {
        $this->numFacture = $numFacture;
    
        return $this;
    }

    /**
     * Get numFacture
     *
     * @return string 
     */
    public function getNumFacture()
    {
        return $this->numFacture;
    }

    /**
     * Set libelleModele
     *
     * @param string $libelleModele
     * @return CaracteristiqueCom
     */
    public function setLibelleModele($libelleModele)
    {
        $this->libelleModele = $libelleModele;
    
        return $this;
    }

    /**
     * Get libelleModele
     *
     * @return string 
     */
    public function getLibelleModele()
    {
        return $this->libelleModele;
    }

    /**
     * Set numImmo
     *
     * @param string $numImmo
     * @return CaracteristiqueCom
     */
    public function setNumImmo($numImmo)
    {
        $this->numImmo = $numImmo;
    
        return $this;
    }

    /**
     * Get numImmo
     *
     * @return string 
     */
    public function getNumImmo()
    {
        return $this->numImmo;
    }

    /**
     * Set numFabricant
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\Fabricant $numFabricant
     * @return CaracteristiqueCom
     */
    public function setNumFabricant(\GestionParcInfo\ParcInfoBundle\Entity\Fabricant $numFabricant = null)
    {
        $this->numFabricant = $numFabricant;
    
        return $this;
    }

    /**
     * Get numFabricant
     *
     * @return \GestionParcInfo\ParcInfoBundle\Entity\Fabricant 
     */
    public function getNumFabricant()
    {
        return $this->numFabricant;
    }

    /**
     * Set numRevendeur
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\Revendeur $numRevendeur
     * @return CaracteristiqueCom
     */
    public function setNumRevendeur(\GestionParcInfo\ParcInfoBundle\Entity\Revendeur $numRevendeur = null)
    {
        $this->numRevendeur = $numRevendeur;
    
        return $this;
    }

    /**
     * Get numRevendeur
     *
     * @return \GestionParcInfo\ParcInfoBundle\Entity\Revendeur 
     */
    public function getNumRevendeur()
    {
        return $this->numRevendeur;
    }

    /**
     * Add carac
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\Caracteristique $carac
     * @return CaracteristiqueCom
     */
    public function addCarac(\GestionParcInfo\ParcInfoBundle\Entity\Caracteristique $carac)
    {
        $this->carac[] = $carac;
    
        return $this;
    }

    /**
     * Remove carac
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\Caracteristique $carac
     */
    public function removeCarac(\GestionParcInfo\ParcInfoBundle\Entity\Caracteristique $carac)
    {
        $this->carac->removeElement($carac);
    }

    /**
     * Get carac
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCarac()
    {
        return $this->carac;
    }
}
