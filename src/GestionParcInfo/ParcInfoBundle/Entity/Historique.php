<?php

namespace GestionParcInfo\ParcInfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Historique
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="GestionParcInfo\ParcInfoBundle\Repository\HistoriqueRepository")
 */
class Historique
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\ManyToMany(targetEntity="GestionParcInfo\ParcInfoBundle\Entity\Materiel", cascade={"persist"})
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateIntervention", type="date")
     */
    private $dateIntervention;

    /**
     * @var string
     *
     * @ORM\Column(name="objet_intervention", type="string", length=255)
     */
    private $objetIntervention;

    /**
     * @var string
     *
     * @ORM\Column(name="desc_intervention", type="string", length=255)
     */
    private $descIntervention;

    /**
     * @var string
     *
     * @ORM\Column(name="prestataire_intervention", type="string", length=255)
     */
    private $prestataireIntervention;

    /**
     * @var string
     *
     * @ORM\Column(name="cout_intervention", type="string", length=255)
     */
    private $coutIntervention;


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
     * Set dateIntervention
     *
     * @param \DateTime $dateIntervention
     * @return Historique
     */
    public function setDateIntervention($dateIntervention)
    {
        $this->dateIntervention = $dateIntervention;

        return $this;
    }

    /**
     * Get dateIntervention
     *
     * @return \DateTime 
     */
    public function getDateIntervention()
    {
        return $this->dateIntervention;
    }

    /**
     * Set objetIntervention
     *
     * @param string $objetIntervention
     * @return Historique
     */
    public function setObjetIntervention($objetIntervention)
    {
        $this->objetIntervention = $objetIntervention;

        return $this;
    }

    /**
     * Get objetIntervention
     *
     * @return string 
     */
    public function getObjetIntervention()
    {
        return $this->objetIntervention;
    }

    /**
     * Set descIntervention
     *
     * @param string $descIntervention
     * @return Historique
     */
    public function setDescIntervention($descIntervention)
    {
        $this->descIntervention = $descIntervention;

        return $this;
    }

    /**
     * Get descIntervention
     *
     * @return string 
     */
    public function getDescIntervention()
    {
        return $this->descIntervention;
    }

    /**
     * Set prestataireIntervention
     *
     * @param string $prestataireIntervention
     * @return Historique
     */
    public function setPrestataireIntervention($prestataireIntervention)
    {
        $this->prestataireIntervention = $prestataireIntervention;

        return $this;
    }

    /**
     * Get prestataireIntervention
     *
     * @return string 
     */
    public function getPrestataireIntervention()
    {
        return $this->prestataireIntervention;
    }

    /**
     * Set coutIntervention
     *
     * @param string $coutIntervention
     * @return Historique
     */
    public function setCoutIntervention($coutIntervention)
    {
        $this->coutIntervention = $coutIntervention;

        return $this;
    }

    /**
     * Get coutIntervention
     *
     * @return string 
     */
    public function getCoutIntervention()
    {
        return $this->coutIntervention;
    }
}
