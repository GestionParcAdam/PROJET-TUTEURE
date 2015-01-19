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

class DefaultController extends Controller {

    public function indexAction() {
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


        return $this->render('ParcInfoBundle:Default:index.html.twig', array('materielHs' => $materiels, 'allsite' => $allsite, 'materielPG' => $materielPG, 'materielEnPanne' => $materielEnPanne, 'dernierModif' => $dernierModif));
    }

    public function ajouterAction(Request $request) {
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
                ->add('nbUsers', 'text')
                ->add('selectUser', 'entity', array('class' => 'ParcInfoBundle:Utilisateur',
                    'property' => 'nomUser'))
                ->add('nbLog', 'text')
                ->add('nbMaintenance', 'text')
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
                ->add('ajouter', 'submit')
                ->getForm();

        if ($form->handleRequest($request)->isSubmitted()) {
            if ($form->get('ajouter')->isClicked()) {

                /* j'ouvre la connexion à la BD Doctrine */
                $em = $this->getDoctrine()->getManager();

                $data = $form->getData();

                /* Ici je récupère les informations du formulaire dans un tableau */

                /*
                 * Init l'obj carac
                 */
                $carac = new Caracteristique();

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

                \Doctrine\Common\Util\Debug::dump($caracDeCom);

                $em->persist($caracDeCom);
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

                $carac->setNumCaracCom($caracDeCom);
                $carac->setNumCaracRes($caracDeRes);

                /*
                 * <!>
                 */
                /* Prévoir bouclage sur le nombre de log ajouter */
                for ($i = 0; $i <= $data['nbLog'] + 1; $i++) {
                    $concat = 'log' . $i . '-1';

                    \Doctrine\Common\Util\Debug::dump($concat);
                    if (isset($_POST[$concat])) {
                        $concat2 = 'log' . $i;

                        $caracDeLog = new CaracteristiqueLog();

                        $caracDeLog->setLicence($_POST[$concat2 . '-3']);
                        $caracDeLog->setNomEditeur($_POST[$concat2 . '-2']);
                        $caracDeLog->setNomLog($_POST[$concat2 . '-1']);
                        $caracDeLog->setVersionLog($_POST[$concat2 . '-4']);

                        $caracDeLog->setCarac($carac);
                        $carac->addNumCaracLog($caracDeLog);

                        \Doctrine\Common\Util\Debug::dump($caracDeLog);

                        $em->persist($caracDeLog);
                        $em->flush();
                    }
                }

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



                $em->persist($carac);
                $em->flush();

                /*
                 * User
                 * Prévoir bouclage sur le nombre d'user ajouter
                 */
                for ($i = 1; $i <= $data['nbUsers'] + 1; $i++) {
                    $concat = 'user' . $i;
                    \Doctrine\Common\Util\Debug::dump($concat);
                    if (isset($_POST[$concat])) {
                        \Doctrine\Common\Util\Debug::dump($_POST[$concat]);
                        $user = new Utilisateur();

                        $user->setNomUser($_POST[$concat]);
                        $user->addMateriel($materiel);
                    }
                }

                /* je dis que je persist l'objet et que j'upload direct en clair */
                $em->persist($materiel);
                $em->flush();

                /*
                 * Hist
                 * Prévoir bouclage sur le nombre d'historique ajouter
                 */
                for ($i = 1; $i <= $data['nbMaintenance']; $i++) {

                    $hist = new Historique();

                    $hist->setMateriel($materiel);
                    $hist->setObjetIntervention($_POST['maintenance' . $i . '-2']);
                    $hist->setCoutIntervention($_POST['maintenance' . $i . '-5']);
                    $hist->setDateIntervention(new \DateTime($_POST['maintenance' . $i . '-1']));
                    $hist->setDescIntervention($_POST['maintenance' . $i . '-3']);
                    $hist->setPrestataireIntervention($_POST['maintenance' . $i . '-4']);

                    $materiel->addHistorique($hist);
                    $hist->setMateriel($materiel);

                    $em->persist($hist);
                    $em->flush();
                }

                /* ca çà permet de retourner une réponse basique */
                return new Response('<h1>Materiel ajouté !</h1>\n résultat : ');
            }
        }

        return $this->render('ParcInfoBundle:Default:AjouterMateriel/ajouterMateriel.html.twig', array('form' => $form->createView()));
    }

