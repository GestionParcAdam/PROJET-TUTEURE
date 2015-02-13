<?php

namespace GestionParcInfo\ParcInfoBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * TypeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TypeRepository extends EntityRepository
{
    public function getAllTypes()
    {
        $query = $this->getEntityManager()
                    ->createQuery('SELECT t FROM ParcInfoBundle:Type t');
        
        $materielsHS = $query->getResult();
        
        return $materielsHS;
    }
}
