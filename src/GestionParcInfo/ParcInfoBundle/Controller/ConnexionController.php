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
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Process\Process;
use GestionParcInfo\ParcInfoBundle\Entity\Connexion;

class ConnexionController extends Controller
{
    
     public function connexionAction(Request $request)
    {
        
        $process = new Process('ping localhost');
        $process->run();
        $mes=  explode(' ', $process->getOutput())[5];
        $form = $this->createFormBuilder()
            ->setMethod('POST')
            ->setAction($this->generateUrl('login'))
            ->add('password', 'password')
            ->add('username', 'hidden')
            ->add('connexion', 'submit')
            ->getForm();
    
        if($form->handleRequest($request)->isSubmitted()){
            
                $em = $this->getDoctrine()->getManager();
                
                $data = $form->getData();
               
               $co= $em->getRepository('ParcInfoBundle:Connexion')->findOneBy(array('password'=>sha1($data['password'])));
               if(!empty($co)){
                   \Doctrine\Common\Util\Debug::dump("emp");
                   return $this->redirect($this->generateUrl('parc_info_homepage')); 
                   
               }
        }
        $error="";
        return $this->render('ParcInfoBundle:Default:Connexion/Connexion.html.twig', array('form' => $form->createView(),'nom'=>$mes,'error'=> $error));
    }
    
 }
