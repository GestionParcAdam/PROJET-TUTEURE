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


class DefaultController extends Controller
{
    public function indexAction()
    {   
        /*
        *  Ici j'initilise la connexion à la base de donnée en clair (em = entityManager)
        */
        $em = $this->getDoctrine()->getManager();
        
        /*
         * Ici je demande au manager d'allez chercher le manager de materiels
         * Et de faire getMaterielsHS
         * En Symfony les manager de classe se nomme nomdelaclasseRepository 
         * Donc le get repository va chercher dans le bundle le repository correspondant à l'entité matériel
         * Pour la chercher dans matériel dans les annotations au début on a dit où se trouvait son repository
         */
        $materiels = $em->getRepository('ParcInfoBundle:Materiel')   
                       ->getMaterielsHS();
        $allsite = $em->getRepository('ParcInfoBundle:Site')->findAll();
        
        $materielPG = $em->getRepository('ParcInfoBundle:Materiel')->getMaterielsPG();
        
        $materielEnPanne = $em->getRepository('ParcInfoBundle:Materiel')->getMaterielEnPanne();
        
        $dernierModif = $em->getRepository('ParcInfoBundle:Materiel')->getDernierMateriels();
        
       
        return $this->render('ParcInfoBundle:Default:index.html.twig', 
                                array('materielHs' => $materiels,'allsite' => $allsite,'materielPG'=>$materielPG,'materielEnPanne'=>$materielEnPanne,'dernierModif'=>$dernierModif));
    }
    
    public function ajouterAction(Request $request)
    {    
        /* 
         * property pour un add entity : je dit quel champ (nom dans le fichier class example.php)
         * je veux afficher pour le select
         * 
         * widget => single_text pour un add date : je dis que le input sera un seul champ
         * input => datetime pour un add date : je dis le format de l'input
         * 
         * currency => false pour un add money : je dis de pas afficher la devise 
         * (car elle s'affiche en dehors de l'input (nous on placeholder))
         */
        
        $form = $this->createFormBuilder()
            ->add('typeMat', 'entity', array('class' => 'ParcInfoBundle:Type', 
                                             'property' => 'libelleType'))
            ->add('nomMat', 'text')
            ->add('etatMat', 'entity',array('class' => 'ParcInfoBundle:Etat', 
                                             'property' => 'libelleEtat'))
            ->add('statutMat', 'entity', array('class' => 'ParcInfoBundle:Statut', 
                                             'property' => 'libelleStatut'))
            ->add('siteGeo', 'entity', array('class' => 'ParcInfoBundle:Site', 
                                             'property' => 'nomSite'))
            ->add('dateAchat','date',array('input'  => 'datetime',
                                           'widget' => 'single_text'))
            ->add('prixAchat','money'/*,array('currency' => 'false')*/)
            ->add('numFacture','text')
            ->add('modele','text')
            ->add('fabricant','entity',array('class' => 'ParcInfoBundle:Fabricant', 
                                             'property' => 'nomFabricant'))
            ->add('revendeur','entity',array('class' => 'ParcInfoBundle:Revendeur', 
                                             'property' => 'nomRevendeur'))
            ->add('immobilisation','text')
            ->add('nomUser','text')
            ->add('editeur','text')
            ->add('nomLog','text')
            ->add('licence','text')
                
            ->add('dateInterv','date',array('input'  => 'datetime',
                                           'widget' => 'single_text'))
            ->add('objInterv','text')
            ->add('descInterv','textarea')
            ->add('prestaInterv','text')
            ->add('coutInterv','text')
                
            ->add('versionLogiciel','text')
            ->add('adMac','text')
            ->add('adIp','text')
            ->add('adPasserelle','text')
            ->add('dateGarantie','date',array('input'  => 'datetime',
                                           'widget' => 'single_text'))    
            ->add('ajouter', 'submit')
            ->getForm();
        
        $form->handleRequest($request);
        
        if($form->isSubmitted())
        {
            $requete=$this->get('request');
            if($requete->getMethod() == 'POST'){
                $user=$_POST['user0'];
                var_dump($user);
            }
             
           /* Ici je récupère les informations du formulaire dans un tableau /*/
            $data = $form->getData();
             
            /* Je créer mon objet à persister dans la base */
            $materiel = new Materiel();
            
            $materiel->setNomMat($data['nomMat']);
            $materiel->setDateGarantie($data['dateGarantie']);
            $materiel->setNumEtat($data['etatMat']);
            $materiel->setNumSite($data['siteGeo']);
            $materiel->setNumType($data['typeMat']);
            $materiel->setNumStatut($data['statutMat']);
            
            /* j'ouvre la connexion à la BD Doctrine */
            $em = $this->getDoctrine()->getManager();
            
            /* je dis que je persist l'objet et que j'upload direct en clair */
            $em->persist($materiel);
            $em->flush();
            
            $fabricant = new Fabricant();
            
            $fabricant->setNomFabricant($data['fabricant']);
            
            $em->persist($fabricant);
            $em->flush();
            
            $revendeur = new Revendeur();
            
            $revendeur->setNomRevendeur($data['revendeur']);
            
            $em->persist($revendeur);
            $em->flush();
            
            
            $caracDeCom = new CaracteristiqueCom();
            
            $caracDeCom->setPrixAchat($data['prixAchat']);
            $caracDeCom->setLibelleModele($data['modele']);
            $caracDeCom->setDateAchat($data['dateAchat']);
            $caracDeCom->setNumImmo($data('immobilisation'));
            $caracDeCom->setNumFabricant($fabricant);
                    
            $em->persist($caracDeCom);
            $em->flush();
            
            
            $caracDeRes = new CaracteristiqueRes();
            
            $caracDeRes->setAdressIp($data['adIp']);
            $caracDeRes->setAdressMac($data['adMac']);
            $caracDeRes->setAdressPasserelle($data['adPasserelle']);
            
            $em->persist($caracDeRes);
            $em->flush(); 
            
            
            
            /* ca çà permet de retourner une réponse basique */
            return new Response('<h1>Materiel ajouté !</h1>\n résultat : '.$user);
        }

   
        return $this->render('ParcInfoBundle:Default:AjouterMateriel/ajouterMateriel.html.twig', array('form' => $form->createView()));
    }  
    
