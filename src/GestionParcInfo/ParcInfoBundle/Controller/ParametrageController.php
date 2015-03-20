<?php

/*
 * Ca c'est ce qui va faire le lien entre nos routes/vues 
 */


/*
 * Les includes comme en Java 
 */

namespace GestionParcInfo\ParcInfoBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GestionParcInfo\ParcInfoBundle\Entity\Type;
use GestionParcInfo\ParcInfoBundle\Entity\Statut;
use GestionParcInfo\ParcInfoBundle\Entity\Etat;
use GestionParcInfo\ParcInfoBundle\Entity\Fabricant;
use GestionParcInfo\ParcInfoBundle\Entity\Revendeur;
use GestionParcInfo\ParcInfoBundle\Entity\Site;
use GestionParcInfo\ParcInfoBundle\Entity\Utilisateur;
use GestionParcInfo\ParcInfoBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class ParametrageController extends Controller {

    public function parametrageAction() {
        return $this->render('ParcInfoBundle:Default:Parametrage/parametrage.html.twig');
    }

    public function suppressionAction(Request $request, $categorie) {
        $form = $this->createFormBuilder()
                ->setMethod('POST')
                ->setAction($this->generateUrl('parc_info_suppression', array('categorie' => $categorie)))
                ->add('Supprimer', 'submit', array('label' => 'Supprimer la sélection',
                    'attr' => array('class' => 'btn btn-danger glyphicon glyphicon-minus-sign',)))
                ->getForm();

        $em = $this->getDoctrine()->getManager();

        if ($form->handleRequest($request)->isSubmitted()) {
            
            $id = $_POST['liste'];
            
            $em = $this->getDoctrine()->getManager();
            
            if($categorie == 'Utilisateur'){
                $obj = $em->getRepository('ParcInfoBundle:Utilisateur')->find($id);
            }
            
            if($categorie == 'types'){
                $obj = $em->getRepository('ParcInfoBundle:Type')->find($id);
            }
            
            if($categorie == 'siteGeo'){
                $obj = $em->getRepository('ParcInfoBundle:Site')->find($id);
            }
            
            if($categorie == 'statuts'){
                $obj = $em->getRepository('ParcInfoBundle:Statut')->find($id);
            }
            
            if($categorie == 'fabricant'){
                $obj = $em->getRepository('ParcInfoBundle:Fabricant')->find($id);
            }
            
            if($categorie == 'revendeur'){
                $obj = $em->getRepository('ParcInfoBundle:Revendeur')->find($id);
            }
            
            if($categorie == 'etats'){
                $obj = $em->getRepository('ParcInfoBundle:Etat')->find($id);
            }
            try{
                $em->remove($obj);
                $em->flush();

            } catch (\Doctrine\DBAL\DBALException $ex) {
               return $this->render('ParcInfoBundle:Default:Parametrage/suppressionException.html.twig');
            }
            
            return $this->redirect($this->generateUrl('parc_info_parametrage'));
        }

        if ($categorie == 'types') {
            $liste = $em->getRepository('ParcInfoBundle:Type')->findAll();
            return $this->render('ParcInfoBundle:Default:Parametrage/suppression.html.twig', array('liste' => $liste,
                        'categorie' => 'types',
                        'form' => $form->createView()));
        }
        if ($categorie == 'statuts') {
            $liste = $em->getRepository('ParcInfoBundle:Statut')->findAll();
            return $this->render('ParcInfoBundle:Default:Parametrage/suppression.html.twig', array('liste' => $liste,
                        'categorie' => 'statuts',
                        'form' => $form->createView()));
        }
        if ($categorie == 'etats') {
            $liste = $em->getRepository('ParcInfoBundle:Etat')->findAll();
            return $this->render('ParcInfoBundle:Default:Parametrage/suppression.html.twig', array('liste' => $liste,
                        'categorie' => 'etats',
                        'form' => $form->createView()));
        }
        if ($categorie == 'Utilisateur'){
            $liste = $em->getRepository('ParcInfoBundle:Utilisateur')->findAll();
            return $this->render('ParcInfoBundle:Default:Parametrage/suppression.html.twig', array('liste' => $liste,
                        'categorie' => 'Utilisateur',
                        'form' => $form->createView()));
        }
        if ($categorie == 'siteGeo') {
            $liste = $em->getRepository('ParcInfoBundle:Site')->findAll();
            return $this->render('ParcInfoBundle:Default:Parametrage/suppression.html.twig', array('liste' => $liste,
                        'categorie' => 'siteGeo',
                        'form' => $form->createView()));
        }
        if ($categorie == 'fabricant') {
            $liste = $em->getRepository('ParcInfoBundle:Fabricant')->findAll();
            return $this->render('ParcInfoBundle:Default:Parametrage/suppression.html.twig', array('liste' => $liste,
                        'categorie' => 'fabricant',
                        'form' => $form->createView()));
        }
        if ($categorie == 'revendeur') {
            $liste = $em->getRepository('ParcInfoBundle:Revendeur')->findAll();
            return $this->render('ParcInfoBundle:Default:Parametrage/suppression.html.twig', array('liste' => $liste,
                        'categorie' => 'revendeur',
                        'form' => $form->createView()));
        }
        if ($categorie == 'admin') {
            $liste = $em->getRepository('ParcInfoBundle:Connexion')->findAll();
            return $this->render('ParcInfoBundle:Default:Parametrage/suppression.html.twig', array('liste' => $liste,
                        'categorie' => 'admin',
                        'form' => $form->createView()));
        }
    }

    public function ajouterAction(Request $request, $categorie){
        
        $em = $this->getDoctrine()->getManager();
        
        if ($categorie == 'types') {
            $form = $this->createFormBuilder()
                    ->add('nom','text')
                    ->add('Ajouter','submit',array('label' => 'Ajouter le type'))
                    ->getForm();
            
            if($form->handleRequest($request)->isSubmitted())
            {
                $data = $form->getData();
                $obj = new Type();
                
                $obj->setLibelleType($data['nom']);
                
                $isPresent = $em->getRepository('ParcInfoBundle:Type')->findBy(array('libelleType' => $data['nom']));
                             
                if(sizeof($isPresent, null)==1)
                {
                    return $this->render('ParcInfoBundle:Default:Parametrage/doublon.html.twig');
                }
                else
                {                                  
                    $em->persist($obj);
                    $em->flush();

                    return $this->redirect($this->generateUrl('parc_info_parametrage'));      
                }

            }
            
            return $this->render('ParcInfoBundle:Default:Parametrage/ajouter.html.twig', 
                array('categorie' => 'Type',
                        'form' => $form->createView()));
        }
        if ($categorie == 'statuts') {
            $form = $this->createFormBuilder()
                    ->add('nom','text')
                    ->add('Ajouter','submit',array('label' => 'Ajouter le statut'))
                    ->getForm();
            
            if($form->handleRequest($request)->isSubmitted())
            {
                $data = $form->getData();
                $obj = new Statut();
                
                $obj->setLibelleStatut($data['nom']);
                
                $isPresent = $em->getRepository('ParcInfoBundle:Statut')->findBy(array('$libelleStatut' => $data['nom']));
                
                 if(sizeof($isPresent, null)==1)
                {
                    return $this->render('ParcInfoBundle:Default:Parametrage/doublon.html.twig');
                }
                else
                { 
                    $em->persist($obj);
                    $em->flush();
                
                    return $this->redirect($this->generateUrl('parc_info_parametrage'));
                }              
            }
            
            return $this->render('ParcInfoBundle:Default:Parametrage/ajouter.html.twig', 
                array('categorie' => 'Statut',
                        'form' => $form->createView()));
        }
        if ($categorie == 'etats') {
            $form = $this->createFormBuilder()
                    ->add('nom','text')
                    ->add('Ajouter','submit',array('label' => 'Ajouter l\'état'))
                    ->getForm();
            if($form->handleRequest($request)->isSubmitted())
            {
                $data = $form->getData();
                $obj = new Etat();
                
                $obj->setLibelleEtat($data['nom']);
                
                $isPresent = $em->getRepository('ParcInfoBundle:Etat')->findBy(array('$libelleEtat' => $data['nom']));
                
                 if(sizeof($isPresent, null)==1)
                {
                    return $this->render('ParcInfoBundle:Default:Parametrage/doublon.html.twig');
                }
                else
                { 
                    $em->persist($obj);
                    $em->flush();

                    return $this->redirect($this->generateUrl('parc_info_parametrage'));
                }
            }
            
            return $this->render('ParcInfoBundle:Default:Parametrage/ajouter.html.twig', 
                array('categorie' => 'Etat',
                        'form' => $form->createView()));
        }
        if ($categorie == 'Utilisateur'){
            $form = $this->createFormBuilder()
                    ->add('nom','text')
                    ->add('Ajouter','submit',array('label' => 'Ajouter l\'utilisateur'))
                    ->getForm();
            
            if($form->handleRequest($request)->isSubmitted())
            {
                $data = $form->getData();
                $obj = new Utilisateur();
                
                $isPresent = $em->getRepository('ParcInfoBundle:Utilisateur')->findBy(array('nomUser' => $data['nom']));
                             
                if(sizeof($isPresent, null)==1)
                {
                    return $this->render('ParcInfoBundle:Default:Parametrage/doublon.html.twig');
                }
                else
                {
                    $obj->setNomUser($data['nom']);

                    $em->persist($obj);
                    $em->flush();
                
                    return $this->redirect($this->generateUrl('parc_info_parametrage'));
                }
            }
            
            return $this->render('ParcInfoBundle:Default:Parametrage/ajouter.html.twig', 
                array('categorie' => 'Utilisateur',
                        'form' => $form->createView()));
        }
        if ($categorie == 'siteGeo') {
            $form = $this->createFormBuilder()
                    ->add('nom','text')
                    ->add('adresse','text')
                    ->add('Ajouter','submit',array('label' => 'Ajouter le site géographique'))
                    ->getForm();
            
            if($form->handleRequest($request)->isSubmitted())
            {
                $data = $form->getData();
                $obj = new Site();
                
                $obj->setNomSite($data['nom']);
                $obj->setAdresseSite($data['adresse']);
                
                $isPresent = $em->getRepository('ParcInfoBundle:Site')->findBy(array('$nomSite' => $data['nom']));
                
                 if(sizeof($isPresent, null)==1)
                {
                    return $this->render('ParcInfoBundle:Default:Parametrage/doublon.html.twig');
                }
                else
                { 
                    $em->persist($obj);
                    $em->flush();

                    return $this->redirect($this->generateUrl('parc_info_parametrage'));
                }
            }
            
            return $this->render('ParcInfoBundle:Default:Parametrage/ajouter.html.twig', 
                array('categorie' => 'Site Géographique',
                        'form' => $form->createView()));
        }
        if ($categorie == 'fabricant') {
            $form = $this->createFormBuilder()
                    ->add('nom','text')
                    ->add('Ajouter','submit',array('label' => 'Ajouter le fabricant'))
                    ->getForm();
            
            if($form->handleRequest($request)->isSubmitted())
            {
                $data = $form->getData();
                $obj = new Fabricant();
                
                $obj->setNomFabricant($data['nom']);
                
                $isPresent = $em->getRepository('ParcInfoBundle:Fabricant')->findBy(array('$nomFabricant' => $data['nom']));
                
                 if(sizeof($isPresent, null)==1)
                {
                    return $this->render('ParcInfoBundle:Default:Parametrage/doublon.html.twig');
                }
                else
                { 
                    $em->persist($obj);
                    $em->flush();

                    return $this->redirect($this->generateUrl('parc_info_parametrage'));
                }
            }
            
            return $this->render('ParcInfoBundle:Default:Parametrage/ajouter.html.twig', 
                array('categorie' => 'Fabricant',
                        'form' => $form->createView()));
        }
        if ($categorie == 'revendeur') {
            $form = $this->createFormBuilder()
                    ->add('nom','text')
                    ->add('Ajouter','submit',array('label' => 'Ajouter le revendeur'))
                    ->getForm();
            
            if($form->handleRequest($request)->isSubmitted())
            {
                $data = $form->getData();
                $obj = new Revendeur();
                
                $obj->setNomRevendeur($data['nom']);
                
                $isPresent = $em->getRepository('ParcInfoBundle:Revendeur')->findBy(array('$nomRevendeur' => $data['nom']));
                
                 if(sizeof($isPresent, null)==1)
                {
                    return $this->render('ParcInfoBundle:Default:Parametrage/doublon.html.twig');
                }
                else
                { 
                    $em->persist($obj);
                    $em->flush();

                    return $this->redirect($this->generateUrl('parc_info_parametrage'));
                }
            }
            
            return $this->render('ParcInfoBundle:Default:Parametrage/ajouter.html.twig', 
                array('categorie' => 'Revendeur',
                        'form' => $form->createView()));
        }
        if ($categorie == 'admin') {
            $user = $em->getRepository('ParcInfoBundle:User')->find(1);
            $form = $this->createFormBuilder()
                    ->add('nom','text', array('data' => $user->getUsername()))
                    ->add('ancienMDP','password')
                    ->add('newMDP','password')
                    ->add('confMDP','password')
                    ->add('Enregistrer','submit')
                    ->getForm();
            
            #A voir avec l'equipe !
            if($form->handleRequest($request)->isSubmitted())
            {
                $data = $form->getData();
                \Doctrine\Common\Util\Debug::dump($data);
                $user->setUsername($data['nom']);
                
                if(!empty($data['newMDP'])){
                    $user->setPlainPassword($data['newMDP']);
                    $password=$data['newMDP'];
                    $encoder = getEncoder($user);
                    $user->setPassword($encoder->encodePassword($password, $user->getSalt()));
                    $user->eraseCredentials();
                }
                
                $em->persist($obj);
                $em->flush();
                
                return $this->redirect($this->generateUrl('parc_info_parametrage'));
            }
            
            return $this->render('ParcInfoBundle:Default:Parametrage/adminParam.html.twig', 
                array('categorie' => 'Admin',
                        'form' => $form->createView()));
        }
    }
    
    public function modifierAction(Request $request, $categorie, $data){
        
    }
}