    public function matHSAction() {

        $em = $this->getDoctrine()->getManager();

        $materiels = $em->getRepository('ParcInfoBundle:Materiel')
                ->getMaterielsHS();
        $type = $em->getRepository('ParcInfoBundle:Type')->findAll();
        return $this->render('ParcInfoBundle:Default:PopUp/affichePopUp.html.twig', array('materielHs' => $materiels, 'type' => $type));
    }

    public function matPGAction() {

        $em = $this->getDoctrine()->getManager();

        $materiels = $em->getRepository('ParcInfoBundle:Materiel')
                ->getMaterielsPG();
        $type = $em->getRepository('ParcInfoBundle:Type')->findAll();
        return $this->render('ParcInfoBundle:Default:PopUp/affichePopUpPG.html.twig', array('materielPG' => $materiels, 'type' => $type));
    }

    public function imprimAction() {

        $em = $this->getDoctrine()->getManager();

        $materiels = $em->getRepository('ParcInfoBundle:Materiel')
                ->getMaterielsPG();
        $type = $em->getRepository('ParcInfoBundle:Type')->findAll();

        $html = $this->renderView('ParcInfoBundle:Default:PopUp/affichePopUpPG.html.twig', array('materielPG' => $materiels, 'type' => $type));
        $this->get('knp_snappy.pdf')->generateFromHtml($html, 'c:/wamp/www/file.pdf');
    }

    public function matEnPanneAction() {
        $em = $this->getDoctrine()->getManager();
        $materiels = $em->getRepository('ParcInfoBundle:Materiel')
                ->getMaterielEnPanne();
        $type = $em->getRepository('ParcInfoBundle:Type')->findAll();
        return $this->render('ParcInfoBundle:Default:PopUp/affichePopUpEnPanne.html.twig', array('materielEnPanne' => $materiels, 'type' => $type));
    }

    public function editionAction(Request $request) {
        $form = $this->createFormBuilder()
                ->setMethod('POST')
                ->setAction($this->generateUrl('parc_info_edition'))
                ->add('siteGeo', 'entity', array('class' => 'ParcInfoBundle:Site',
                    'property' => 'nomSite',
                    'empty_value' => 'Tous les sites', 'required' => false))
                ->add('etatMat', 'entity', array('class' => 'ParcInfoBundle:Etat',
                    'property' => 'libelleEtat',
                    'empty_value' => 'Tous les états', 'required' => false))
                ->add('btnSiteGeo', 'submit', array('label' => 'Générer la liste des biens informatique du parc'))
                ->add('btnBienFinGar', 'submit', array('label' => 'Générer la liste des biens en fin de garantie'))
                ->add('btnMatEtat', 'submit', array('label' => 'Générer la liste des matériels en fonction de son état'))
                ->add('btnListLog', 'submit', array('label' => 'Générer la liste des logiciels'))
                ->getForm();

        if ($form->handleRequest($request)->isSubmitted()) {
            $form = $_POST['form'];
            if (isset($form['btnSiteGeo'])) {
                $numSite = $form['siteGeo'];
                $em = $this->getDoctrine()->getManager();
                $materiel = $em->getRepository('ParcInfoBundle:Materiel')->findBy(array('numSite' => $numSite));
                if ($numSite == '') {
                    $materiel = $em->getRepository('ParcInfoBundle:Materiel')->findAll();
                }
                $type = $em->getRepository('ParcInfoBundle:Type')->findAll();
                $site = $em->getRepository('ParcInfoBundle:Site')->findAll();

                return $this->render('ParcInfoBundle:Default:EditionRapport/listeBienInformatique.html.twig', array("materiels" => $materiel, 'type' => $type, 'site' => $site));
            }

            if (isset($form['btnBienFinGar'])) {

                $em = $this->getDoctrine()->getManager();
                $materiels = $em->getRepository('ParcInfoBundle:Materiel')
                        ->getMaterielFinGarantie();
                $type = $em->getRepository('ParcInfoBundle:Type')->findAll();
                return $this->render('ParcInfoBundle:Default:EditionRapport/listeBienFinGarantie.html.twig', array('materiels' => $materiels, 'type' => $type));
            }
            if (isset($form['btnMatEtat'])) {
                $idEtat = $form['etatMat'];
                $em = $this->getDoctrine()->getManager();
                $materiel = $em->getRepository('ParcInfoBundle:Materiel')->findBy(array('numEtat' => $idEtat));
                if ($idEtat == '') {
                    $materiel = $em->getRepository('ParcInfoBundle:Materiel')->findAll();
                }
                $type = $em->getRepository('ParcInfoBundle:Type')->findAll();
                $etat = $em->getRepository('ParcInfoBundle:Etat')->findAll();
                return $this->render('ParcInfoBundle:Default:EditionRapport/listeBienEtat.html.twig', array("materiels" => $materiel, 'type' => $type, 'etat' => $etat));
            }
            if (isset($form['btnListLog'])) {

                $em = $this->getDoctrine()->getManager();
                $logiciel = $em->getRepository('ParcInfoBundle:CaracteristiqueLog')->findAll();

                return $this->render('ParcInfoBundle:Default:EditionRapport/listeLogiciel.html.twig', array("logiciel" => $logiciel));
            }
            return new Response('<h1>Erreur !</h1><br> Commande Introuvable!! ');
        }
        return $this->render('ParcInfoBundle:Default:EditionRapport/EditionRapport.html.twig', array('form' => $form->createView()));
    }

