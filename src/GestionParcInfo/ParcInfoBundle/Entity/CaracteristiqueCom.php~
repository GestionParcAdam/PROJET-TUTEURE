<?php

namespace GestionParcInfo\ParcInfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CaracteristiqueCom
 *
 * @ORM\Table()
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
     * @ORM\Column(name="dateAchat", type="date")
     */
    private $dateAchat;

    /**
     * @var string
     *
     * @ORM\Column(name="prixAchat", type="string", length=255)
     */
    private $prixAchat;
    
    /**
     * @var string
     *
     * @ORM\Column(name="numFacture", type="string", length=255)
     */
    private $numFacture;

    /**
     * @var string
     *
     * @ORM\Column(name="libelleModele", type="string", length=255)
     */
    private $libelleModele;
    
    /**
     * @var string
     *
     * @ORM\Column(name="numImmo", type="string", length=255)
     */
    private $numImmo;
    
    /**
     * @ORM\ManyToOne(targetEntity="GestionParcInfo\ParcInfoBundle\Entity\Fabricant", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $numFabricant;
    
    /**
     * @ORM\ManyToOne(targetEntity="GestionParcInfo\ParcInfoBundle\Entity\Revendeur", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $numRevendeur;

   

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
    public function setNumFabricant(\GestionParcInfo\ParcInfoBundle\Entity\Fabricant $numFabricant)
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
    public function setNumRevendeur(\GestionParcInfo\ParcInfoBundle\Entity\Revendeur $numRevendeur)
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
}
