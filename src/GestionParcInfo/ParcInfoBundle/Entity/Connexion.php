<?php

namespace GestionParcInfo\ParcInfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Connexion
 *
 * @ORM\Table("connexion")
 * @ORM\Entity(repositoryClass="GestionParcInfo\ParcInfoBundle\Repository\ConnexionRepository")
 */
class Connexion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="string")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    

    /**
     * Get id
     *
     * @return string 
     */
    public function getId()
    {
        return $this->id;
    }
}
