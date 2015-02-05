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
use GestionParcInfo\ParcInfoBundle\Entity\Caracteristique;
use GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueCom;
use Symfony\Component\HttpFoundation\Response;

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
                    'property' => 'libelleType', 'data' => $materiel->getNumType()))
                ->add('nomMat', 'text')
                ->add('etatMat', 'entity', array('class' => 'ParcInfoBundle:Etat',
                    'property' => 'libelleEtat', 'data' => $materiel->getNumEtat()))
                ->add('statutMat', 'entity', array('class' => 'ParcInfoBundle:Statut',
                    'property' => 'libelleStatut', 'data' => $materiel->getNumStatut()))
                ->add('siteGeo', 'entity', array('class' => 'ParcInfoBundle:Site',
                    'property' => 'nomSite', 'data' => $materiel->getNumSite()))
                ->add('dateAchat', 'date', array('input' => 'datetime',
                    'widget' => 'single_text','required' => false, 
                    'data' => $materiel->getNumCarac()
                                       ->getNumCaracCom()
                                       ->getDateAchat()))
                ->add('prixAchat', 'money'/* ,array('currency' => 'false') */, 
                        array('data' => $materiel->getNumCarac()
                                       ->getNumCaracCom()
                                       ->getPrixAchat()))
                ->add('numFacture', 'text', array('required' => false, 
                    'data' => $materiel->getNumCarac()
                                       ->getNumCaracCom()
                                       ->getNumFacture()))
                ->add('modele', 'text', array('required' => false, 
                    'data' => $materiel->getNumCarac()
                                       ->getNumCaracCom()
                                       ->getLibelleModele()))
                ->add('fabricant', 'entity', array('class' => 'ParcInfoBundle:Fabricant',
                    'property' => 'nomFabricant','required' => false, 
                    'data' => $materiel->getNumCarac()
                                       ->getNumCaracCom()
                                       ->getNUmFabricant()))
                ->add('revendeur', 'entity', array('class' => 'ParcInfoBundle:Revendeur',
                    'property' => 'nomRevendeur','required' => false, 
                    'data' => $materiel->getNumCarac()
                                       ->getNumCaracCom()
                                       ->getNumRevendeur()))
                ->add('immobilisation', 'text', array('required' => false, 
                    'data' => $materiel->getNumCarac()
                                       ->getNumCaracCom()
                                       ->getNumImmo()))
                ->add('nbUsers', 'hidden', array('required' => false))
                ->add('selectUser', 'entity', array('class' => 'ParcInfoBundle:Utilisateur',
                    'property' => 'nomUser','required' => false))
                ->add('nbLog', 'hidden', array('required' => false))
                ->add('nbMaintenance', 'hidden', array('required' => false))
                ->add('editeur', 'text', array('required' => false))
                ->add('nomLog', 'text', array('required' => false))
                ->add('licence', 'text', array('required' => false))
                ->add('dateInterv', 'date', array('input' => 'datetime',
                    'widget' => 'single_text','required' => false))
                ->add('objInterv', 'text', array('required' => false))
                ->add('descInterv', 'textarea', array('required' => false))
                ->add('prestaInterv', 'text', array('required' => false))
                ->add('coutInterv', 'text', array('required' => false))
                ->add('versionLogiciel', 'text', array('required' => false))
                ->add('adMac', 'text', array('required' => false))
                ->add('adIp', 'text', array('required' => false))
                ->add('adPasserelle', 'text', array('required' => false))
                ->add('dateGarantie', 'date', array('input' => 'datetime',
                    'widget' => 'single_text','required' => false))
                ->add('modifier', 'submit')
                ->getForm();
        
         if ($form->handleRequest($request)->isSubmitted()) {
            if ($form->get('modifier')->isClicked()) {
                $data = $form->getData();
                
                $materiel->setNomMat($data['nomMat']);
                $materiel->setNumType($data['typeMat']);
                $materiel->setNumEtat($data['etatMat']);
                $materiel->setNumSite($data['siteGeo']);
                $materiel->setNumStatut($data['statutMat']);
                $materiel->setDateGarantie($data['dateGarantie']);
                
                $date = new \DateTime('now');
                $materiel->setDateLastModif($date);

                $carac= $materiel->getNumCarac();
                
                $caracDeCom = $carac->getNumCaracCom();
                
                $caracDeCom->setNumFacture($data['numFacture']);
                $caracDeCom->setPrixAchat($data['prixAchat']);
                $caracDeCom->setLibelleModele($data['modele']);
                $caracDeCom->setDateAchat($data['dateAchat']);
                $caracDeCom->setNumImmo($data['immobilisation']);
                $caracDeCom->setNumFabricant($data['fabricant']);
                $caracDeCom->setNumRevendeur($data['revendeur']);
                
                $caracDeRes = $carac->getNumCaracRes();
                
                $caracDeRes->setAdressIp($data['adIp']);
                $caracDeRes->setAdressMac($data['adMac']);
                $caracDeRes->setAdressPasserelle($data['adPasserelle']);
                
                $em->flush();
                
                return new Response('modifier !!!!!!!!!!');
            }
         }
         
         return $this->render('ParcInfoBundle:Default:Materiel/modifierMateriel.html.twig', array("materiel" => $materiel, 'form' => $form->createView()));
    }
 }
