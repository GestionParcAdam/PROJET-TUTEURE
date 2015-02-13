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
        //3
        $query = $this->getEntityManager()
                    ->createQuery('SELECT m FROM ParcInfoBundle:Materiel m WHERE m.numEtat = :num')
                    ->setParameter('num', 2);
        
        $materielsHS = $query->getResult();
        
        return $materielsHS;
    }
    
    public function getMaterielsPG()
    {
        //6
        $query = $this->getEntityManager()
                    ->createQuery('SELECT m FROM ParcInfoBundle:Materiel m WHERE m.numStatut = :num')
                    ->setParameter('num', 3);
        
        $materielsPG = $query->getResult();
        
        return $materielsPG;
    }
    
    public function getMaterielEnPanne()
    {
        //4
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

    public function getRechercheMateriels($Mat)
    {
        $numSite=$Mat['numSite'];
        $typeMat=$Mat['numType'];
        $nomMat=$Mat['nomMat'];
        $etatMat=$Mat['etatmat'];
        $statutMat=$Mat['statutMat'];
        $dateAchat=$Mat['dateAchat'];
        $numFacture=$Mat['numFacture'];
        $modele=$Mat['modele'];
        $fabricant=$Mat['fabricant'];
        $revendeur=$Mat['revendeur'];
        $utilisateur=$Mat['utilisateur'];
        $firstCo=true;
        $first='';
        $req='';     
        
        if($numSite!=''){
            if($first==''){
                $req=' where ';
                $first='false';
            }
            $numSite='m.numSite='.$numSite;
            $req.=$numSite;
        }
        if($typeMat!=''){
            if($first==''){
                $req=' where ';
                $first='false';
                $typeMat=' m.numType='.$typeMat;
            }else{
                $typeMat=' and m.numType='.$typeMat;
            }
            
            $req.=$typeMat;
        }
        if($nomMat!=''){
            if($first==''){
                $req=' where ';
                $first='false';
                $nomMat=" m.nomMat like '%$nomMat%'";
            }else{
                $nomMat=" and m.nomMat like '%$nomMat%'";
            }
            $req.= $nomMat;           
        }
        if($etatMat!=''){
            if($first==''){
                $req=' where ';
                $first='false';
                $etatMat=' m.numEtat='.$etatMat;
            }else{
                $etatMat=' and m.numEtat='.$etatMat;
            }
            $req.=$etatMat;
        }
        if($statutMat!=''){
            if($first==''){
                $req=' where ';
                $first='false';
                $statutMat='m.numStatut='.$statutMat;
            }else{
                $statutMat='and m.numStatut='.$statutMat;
            }
            $req.=$statutMat;
        }
        if($dateAchat!=''){

            if($first==''){
                $req=' where ';
                $first='false';
                $dateAchat="co.dateAchat >= '$dateAchat'";
            }else{
           
                $dateAchat='and co.dateAchat>='.$dateAchat->getTimestamp();
            } 
            $req.=$dateAchat;
            
            $req=' join c.numCaracCom co '.$req;
            
            $req=' join m.numCarac c '.$req;
            $firstCo=false;
           
        }
        if($numFacture!=''){
            if($first==''){
                $req=' where ';
                $first='false';
                $numFacture=" co.numFacture like '%$numFacture%'";
            }else{
                $numFacture=" and co.numFacture like '%$numFacture%'";
            } 
            $req.=$numFacture;
            if($firstCo){
                $req=' join c.numCaracCom co '.$req;

                $req=' join m.numCarac c '.$req;
                $firstCo=false;
            }
        }
        if($modele!=''){
            if($first==''){
                $req=' where ';
                $first='false';
                $modele=" co.numFacture like '%$modele%'";
            }else{ 
                $modele=" and m.numType like '%$modele%'";
            } 
            $req.=$modele;
            if($firstCo){
                $req=' join c.numCaracCom co '.$req;

                $req=' join m.numCarac c '.$req;
                $firstCo=false;
            }
        }
        if($fabricant!=''){
            if($first==''){
                $req=' where ';
                $first='false';
                $fabricant='co.numFabricant='.$fabricant;
            }else{ 
                $fabricant=' and co.numFabricant='.$fabricant;
            } 
            $req.=$fabricant;
            if($firstCo){
                $req=' join c.numCaracCom co '.$req;

                $req=' join m.numCarac c '.$req;
                $firstCo=false;
            }
        }
        if($revendeur!=''){
            if($first==''){
                $req=' where ';
                $first='false';
                $revendeur=' co.numRevendeur='.$revendeur;
            }else{
                $revendeur=' and co.numRevendeur='.$revendeur;
            } 
            $req.=$revendeur;
            if($firstCo){
                $req=' join c.numCaracCom co '.$req;

                $req=' join m.numCarac c '.$req;
                $firstCo=false;
            }
        }
        if($utilisateur!=''){
            if($first==''){
                $req=' where ';
                $first='false';
                $utilisateur=' u.id='.$utilisateur.'';
            }else{
                $utilisateur=' and u.id ='.$utilisateur;
            }
            $req.=$utilisateur;
            $req = ' join m.utilisateurs u '.$req;
        }
        
        $query = $this->getEntityManager()
                ->createQuery('Select m from ParcInfoBundle:Materiel m '
                        . $req);

       $result = $query->getResult();
       
       return $result;
    }
    

    
    public function getMaterielFinGarantie()
    {
       $today = date("y.m.d");    
       $query = $this->getEntityManager()
                ->createQuery('SELECT m FROM ParcInfoBundle:Materiel m WHERE m.dateGarantie > :date')
                ->setParameter('date', $today);
        $materiels = $query->getResult();
        
        return $materiels;
    }

}
