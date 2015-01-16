<?php

namespace GestionParcInfo\ParcInfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Type
 *
 * @ORM\Table("connexion")
 * @ORM\Entity(repositoryClass="GestionParcInfo\ParcInfoBundle\Repository\ConnexionRepository")
 */
class Connexion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="mdp", type="string", length=100)
     */
    private $mdp;
    
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
     * Set mdp
     *
     * @param string $mdp
     * @return Connexion
     */
    public function setLibelleType($mdp)
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * Get mdp
     *
     * @return string 
     */
    public function getLibelleType()
    {
        return $this->mdp;
    }

}

