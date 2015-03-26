<?php

namespace GestionParcInfo\ParcInfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chemin
 *
 * @ORM\Table("chemin")
 * @ORM\Entity(repositoryClass="GestionParcInfo\ParcInfoBundle\Repository\CheminRepository")
 */
class Chemin
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
     * @ORM\Column(name="adresseVnc", type="string", length=40, nullable=true)
     */
    private $adresseVnc;
    

  

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
     * Set adresseVnc
     *
     * @param string $adresseVnc
     * @return Chemin
     */
    public function setAdresseVnc($adresseVnc)
    {
        $this->adresseVnc = $adresseVnc;
    
        return $this;
    }

    /**
     * Get adresseVnc
     *
     * @return string 
     */
    public function getAdresseVnc()
    {
        return $this->adresseVnc;
    }
}
