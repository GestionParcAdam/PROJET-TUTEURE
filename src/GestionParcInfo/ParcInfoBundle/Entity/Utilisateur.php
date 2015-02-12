<?php

namespace GestionParcInfo\ParcInfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateur
 *
 * @ORM\Table("utilisateur")
 * @ORM\Entity(repositoryClass="GestionParcInfo\ParcInfoBundle\Repository\UtilisateurRepository")
 */
class Utilisateur
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
     * @ORM\Column(name="nom_user", type="string", length=255)
     */
    private $nomUser;
    
    /**
    * @var ArrayCollection Materiel $materiels
    *  
    * @ORM\ManyToMany(targetEntity="GestionParcInfo\ParcInfoBundle\Entity\Materiel", mappedBy="utilisateurs", cascade={"persist", "merge"})
    */
    private $materiels;


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
     * Set nomUser
     *
     * @param string $nomUser
     * @return Utilisateur
     */
    public function setNomUser($nomUser)
    {
        $this->nomUser = $nomUser;

        return $this;
    }

    /**
     * Get nomUser
     *
     * @return string 
     */
    public function getNomUser()
    {
        return $this->nomUser;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->materiels = new \Doctrine\Common\Collections\ArrayCollection();
    }



    /**
     * Add materiels
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\Materiel $materiels
     * @return Utilisateur
     */
    public function addMateriel(\GestionParcInfo\ParcInfoBundle\Entity\Materiel $materiels)
    {
        $materiels->addUtilisateur($this);  // Lie le materiel à user.
            
        $this->materiels->add($materiels);
                
        return $this;
    }

    /**
     * Remove materiels
     *
     * @param \GestionParcInfo\ParcInfoBundle\Entity\Materiel $materiels
     */
    public function removeMateriel(\GestionParcInfo\ParcInfoBundle\Entity\Materiel $materiels)
    {
        $this->materiels->removeElement($materiels);
    }

    /**
     * Get materiels
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMateriels()
    {
        return $this->materiels;
    }
}