    public function etatAction($numSite, $idEtat) {
        $em = $this->getDoctrine()->getManager();

        $mats = $em->getRepository('ParcInfoBundle:Materiel')
                ->findBy(array('numSite' => $numSite, 'numEtat' => $idEtat));
        $etat = $em->getRepository('ParcInfoBundle:Etat')->find($idEtat)->getLibelleEtat();
        $type = $em->getRepository('ParcInfoBundle:Type')->findAll();
        return $this->render('ParcInfoBundle:Default:Etat/affichageMaterielByEtat.html.twig', array('materiels' => $mats, 'etat' => $etat, 'type' => $type));
    }

    public function ficheAction($idmat) {
        $em = $this->getDoctrine()->getManager();

        $materiel = $em->getRepository('ParcInfoBundle:Materiel')->findOneBy(array('id' => $idmat));

        return $this->render('ParcInfoBundle:Default:Materiel/ficheMateriel.html.twig', array("materiel" => $materiel));
    }

    public function modifierAction($idmat, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $materiel = $em->getRepository('ParcInfoBundle:Materiel')->findOneBy(array('id' => $idmat));

        $form = $this->createFormBuilder()
                ->setMethod('POST')
                ->setAction($this->generateUrl('parc_info_ajouter'))
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
                ->add('ajouter', 'submit')
                ->getForm();

        if ($form->handleRequest($request)->isSubmitted()) {

            $requete = $this->get('request');
            if ($requete->getMethod() == 'POST') {
                $user = $_POST['user0'];
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

        return $this->render('ParcInfoBundle:Default:Materiel/modifierMateriel.html.twig', array("materiel" => $materiel, 'form' => $form->createView()));
    }

    /*
      public function listeBienFinGarantieAction()
      {
      $em = $this->getDoctrine()->getManager();
      $materiels = $em->getRepository('ParcInfoBundle:Materiel')
      ->getMaterielFinGarantie($numSite,$idEtat);
      $type = $em->getRepository('ParcInfoBundle:Type')->findAll();
      return $this->render('ParcInfoBundle:Default:EditionRapport/listeBienFinGarantie.html.twig',
      array('materiels' => $materiels,'type'=>$type));
      }
      public function listeBienEtatAction(){
      $em = $this->getDoctrine()->getManager();
      $materiel = $em->getRepository('ParcInfoBundle:Materiel')->findBy(array('numSite'=>$numSite,'numEtat'=>$idEtat));
      if($numSite==0){
      $materiel = $em->getRepository('ParcInfoBundle:Materiel')->findAll();
      }
      $type = $em->getRepository('ParcInfoBundle:Type')->findAll();
      return $this->render('ParcInfoBundle:Default:EditionRapport/listeBienEtat.html.twig',array("materiels"=>  $materiel,'type'=>$type));
      }

      public function listeLogicielAction(){
      $em = $this->getDoctrine()->getManager();
      $logiciel = $em->getRepository('ParcInfoBundle:CaracteristiqueLog')->findAll();

      return $this->render('ParcInfoBundle:Default:EditionRapport/listeLogiciel.html.twig',array("logiciel"=>  $logiciel));
      } */
}
