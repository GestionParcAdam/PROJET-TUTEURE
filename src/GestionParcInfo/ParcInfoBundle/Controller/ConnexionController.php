<?php

/* 
 * Ca c'est ce qui va faire le lien entre nos routes/vues 
 */


/*
 * Les includes comme en Java 
 */
namespace GestionParcInfo\ParcInfoBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;



class ConnexionController extends Controller
{
    
     public function connexionAction(/*Request $request*/)
    {
         $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('parc_info_connexion'))
            ->add('motDePasse', 'password')
            ->add('connexion', 'submit')
            ->getForm();
        /* if($form->handleRequest($request)->isSubmitted()){
             
         }*/
        return $this->render('ParcInfoBundle:Default:Connexion/Connexion.html.twig', array('form' => $form->createView()));
    }
 }
