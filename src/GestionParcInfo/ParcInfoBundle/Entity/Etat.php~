<?php

namespace GestionParcInfo\ParcInfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etat
 *
 * @ORM\Table("etat")
 * @ORM\Entity(repositoryClass="GestionParcInfo\ParcInfoBundle\Repository\EtatRepository")
 */
class Etat
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
     * @ORM\Column(name="libelle_etat", type="string", length=30)
     */
    private $libelleEtat;


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
     * Set libelleEtat
     *
     * @param string $libelleEtat
     * @return Etat
     */
    public function setLibelleEtat($libelleEtat)
    {
        $this->libelleEtat = $libelleEtat;

        return $this;
    }

    /**
     * Get libelleEtat
     *
     * @return string 
     */
    public function getLibelleEtat()
    {
        return $this->libelleEtat;
    }
}
