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
    
     public function rechercherAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('parc_info_resultatRecherche'))
            ->add('typeMat', 'entity', array('class' => 'ParcInfoBundle:Type', 
                                             'property' => 'libelleType',
                                              'empty_value' => 'Aucun','required'=>false))
            ->add('nomMat', 'text',array('required'=>false))
            ->add('etatMat', 'entity',array('class' => 'ParcInfoBundle:Etat', 
                                             'property' => 'libelleEtat',
                                              'empty_value' => 'Aucun','required'=>false))
            ->add('statutMat', 'entity', array('class' => 'ParcInfoBundle:Statut', 
                                             'property' => 'libelleStatut',
                                              'empty_value' => 'Aucun','required'=>false))
            ->add('siteGeo', 'entity', array('class' => 'ParcInfoBundle:Site', 
                                             'property' => 'nomSite',
                                              'empty_value' => 'Aucun','required'=>false))
            ->add('dateAchat','date',array('input'  => 'datetime',
                                           'widget' => 'single_text',
                                              'empty_value' => 'Aucun','required'=>false))
            ->add('numFacture','text',array('required'=>false))
            ->add('modele','text',array('required'=>false))
            ->add('fabricant','entity',array('class' => 'ParcInfoBundle:Fabricant', 
                                             'property' => 'nomFabricant',
                                              'empty_value' => 'Aucun','required'=>false))
            ->add('revendeur','entity',array('class' => 'ParcInfoBundle:Revendeur', 
                                             'property' => 'nomRevendeur',
                                              'empty_value' => 'Aucun','required'=>false))
            ->add('utilisateur','entity',array('class' => 'ParcInfoBundle:Utilisateur', 
                                             'property' => 'nomUser',
                                              'empty_value' => 'Aucun','required'=>false))
            ->add('lancerLaRecherche', 'submit')
            ->getForm();
        $form->handleRequest($request);
        if($form->get('lancerLaRecherche')->isClicked()){
            $this->render('ParcInfoBundle:Default:RechercherMateriel/rechercherResultat.html.twig');
        }
        
        
        return $this->render('ParcInfoBundle:Default:RechercherMateriel/rechercherMateriel.html.twig', array('form' => $form->createView()));
    }
     public function resultatAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $type = $em->getRepository('ParcInfoBundle:Type')->findAll();
         
         
         $materiels = $em->getRepository('ParcInfoBundle:Materiel')   
                       ->getRechercheMateriels(array('numSite'=>$_POST['form']['siteGeo'],
                           'numType'=>$_POST['form']['typeMat'],
                           'nomMat'=>$_POST['form']['nomMat'],
                           'etatmat'=>$_POST['form']['etatMat'],
                           'statutMat'=>$_POST['form']['statutMat'],
                           'dateAchat'=>$_POST['form']['dateAchat'],
                           'numFacture'=>$_POST['form']['numFacture'],
                           'modele'=>$_POST['form']['modele'],
                           'fabricant'=>$_POST['form']['fabricant'],
                           'revendeur'=>$_POST['form']['revendeur'],
                           'utilisateur'=>$_POST['form']['utilisateur']));
        
          
        $type = $em->getRepository('ParcInfoBundle:Type')->findAll();
        return $this->render('ParcInfoBundle:Default:RechercherMateriel/rechercherResultat.html.twig',
                array('type'=>$type,'materiels'=>$materiels));
    }
 }
