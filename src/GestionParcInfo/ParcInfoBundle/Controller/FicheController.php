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
use Symfony\Component\Process\Process;

class FicheController extends Controller
{
    public function ficheAction($idmat,  Request $request) {
        $form = $this->createFormBuilder()
            ->add('connexionVNC', 'submit',array('label'=>'Connexion VNC'))
            ->getForm();
        $form1 = $this->createFormBuilder()
            ->add('ping', 'submit')
            ->getForm();
        $em = $this->getDoctrine()->getManager();
        $form1->handleRequest($request);
        $couleur='#fff';
        $materiel = $em->getRepository('ParcInfoBundle:Materiel')->findOneBy(array('id' => $idmat));
        
            $process = new Process('ping -n 1 -4 '.$materiel->getNomMat());
            $process->run();
            
            
            
            if($process->isSuccessful()){
                $ip = explode(' ',$process->getOutput())[6];
                $ip = substr($ip, 1,-1);
                $file = fopen('vnc.bat', 'w+');
                $bat="rem désactive l'affichage des commandes
                    echo off
                    rem remise à blanc de l'écran
                    cls
                    rem définition de la valeur de la variable
                    set variable=%CD%
                    rem affiche du texte en rappelant la variable grâce aux %
                    echo %variable%
                    rem on se deplace
                    cd \"C:\wamp\www\PROJET-TUTEURE\web\ \"
                    rem on lance vnc
                    start vncviewer.exe ".$ip."
                    rem on revien la ou il y avait le bat
                    cd %variable%
                    rem on le suprime
                    del vnc.bat";
                
                fputs($file, $bat);
                fclose($file);
                $couleur='green';
                $mat = $materiel->getNumCarac()->getNumCaracRes()->setAdressIp($ip);
                    $em->persist($mat);
                    $em->flush();
            }else{
                $adr=$em->getRepository('ParcInfoBundle:Caracteristique')
                        ->findOneBy(array('id'=>$materiel->getNumCarac()))->getNumCaracRes();
                $adr = $em->getRepository('ParcInfoBundle:CaracteristiqueRes')->findOneBy(array('id'=>$adr))->getAdressIp();
                $process = new Process('ping -n 1 -4 '.$adr);
                $process->run();
                if($process->isSuccessful()){
                    $ip = explode(' ',$process->getOutput())[6];
                    $ip = substr($ip, 1,-1);
                    $couleur='green';
                    $mat = $materiel->getNumCarac()->getNumCaracRes()->setAdressIp($ip);
                    $em->persist($mat);
                    $em->flush();
                }else{
                    $couleur='red';
                }
               
            }
        
        return $this->render('ParcInfoBundle:Default:Materiel/ficheMateriel.html.twig', array("materiel" => $materiel,'form' => $form->createView(),'form1' => $form1->createView(),'couleur'=>$couleur));
    }
     
 }


