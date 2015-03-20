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
            $ip = split(' ',$process->getOutput())[6];
            $ip = substr($ip, 1,-1);
            
            \Doctrine\Common\Util\Debug::dump($ip);
 
            if($process->isSuccessful()){
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


