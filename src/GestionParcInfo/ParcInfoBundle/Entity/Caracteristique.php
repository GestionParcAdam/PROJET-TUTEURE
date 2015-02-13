<<<<<<< HEAD
<?php

namespace GestionParcInfo\ParcInfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Caracteristique
 *
 * @ORM\Table("caracteristique")
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
     * 
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueCom", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $numCaracCom;
    
    /**
     * @var ArrayCollection $numCaracLog
     * 
     * @ORM\OneToMany(targetEntity="GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueLog", mappedBy="carac", cascade={"persist"},orphanRemoval=true)
     * @ORM\JoinColumn(nullable=false, onDelete="SET NULL")
     */
    private $numCaracLog;
    
    /**
     * @ORM\ManyToOne(targetEntity="GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueRes", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $numCaracRes;
 
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->numCaracLog = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add numCaracLog
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueLog $numCaracLog
     * @return Caracteristique
     */
    public function addNumCaracLog(\GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueLog $numCaracLog)
    {
        $this->numCaracLog[] = $numCaracLog;
    
        return $this;
    }

    /**
     * Remove numCaracLog
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueLog $numCaracLog
     */
    public function removeNumCaracLog(\GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueLog $numCaracLog)
    {
        $this->numCaracLog->removeElement($numCaracLog);
    }

    /**
     * Get numCaracLog
     *
     * @return \Doctrine\Common\Collections\Collection 
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
=======
<?php

namespace GestionParcInfo\ParcInfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Caracteristique
 *
 * @ORM\Table("caracteristique")
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
     * @var ArrayCollection $numCaracLog
     * 
     * @ORM\OneToMany(targetEntity="GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueLog", mappedBy="carac", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $numCaracLog;
    
    /**
     * @ORM\ManyToOne(targetEntity="GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueRes", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $numCaracRes;
 
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->numCaracLog = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add numCaracLog
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueLog $numCaracLog
     * @return Caracteristique
     */
    public function addNumCaracLog(\GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueLog $numCaracLog)
    {
        $this->numCaracLog[] = $numCaracLog;
    
        return $this;
    }

    /**
     * Remove numCaracLog
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueLog $numCaracLog
     */
    public function removeNumCaracLog(\GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueLog $numCaracLog)
    {
        $this->numCaracLog->removeElement($numCaracLog);
    }

    /**
     * Get numCaracLog
     *
     * @return \Doctrine\Common\Collections\Collection 
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
>>>>>>> origin/master
