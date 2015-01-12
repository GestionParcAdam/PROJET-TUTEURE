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
}