    public function rechercherAction()
    {
        $form = $this->createFormBuilder()
            ->add('typeMat', 'entity', array('class' => 'ParcInfoBundle:Type', 
                                             'property' => 'libelleType'))
            ->add('nomMat', 'text')
            ->add('etatMat', 'entity',array('class' => 'ParcInfoBundle:Etat', 
                                             'property' => 'libelleEtat'))
            ->add('statutMat', 'entity', array('class' => 'ParcInfoBundle:Statut', 
                                             'property' => 'libelleStatut'))
            ->add('siteGeo', 'entity', array('class' => 'ParcInfoBundle:Site', 
                                             'property' => 'nomSite'))
            ->add('dateAchat','date',array('input'  => 'datetime',
                                           'widget' => 'single_text'))
            ->add('numFacture','text')
            ->add('modele','text')
            ->add('fabricant','text')
            ->add('revendeur','text')
            ->add('utilisateur','text')     
            ->getForm();
        
        return $this->render('ParcInfoBundle:Default:RechercherMateriel/rechercherMateriel.html.twig', array('form' => $form->createView()));
    }
    
    public function matHSAction()
    {
       
       $em = $this->getDoctrine()->getManager();
       
       $materiels = $em->getRepository('ParcInfoBundle:Materiel')   
                       ->getMaterielsHS();
        
       return $this->render('ParcInfoBundle:Default:PopUp/affichePopUp.html.twig',
               array('materielHs' => $materiels));
    }
    public function matPGAction()
    {
       
       $em = $this->getDoctrine()->getManager();
       
       $materiels = $em->getRepository('ParcInfoBundle:Materiel')   
                       ->getMaterielsPG();
        
       return $this->render('ParcInfoBundle:Default:PopUp/affichePopUpPG.html.twig',
               array('materielPG' => $materiels));
    }
    
        public function matEnPanneAction()
    {
        $em = $this->getDoctrine()->getManager();
        $materiels = $em->getRepository('ParcInfoBundle:Materiel')   
                       ->getMaterielEnPanne();
        
       return $this->render('ParcInfoBundle:Default:PopUp/affichePopUpEnPanne.html.twig',
               array('materielEnPanne' => $materiels));
    }
    public function editionAction()
    {
        $form = $this->createFormBuilder()
            ->add('siteGeo', 'entity', array('class' => 'ParcInfoBundle:Site', 
                                             'property' => 'nomSite',
                                             'empty_value' => 'Tous les sites'))  
            ->add('etatMat', 'entity',array('class' => 'ParcInfoBundle:Etat', 
                                             'property' => 'libelleEtat',
                                             'empty_value' => 'Tous les états'))
            ->getForm();
            
       return $this->render('ParcInfoBundle:Default:EditionRapport/EditionRapport.html.twig', array('form' => $form->createView()));
       
    }
    public function etatAction($numSite,$idEtat)
    {
        
            
      $em = $this->getDoctrine()->getManager();
       
        $mats = $em->getRepository('ParcInfoBundle:Materiel')
                ->findBy(array('numSite'=>$numSite,'numEtat'=>$idEtat));
        $etat = $em->getRepository('ParcInfoBundle:Etat')->find($idEtat)->getLibelleEtat();
       
        return $this->render('ParcInfoBundle:Default:Etat/affichageMaterielByEtat.html.twig', 
                                array('materiels' => $mats,'etat'=>$etat));
    }
    public function ficheAction($idmat)
    {
        $em = $this->getDoctrine()->getManager();
        $materiel = $em->getRepository('ParcInfoBundle:Materiel')->findOneBy(array('id'=>$idmat));
        return $this->render('ParcInfoBundle:Default:Materiel/ficheMateriel.html.twig',array("materiel"=>  $materiel));
    }
    

}
