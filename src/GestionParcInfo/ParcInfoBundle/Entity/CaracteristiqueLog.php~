<?php

namespace GestionParcInfo\ParcInfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CaracteristiqueLog
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="GestionParcInfo\ParcInfoBundle\Repository\CaracteristiqueLogRepository")
 */
class CaracteristiqueLog
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
     * @ORM\Column(name="nomLog", type="string", length=255)
     */
    private $nomLog;

    /**
     * @var string
     *
     * @ORM\Column(name="versionLog", type="string", length=255)
     */
    private $versionLog;
    
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
     * Set nomLog
     *
     * @param string $nomLog
     * @return CaracteristiqueLog
     */
    public function setNomLog($nomLog)
    {
        $this->nomLog = $nomLog;

        return $this;
    }

    /**
     * Get nomLog
     *
     * @return string 
     */
    public function getNomLog()
    {
        return $this->nomLog;
    }

    /**
     * Set versionLog
     *
     * @param string $versionLog
     * @return CaracteristiqueLog
     */
    public function setVersionLog($versionLog)
    {
        $this->versionLog = $versionLog;

        return $this;
    }

    /**
     * Get versionLog
     *
     * @return string 
     */
    public function getVersionLog()
    {
        return $this->versionLog;
    }

    /**
     * Set numFabricant
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\Fabricant $numFabricant
     * @return CaracteristiqueLog
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
     * @return CaracteristiqueLog
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
