<?php

namespace GestionParcInfo\ParcInfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statut
 *
 * @ORM\Table("statut")
 * @ORM\Entity(repositoryClass="GestionParcInfo\ParcInfoBundle\Repository\StatutRepository")
 */
class Statut
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
     * @ORM\Column(name="libelle_statut", type="string", length=100)
     */
    private $libelleStatut;


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
     * Set libelleStatut
     *
     * @param string $libelleStatut
     * @return Statut
     */
    public function setLibelleStatut($libelleStatut)
    {
        $this->libelleStatut = $libelleStatut;

        return $this;
    }

    /**
     * Get libelleStatut
     *
     * @return string 
     */
    public function getLibelleStatut()
    {
        return $this->libelleStatut;
    }
}
