<?php

namespace GestionParcInfo\ParcInfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Caracteristique
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="GestionParcInfo\ParcInfoBundle\Repository\CaracteristiqueRepository")
 */
class Caracteristique
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
     * @ORM\ManyToOne(targetEntity="GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueCom", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $numCaracCom;
    
    /**
     * @ORM\ManyToOne(targetEntity="GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueLog", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $numCaracLog;
    
    /**
     * @ORM\ManyToOne(targetEntity="GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueRes", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $numCaracRes;
    
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
     * Set numCaracCom
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueCom $numCaracCom
     * @return Caracteristique
     */
    public function setNumCaracCom(\GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueCom $numCaracCom)
    {
        $this->numCaracCom = $numCaracCom;

        return $this;
    }

    /**
     * Get numCaracCom
     *
     * @return \GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueCom 
     */
    public function getNumCaracCom()
    {
        return $this->numCaracCom;
    }

    /**
     * Set numCaracLog
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueLog $numCaracLog
     * @return Caracteristique
     */
    public function setNumCaracLog(\GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueLog $numCaracLog)
    {
        $this->numCaracLog = $numCaracLog;

        return $this;
    }

    /**
     * Get numCaracLog
     *
     * @return \GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueLog 
     */
    public function getNumCaracLog()
    {
        return $this->numCaracLog;
    }

    /**
     * Set numCaracRes
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueRes $numCaracRes
     * @return Caracteristique
     */
    public function setNumCaracRes(\GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueRes $numCaracRes)
    {
        $this->numCaracRes = $numCaracRes;

        return $this;
    }

    /**
     * Get numCaracRes
     *
     * @return \GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueRes 
     */
    public function getNumCaracRes()
    {
        return $this->numCaracRes;
    }
    
}
