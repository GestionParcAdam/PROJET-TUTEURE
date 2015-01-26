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
use GestionParcInfo\ParcInfoBundle\Entity\Materiel;

class ModifierController extends Controller
{
    
     public function modifierAction(Request $request, $idmat)
    {
        $em = $this->getDoctrine()->getManager();
         
        $materiel = $em->getRepository('ParcInfoBundle:Materiel')->find($idmat);
        
        $form = $this->createFormBuilder()
                ->setMethod('POST')
                ->setAction($this->generateUrl('parc_info_modifier', array('idmat' => $materiel->getId())))
                ->add('typeMat', 'entity', array('class' => 'ParcInfoBundle:Type',
                    'property' => 'libelleType'))
                ->add('nomMat', 'text')
                ->add('etatMat', 'entity', array('class' => 'ParcInfoBundle:Etat',
                    'property' => 'libelleEtat'))
                ->add('statutMat', 'entity', array('class' => 'ParcInfoBundle:Statut',
                    'property' => 'libelleStatut'))
                ->add('siteGeo', 'entity', array('class' => 'ParcInfoBundle:Site',
                    'property' => 'nomSite'))
                ->add('dateAchat', 'date', array('input' => 'datetime',
                    'widget' => 'single_text'))
                ->add('prixAchat', 'money'/* ,array('currency' => 'false') */)
                ->add('numFacture', 'text')
                ->add('modele', 'text')
                ->add('fabricant', 'entity', array('class' => 'ParcInfoBundle:Fabricant',
                    'property' => 'nomFabricant'))
                ->add('revendeur', 'entity', array('class' => 'ParcInfoBundle:Revendeur',
                    'property' => 'nomRevendeur'))
                ->add('immobilisation', 'text')
                ->add('nomUser', 'text')
                ->add('editeur', 'text')
                ->add('nomLog', 'text')
                ->add('licence', 'text')
                ->add('dateInterv', 'date', array('input' => 'datetime',
                    'widget' => 'single_text'))
                ->add('objInterv', 'text')
                ->add('descInterv', 'textarea')
                ->add('prestaInterv', 'text')
                ->add('coutInterv', 'text')
                ->add('versionLogiciel', 'text')
                ->add('adMac', 'text')
                ->add('adIp', 'text')
                ->add('adPasserelle', 'text')
                ->add('dateGarantie', 'date', array('input' => 'datetime',
                    'widget' => 'single_text'))
                ->add('modifier', 'submit')
                ->getForm();
        
         if ($form->handleRequest($request)->isSubmitted()) {
            if ($form->get('modifier')->isClicked()) {
                $data = $form->getData();
                $materiel->setNomMat($data['form[nomMat]']);
                
                $em->flush();
                
                return new Response('modifier !!!!!!!!!!');
            }
         }
         
         return $this->render('ParcInfoBundle:Default:Materiel/modifierMateriel.html.twig', array("materiel" => $materiel, 'form' => $form->createView()));
    }
 }
