<?php

/* 
 * Ca c'est ce qui va faire le lien entre nos routes/vues 
 */


/*
 * Les includes comme en Java 
 */
namespace GestionParcInfo\ParcInfoBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GestionParcInfo\ParcInfoBundle\Entity\Connexion;


class ConnexionController extends Controller
{
    
     public function connexionAction(Request $request)
    {
         
         $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('parc_info_connexion'))
            ->add('motDePasse', 'password')
            ->add('connexion', 'submit')
            ->getForm();
        if($form->handleRequest($request)->isSubmitted()){
            /* j'ouvre la connexion à la BD Doctrine */
                $em = $this->getDoctrine()->getManager();
                
                $data = $form->getData();
                
               $co= $em->getRepository('ParcInfoBundle:Connexion')->findOneBy(array('id'=>$data['motDePasse']));
               if(!empty($co)){
                   $materiels = $em->getRepository('ParcInfoBundle:Materiel')   
                       ->getMaterielsHS();
        $allsite = $em->getRepository('ParcInfoBundle:Site')->findAll();
        
        $materielPG = $em->getRepository('ParcInfoBundle:Materiel')->getMaterielsPG();
        
        $materielEnPanne = $em->getRepository('ParcInfoBundle:Materiel')->getMaterielEnPanne();
        
        $dernierModif = $em->getRepository('ParcInfoBundle:Materiel')->getDernierMateriels();
        
       
        return $this->render('ParcInfoBundle:Default:index.html.twig', 
                                array('materielHs' => $materiels,'allsite' => $allsite,'materielPG'=>$materielPG,'materielEnPanne'=>$materielEnPanne,'dernierModif'=>$dernierModif));
               }
        }
        return $this->render('ParcInfoBundle:Default:Connexion/Connexion.html.twig', array('form' => $form->createView()));
    }
 }
