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
            \Doctrine\Common\Util\Debug::dump($id);
            $em = $this->getDoctrine()->getManager();
            
            if($categorie == 'Utilisateur'){
                $obj = $em->find(\GestionParcInfo\ParcInfoBundle\Entity\Utilisateur::class, $id);
            }
            
            if($categorie == 'types'){
                $obj = $em->find(\GestionParcInfo\ParcInfoBundle\Entity\Type::class, $id);
            }
            
            if($categorie == 'siteGeo'){
                $obj = $em->find(\GestionParcInfo\ParcInfoBundle\Entity\Site::class, $id);
            }
            
            if($categorie == 'statuts'){
                $obj = $em->find(\GestionParcInfo\ParcInfoBundle\Entity\Statut::class, $id);
            }
            
            if($categorie == 'fabricant'){
                $obj = $em->find(\GestionParcInfo\ParcInfoBundle\Entity\Fabricant::class, $id);
            }
            
            if($categorie == 'revendeur'){
                $obj = $em->find(\GestionParcInfo\ParcInfoBundle\Entity\Revendeur::class, $id);
            }
            
            if($categorie == 'etats'){
                $obj = $em->find(\GestionParcInfo\ParcInfoBundle\Entity\Etat::class, $id);
            }
            
            $em->remove($obj);
            $em->flush();

            return new Response('SUPPRESSION');
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
        
        return new Response('Catégorie inconnue !');
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
                
                $em->persist($obj);
                $em->flush();
                
                return new Response('Type AJOUTER !');
            }
            
            return $this->render('ParcInfoBundle:Default:Parametrage/ajouter.html.twig', 
                array('categorie' => $categorie,
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
                
                $em->persist($obj);
                $em->flush();
                
                return new Response('Statut AJOUTER !');
            }
            
            return $this->render('ParcInfoBundle:Default:Parametrage/ajouter.html.twig', 
                array('categorie' => $categorie,
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
                
                $em->persist($obj);
                $em->flush();
                
                return new Response('Etat AJOUTER !');
            }
            
            return $this->render('ParcInfoBundle:Default:Parametrage/ajouter.html.twig', 
                array('categorie' => $categorie,
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
                
                $obj->setNomUser($data['nom']);
                
                $em->persist($obj);
                $em->flush();
                
                return new Response('Utilisateur AJOUTER !');
            }
            
            return $this->render('ParcInfoBundle:Default:Parametrage/ajouter.html.twig', 
                array('categorie' => $categorie,
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
                
                $em->persist($obj);
                $em->flush();
                
                return new Response('Site géo AJOUTER !');
            }
            
            return $this->render('ParcInfoBundle:Default:Parametrage/ajouter.html.twig', 
                array('categorie' => $categorie,
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
                
                $em->persist($obj);
                $em->flush();
                
                return new Response('Fabricant AJOUTER !');
            }
            
            return $this->render('ParcInfoBundle:Default:Parametrage/ajouter.html.twig', 
                array('categorie' => $categorie,
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
                
                $em->persist($obj);
                $em->flush();
                
                return new Response('Revendeur AJOUTER !');
            }
            
            return $this->render('ParcInfoBundle:Default:Parametrage/ajouter.html.twig', 
                array('categorie' => $categorie,
                        'form' => $form->createView()));
        }
        if ($categorie == 'admin') {
            $form = $this->createFormBuilder()
                    ->add('nom','text')
                    ->add('Ajouter','submit',array('label' => 'Ajouter l\'admin'))
                    ->getForm();
            #A voir avec l'equipe !
            if($form->handleRequest($request)->isSubmitted())
            {
                $data = $form->getData();
                $obj = new Statut();
                
                $obj->setLibelleStatut($data['nom']);
                
                $em->persist($obj);
                $em->flush();
                
                return new Response('Statut AJOUTER !');
            }
            
            return $this->render('ParcInfoBundle:Default:Parametrage/ajouter.html.twig', 
                array('categorie' => $categorie,
                        'form' => $form->createView()));
        }
        
        return new Response('Mauvais type');
    }
}
