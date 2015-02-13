<?php

namespace GestionParcInfo\ParcInfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fabricant
 *
 * @ORM\Table("fabricant")
 * @ORM\Entity(repositoryClass="GestionParcInfo\ParcInfoBundle\Repository\FabricantRepository")
 */
class Fabricant
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
     * @ORM\Column(name="nomFabricant", type="string", length=255)
     */
    private $nomFabricant;


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
     * Set nomFabricant
     *
     * @param string $nomFabricant
     * @return Fabricant
     */
    public function setNomFabricant($nomFabricant)
    {
        $this->nomFabricant = $nomFabricant;

        return $this;
    }

    /**
     * Get nomFabricant
     *
     * @return string 
     */
    public function getNomFabricant()
    {
        return $this->nomFabricant;
    }
}
