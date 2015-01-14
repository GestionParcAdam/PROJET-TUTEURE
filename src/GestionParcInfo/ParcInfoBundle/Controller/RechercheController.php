<?php

/* 
 * Ca c'est ce qui va faire le lien entre nos routes/vues 
 */


/*
 * Les includes comme en Java 
 */
namespace GestionParcInfo\ParcInfoBundle\Controller;

use GestionParcInfo\ParcInfoBundle\Entity\Materiel;
use GestionParcInfo\ParcInfoBundle\Entity\Fabricant;
use GestionParcInfo\ParcInfoBundle\Entity\Revendeur;
use GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueCom;
use GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueRes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class RechercheController extends Controller
{
    
     public function rechercherAction()
    {
        $form = $this->createFormBuilder()
            ->add('typeMat', 'entity', array('class' => 'ParcInfoBundle:Type', 
                                             'property' => 'libelleType',
                                              'empty_value' => 'Aucun'))
            ->add('nomMat', 'text')
            ->add('etatMat', 'entity',array('class' => 'ParcInfoBundle:Etat', 
                                             'property' => 'libelleEtat',
                                              'empty_value' => 'Aucun'))
            ->add('statutMat', 'entity', array('class' => 'ParcInfoBundle:Statut', 
                                             'property' => 'libelleStatut',
                                              'empty_value' => 'Aucun'))
            ->add('siteGeo', 'entity', array('class' => 'ParcInfoBundle:Site', 
                                             'property' => 'nomSite',
                                              'empty_value' => 'Aucun'))
            ->add('dateAchat','date',array('input'  => 'datetime',
                                           'widget' => 'single_text',
                                              'empty_value' => 'Aucun'))
            ->add('numFacture','text')
            ->add('modele','text')
            ->add('fabricant','entity',array('class' => 'ParcInfoBundle:Fabricant', 
                                             'property' => 'nomFabricant',
                                              'empty_value' => 'Aucun'))
            ->add('revendeur','entity',array('class' => 'ParcInfoBundle:Revendeur', 
                                             'property' => 'nomRevendeur',
                                              'empty_value' => 'Aucun'))
            ->add('utilisateur','entity',array('class' => 'ParcInfoBundle:Utilisateur', 
                                             'property' => 'nomUser',
                                              'empty_value' => 'Aucun'))     
            ->getForm();
        
        return $this->render('ParcInfoBundle:Default:RechercherMateriel/rechercherMateriel.html.twig', array('form' => $form->createView()));
    }
 }
