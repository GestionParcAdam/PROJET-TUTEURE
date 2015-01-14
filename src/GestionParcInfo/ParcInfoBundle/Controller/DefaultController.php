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
use GestionParcInfo\ParcInfoBundle\Entity\Historique;
use GestionParcInfo\ParcInfoBundle\Entity\Utilisateur;
use GestionParcInfo\ParcInfoBundle\Entity\Caracteristique;
use GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueCom;
use GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueRes;
use GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueLog;
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
            ->setMethod('POST')
            ->setAction($this->generateUrl('parc_info_ajouter'))
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
            ->add('nbUsers','text')
            ->add('nbLog','text')
            ->add('nbMaintenance','text')
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
        
        if($form->handleRequest($request)->isSubmitted())
        {
             /* j'ouvre la connexion à la BD Doctrine */
            $em = $this->getDoctrine()->getManager();
           
           /* Ici je récupère les informations du formulaire dans un tableau */
            $data = $form->getData();
            \Doctrine\Common\Util\Debug::dump($data);
            
            /*
             *  Init l'obj des carac de com 
             */
            $caracDeCom = new CaracteristiqueCom();
            
            $caracDeCom->setPrixAchat($data['prixAchat']);
            $caracDeCom->setLibelleModele($data['modele']);
            $caracDeCom->setDateAchat($data['dateAchat']);
            $caracDeCom->setNumImmo($data['immobilisation']);
            $caracDeCom->setNumFabricant($data['fabricant']);
            $caracDeCom->setNumRevendeur($data['revendeur']);
            $caracDeCom->setNumFacture($data['numFacture']);
                    
            $em->persist($caracDeCom);
            $em->flush();
            
            /*
             * <!>
             */
            /* Prévoir bouclage sur le nombre de log ajouter */
            $caracDeLog = new CaracteristiqueLog();
            
            $caracDeLog->setLicence($_POST['log0-1-2']);
            $caracDeLog->setNomEditeur($_POST['log0-1-1']);
            $caracDeLog->setNomLog($_POST['log0-1-0']);
            $caracDeLog->setVersionLog($_POST['log0-1-3']);
            
            $em->persist($caracDeLog);
            $em->flush();
            
            /*
             * Init l'obj des carac de res
             */
            $caracDeRes = new CaracteristiqueRes();
            
            $caracDeRes->setAdressIp($data['adIp']);
            $caracDeRes->setAdressMac($data['adMac']);
            $caracDeRes->setAdressPasserelle($data['adPasserelle']);
            
            $em->persist($caracDeRes);
            $em->flush();
            
            /*
             * Init l'obj carac
             */
            $carac = new Caracteristique();
            
            $carac->setNumCaracCom($caracDeCom);
            $carac->setNumCaracLog($caracDeLog);
            $carac->setNumCaracRes($caracDeRes);
            
            $em->persist($carac);
            $em->flush();

            /* Je créer mon objet à persister dans la base */
            
            $materiel = new Materiel();
            
            $materiel->setNomMat($data['nomMat']);
            $materiel->setDateGarantie($data['dateGarantie']);
            $materiel->setNumEtat($data['etatMat']);
            $materiel->setNumSite($data['siteGeo']);
            $materiel->setNumType($data['typeMat']);
            $materiel->setNumStatut($data['statutMat']);
            $materiel->setNumCarac($carac);

            $date = new \DateTime('now');
           
            $materiel->setDateLastModif($date);
            
           
            
            /*
             * User
             * Prévoir bouclage sur le nombre d'user ajouter
             */
            $user = new Utilisateur();
           
            $user->setNomUser($_POST['user0']);
           
            $user->addMateriel($materiel);
           // $materiel->addUtilisateur($user);
            
           
            
    
             /* je dis que je persist l'objet et que j'upload direct en clair */
            $em->persist($materiel);
            $em->flush();
            
            /*
             * Hist
             * Prévoir bouclage sur le nombre d'historique ajouter
             */
            $hist = new Historique();
            
            $hist->setMateriel($materiel);
            $hist->setObjetIntervention($_POST['maintenance0-1-1']);
            $hist->setCoutIntervention($_POST['maintenance0-1-4']);
            $hist->setDateIntervention(new \DateTime($_POST['maintenance0-1-0']));
            $hist->setDescIntervention($_POST['maintenance0-1-2']);
            $hist->setPrestataireIntervention($_POST['maintenance0-1-3']);

            $em->persist($hist);
            $em->flush();
            
           
            /* ca çà permet de retourner une réponse basique */
            return new Response('<h1>Materiel ajouté !</h1>\n résultat : ');
        }

   
        return $this->render('ParcInfoBundle:Default:AjouterMateriel/ajouterMateriel.html.twig', array('form' => $form->createView()));
    }  
    
    public function matHSAction()
    {
       
       $em = $this->getDoctrine()->getManager();
       
       $materiels = $em->getRepository('ParcInfoBundle:Materiel')   
                       ->getMaterielsHS();
       $type = $em->getRepository('ParcInfoBundle:Type')->findAll();
       return $this->render('ParcInfoBundle:Default:PopUp/affichePopUp.html.twig',
               array('materielHs' => $materiels,'type'=>$type));
    }
    public function matPGAction()
    {
       
       $em = $this->getDoctrine()->getManager();
       
       $materiels = $em->getRepository('ParcInfoBundle:Materiel')   
                       ->getMaterielsPG();
       $type = $em->getRepository('ParcInfoBundle:Type')->findAll();
       return $this->render('ParcInfoBundle:Default:PopUp/affichePopUpPG.html.twig',
               array('materielPG' => $materiels,'type'=>$type));
    }
    
        public function matEnPanneAction()
    {
        $em = $this->getDoctrine()->getManager();
        $materiels = $em->getRepository('ParcInfoBundle:Materiel')   
                       ->getMaterielEnPanne();
        $type = $em->getRepository('ParcInfoBundle:Type')->findAll();
       return $this->render('ParcInfoBundle:Default:PopUp/affichePopUpEnPanne.html.twig',
               array('materielEnPanne' => $materiels,'type'=>$type));
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
        $type = $em->getRepository('ParcInfoBundle:Type')->findAll();
        return $this->render('ParcInfoBundle:Default:Etat/affichageMaterielByEtat.html.twig', 
                                array('materiels' => $mats,'etat'=>$etat,'type'=>$type));
    }
    
    public function ficheAction($idmat)
    {
        $em = $this->getDoctrine()->getManager();
        $materiel = $em->getRepository('ParcInfoBundle:Materiel')->findOneBy(array('id'=>$idmat));
        return $this->render('ParcInfoBundle:Default:Materiel/ficheMateriel.html.twig',array("materiel"=>  $materiel));
    }
    
    public function modifierAction($idmat,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $materiel = $em->getRepository('ParcInfoBundle:Materiel')->findOneBy(array('id'=>$idmat));
        
         $form = $this->createFormBuilder()
            ->setMethod('POST')
            ->setAction($this->generateUrl('parc_info_ajouter'))
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
        
        if($form->handleRequest($request)->isSubmitted())
        {
            
            $requete=$this->get('request');
            if($requete->getMethod() == 'POST'){
                $user=$_POST['user0'];
                var_dump($user);
            }
           
           /* Ici je récupère les informations du formulaire dans un tableau */
            $data = $form->getData();
            \Doctrine\Common\Util\Debug::dump($data);
            
            /* Je créer mon objet à persister dans la base */
            /*
             $materiel = new Materiel();
             
            
            $materiel->setNomMat($data['nomMat']);
            $materiel->setDateGarantie($data['dateGarantie']);
            $materiel->setNumEtat($data['etatMat']);
            $materiel->setNumSite($data['siteGeo']);
            $materiel->setNumType($data['typeMat']);
            $materiel->setNumStatut($data['statutMat']);
            $date = new \DateTime();
            $materiel->setDateLastModif($date);
            */
            /* j'ouvre la connexion à la BD Doctrine */
            /*
            $em = $this->getDoctrine()->getManager();
            */
            /* je dis que je persist l'objet et que j'upload direct en clair */
            /*
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
            */
            
            
            /* ca çà permet de retourner une réponse basique */
            return new Response('<h1>Materiel ajouté !</h1>\n résultat : ');
        }

        return $this->render('ParcInfoBundle:Default:Materiel/modifierMateriel.html.twig',array("materiel"=>  $materiel,'form' => $form->createView()));
    }
}
