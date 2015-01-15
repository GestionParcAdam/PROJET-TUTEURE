<?php

namespace GestionParcInfo\ParcInfoBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * MaterielRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MaterielRepository extends EntityRepository
{
    public function getMaterielsHS()
    {
        $query = $this->getEntityManager()
                    ->createQuery('SELECT m FROM ParcInfoBundle:Materiel m WHERE m.numEtat = :num')
                    ->setParameter('num', 2);
        
        $materielsHS = $query->getResult();
        
        return $materielsHS;
    }
    
    public function getMaterielsPG()
    {
        $query = $this->getEntityManager()
                    ->createQuery('SELECT m FROM ParcInfoBundle:Materiel m WHERE m.numStatut = :num')
                    ->setParameter('num', 3);
        
        $materielsPG = $query->getResult();
        
        return $materielsPG;
    }
    
    public function getMaterielEnPanne()
    {
        $query = $this->getEntityManager()
                ->createQuery('SELECT m FROM ParcInfoBundle:Materiel m WHERE m.numEtat = :num')
                ->setParameter('num', 3);
        $materielsEnPanne = $query->getResult();
        
        return $materielsEnPanne;
    }
    
    public function getDernierMateriels()
    {
        $query = $this->createQueryBuilder('m')
        ->orderBy('m.dateLastModif', 'DESC')
        ->setMaxResults(10)
        ->getQuery();

       $dernierModif = $query->getResult();
       
       return $dernierModif;
    }
    
    public function getMaterielFinGarantie($numSite,$idEtat)
    {
       $today = date("y.m.d");    
       $query = $this->getEntityManager()
                ->createQuery('SELECT m FROM ParcInfoBundle:Materiel m WHERE m.dateGarantie > :date and m.numSite = :numSite and m.numEtat = :idEtat')
                ->setParameter('date', $today)
                ->setParameter('numSite', $numSite)
                ->setParameter('idEtat', $idEtat);
        $materiels = $query->getResult();
        
        return $materiels;
    }
}
