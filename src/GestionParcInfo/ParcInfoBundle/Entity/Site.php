<?php

namespace GestionParcInfo\ParcInfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Site
 *
 * @ORM\Table("site")
 * @ORM\Entity(repositoryClass="GestionParcInfo\ParcInfoBundle\Repository\SiteRepository")
 */
class Site
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
     * @var string
     *
     * @ORM\Column(name="nom_site", type="string", length=100)
     */
    private $nomSite;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_site", type="string", length=255)
     */
    private $adresseSite;

    /**
     *
     * @ORM\OneToMany(targetEntity="GestionParcInfo\ParcInfoBundle\Entity\Materiel", mappedBy="numSite", cascade={"persist"})
     */
    protected $materiels;
    
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
     * Set nomSite
     *
     * @param string $nomSite
     * @return Site
     */
    public function setNomSite($nomSite)
    {
        $this->nomSite = $nomSite;

        return $this;
    }

    /**
     * Get nomSite
     *
     * @return string 
     */
    public function getNomSite()
    {
        return $this->nomSite;
    }

    /**
     * Set adresseSite
     *
     * @param string $adresseSite
     * @return Site
     */
    public function setAdresseSite($adresseSite)
    {
        $this->adresseSite = $adresseSite;

        return $this;
    }

    /**
     * Get adresseSite
     *
     * @return string 
     */
    public function getAdresseSite()
    {
        return $this->adresseSite;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->materiels = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add materiels
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\Materiel $materiels
     * @return Site
     */
    public function addMateriel(\GestionParcInfo\ParcInfoBundle\Entity\Materiel $materiels)
    {
        $this->materiels[] = $materiels;
    
        return $this;
    }

    /**
     * Remove materiels
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\Materiel $materiels
     */
    public function removeMateriel(\GestionParcInfo\ParcInfoBundle\Entity\Materiel $materiels)
    {
        $this->materiels->removeElement($materiels);
    }

    /**
     * Get materiels
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMateriels()
    {
        return $this->materiels;
    }
}
