<?php

namespace GestionParcInfo\ParcInfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CaracteristiqueLog
 *
 * @ORM\Table("caracteristiquelog")
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
     * @ORM\Column(name="nomEditeur", type="string", length=255)
     */
    private $nomEditeur;

    /**
     * @var string
     *
     * @ORM\Column(name="versionLog", type="string", length=255)
     */
    private $versionLog;
    
    /**
     * @var string
     *
     * @ORM\Column(name="licence", type="string", length=255)
     */
    private $licence;

    /**
     * @var Caracteristique $carac
     * 
     * @ORM\ManyToOne(targetEntity="GestionParcInfo\ParcInfoBundle\Entity\Caracteristique", inversedBy="numLogCarac", cascade={"persist","remove"});
     */
    private $carac;
    
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
     * Set nomEditeur
     *
     * @param string $nomEditeur
     * @return CaracteristiqueLog
     */
    public function setNomEditeur($nomEditeur)
    {
        $this->nomEditeur = $nomEditeur;
    
        return $this;
    }

    /**
     * Get nomEditeur
     *
     * @return string 
     */
    public function getNomEditeur()
    {
        return $this->nomEditeur;
    }

    /**
     * Set licence
     *
     * @param string $licence
     * @return CaracteristiqueLog
     */
    public function setLicence($licence)
    {
        $this->licence = $licence;
    
        return $this;
    }

    /**
     * Get licence
     *
     * @return string 
     */
    public function getLicence()
    {
        return $this->licence;
    }


    /**
     * Set carac
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\Caracteristique $carac
     * @return CaracteristiqueLog
     */
    public function setCarac(\GestionParcInfo\ParcInfoBundle\Entity\Caracteristique $carac = null)
    {
        $this->carac = $carac;
    
        return $this;
    }

    /**
     * Get carac
     *
     * @return \GestionParcInfo\ParcInfoBundle\Entity\Caracteristique 
     */
    public function getCarac()
    {
        return $this->carac;
    }
}
