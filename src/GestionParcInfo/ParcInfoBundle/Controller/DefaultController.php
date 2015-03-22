<?php

namespace GestionParcInfo\ParcInfoBundle\Controller;

use GestionParcInfo\ParcInfoBundle\Entity\Materiel;
use GestionParcInfo\ParcInfoBundle\Entity\Historique;
use GestionParcInfo\ParcInfoBundle\Entity\Caracteristique;
use GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueCom;
use GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueRes;
use GestionParcInfo\ParcInfoBundle\Entity\CaracteristiqueLog;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Process\Process;

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
        $userMat = $em->getRepository('ParcInfoBundle:Utilisateur')->findAll();

       
        return $this->render('ParcInfoBundle:Default:index.html.twig', 
                array('materielHs' => $materiels, 
                    'allsite' => $allsite, 'materielPG' => $materielPG, 
                    'materielEnPanne' => $materielEnPanne, 'dernierModif' => $dernierModif,
                    'utilisateur' => $userMat));
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
                    'required' => false,
                    'empty_value' => 'null',
                    'widget' => 'single_text'))
                ->add('prixAchat', 'money',array('required' => false, 'currency' => 'false')/* ,array('currency' => 'false') */)
                ->add('numFacture', 'text', array('required' => false))
                ->add('modele', 'text', array('required' => false,))
                ->add('fabricant', 'entity', array('class' => 'ParcInfoBundle:Fabricant',
                    'required' => false,
                    'property' => 'nomFabricant'))
                ->add('revendeur', 'entity', array('class' => 'ParcInfoBundle:Revendeur',
                    'required' => false,
                    'property' => 'nomRevendeur'))
                ->add('immobilisation', 'text',array('required' => false))
                ->add('nbUsers', 'hidden',array('required' => false))
                ->add('selectUser', 'entity', array('class' => 'ParcInfoBundle:Utilisateur',
                    'required' => false,
                    'property' => 'nomUser'))
                ->add('nbLog', 'hidden',array('required' => false))
                ->add('nbMaintenance', 'hidden',array('required' => false))
                ->add('nomUser', 'text',array('required' => false))
                ->add('editeur', 'text',array('required' => false))
                ->add('nomLog', 'text',array('required' => false))
                ->add('licence', 'text',array('required' => false))
                ->add('dateInterv', 'date', array('input' => 'datetime',
                    'required' => false,
                    'widget' => 'single_text'))
                ->add('objInterv', 'text',array('required' => false))
                ->add('descInterv', 'textarea',array('required' => false))
                ->add('prestaInterv', 'text',array('required' => false))
                ->add('coutInterv', 'text',array('required' => false))
                ->add('versionLogiciel', 'text',array('required' => false))
                ->add('adMac', 'text',array('required' => false))
                ->add('adIp', 'text',array('required' => false))
                ->add('adPasserelle', 'text',array('required' => false))
                ->add('dateGarantie', 'date', array('input' => 'datetime',
                    'required' => false,
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
                
                if($data['dateAchat']==null)
                {
                    $caracDeCom->setDateAchat(null);
                }
                else
                {
                    $caracDeCom->setDateAchat($data['dateAchat']);
                }
                $caracDeCom->setNumImmo($data['immobilisation']);
                $caracDeCom->setNumFabricant($data['fabricant']);
                $caracDeCom->setNumRevendeur($data['revendeur']);
                $caracDeCom->setNumFacture($data['numFacture']);               

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

                    
                    if (isset($_POST[$concat])) {
                        $concat2 = 'log' . $i;

                        $caracDeLog = new CaracteristiqueLog();

                        $caracDeLog->setLicence($_POST[$concat2 . '-3']);
                        $caracDeLog->setNomEditeur($_POST[$concat2 . '-2']);
                        $caracDeLog->setNomLog($_POST[$concat2 . '-1']);
                        $caracDeLog->setVersionLog($_POST[$concat2 . '-4']);

                        $caracDeLog->setCarac($carac);
                        $carac->addNumCaracLog($caracDeLog);

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
                    $concat = 'selectUser' . $i;
                    
                    if (isset($_POST[$concat])) {
                        
                        $user = $em->getRepository('ParcInfoBundle:Utilisateur')->find($_POST[$concat]);

                      // $user->setNomUser($_POST[$concat]);
                        $user->addMateriel($materiel);
                    }
                }

                /* je dis que je persist l'objet et que j'upload direct en clair */
                $em->persist($materiel);
                $em->flush();

                /*
                 * Hist
                 *  bouclage sur le nombre d'historique ajouter
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

                return $this->redirect($this->generateUrl('parc_info_homepage'));
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
                $em = $this->getDoctrine()->getManager();
                $numSite = $form['siteGeo'];
                $userMat = $em->getRepository('ParcInfoBundle:Utilisateur')->findAll();
                
                $materiel = $em->getRepository('ParcInfoBundle:Materiel')->findBy(array('numSite' => $numSite));
                if ($numSite == ''){
                    $materiel = $em->getRepository('ParcInfoBundle:Materiel')->findAll();
                }
                $type = $em->getRepository('ParcInfoBundle:Type')->findAll();
                $site = $em->getRepository('ParcInfoBundle:Site')->findAll();
                $html=$this->renderView('ParcInfoBundle:Default:EditionRapport/listeBienInformatique.html.twig', 
                                    array("materiels" => $materiel, 'type' => $type, 'site' => $site,'utilisateur'=>$userMat));
                
                $html2pdf = new \Obtao\Bundle\Html2PdfBundle\lib\HTML2PDF('P','A4','fr');
                $html2pdf->pdf->SetDisplayMode('fullpage');
                $html2pdf->writeHTML($html);
                
                if($numSite==''){
                    $v = "Liste_Bien_Tous_Sites.pdf";
                }else{
                    $ville=$em->getRepository('ParcInfoBundle:Site')->findOneBy(array('id'=>$numSite))->getNomSite();
                    $v = "Liste_Bien_$ville.pdf";
                }
                
                //Output envoit le document PDF au navigateur internet avec un nom spécifique qui aura un rapport avec le contenu à convertir (exemple : Facture, Règlement…)
                $html2pdf->Output($v,'D');
                return new Response('ok');
            }
            if (isset($form['btnBienFinGar'])) {
                $em = $this->getDoctrine()->getManager();
                $materiels = $em->getRepository('ParcInfoBundle:Materiel')
                        ->getMaterielFinGarantie();
                $type = $em->getRepository('ParcInfoBundle:Type')->findAll();
                
                $html = $this->renderView('ParcInfoBundle:Default:EditionRapport/listeBienFinGarantie.html.twig', array('materiels' => $materiels, 'type' => $type));
                $html2pdf = new \Html2Pdf_Html2Pdf('P','A4','fr');
                $html2pdf->pdf->SetDisplayMode('fullpage');
                $html2pdf->writeHTML($html);
                $v = "Liste_Bien_Fin_Garantie.pdf";
                $html2pdf->Output($v,'D');
                return new Response('ok');
                
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
                
                $html=$this->renderView('ParcInfoBundle:Default:EditionRapport/listeBienEtat.html.twig', array("materiels" => $materiel, 'type' => $type, 'etat' => $etat));
            
                $html2pdf = new \Html2Pdf_Html2Pdf('P','A4','fr');
                $html2pdf->pdf->SetDisplayMode('fullpage');
                $html2pdf->writeHTML($html);
                if($idEtat==''){
                    $e = "Liste_Bien_Tous_Etat.pdf";
                }else{
                    $etat=$em->getRepository('ParcInfoBundle:Etat')->findOneBy(array('id'=>$idEtat))->getLibelleEtat();
                    $e = "Liste_Bien_$etat.pdf";
                }
                $html2pdf->Output($e,'D');
                return new Response('ok');
            }
            if (isset($form['btnListLog'])) {
                $em = $this->getDoctrine()->getManager();
                
                $logiciel = $em->getRepository('ParcInfoBundle:CaracteristiqueLog')->findAll();
                $html= $this->renderView('ParcInfoBundle:Default:EditionRapport/listeLogiciel.html.twig', array("logiciel" => $logiciel));
                
                $html2pdf = new \Html2Pdf_Html2Pdf('P','A4','fr');
                $html2pdf->pdf->SetDisplayMode('fullpage');
                $html2pdf->writeHTML($html);
                $l= "Liste_Logiciels.pdf";
                $html2pdf->Output($l,'D');
                return new Response('ok');
            }
            return new Response('<h1>Erreur !</h1><br> Commande Introuvable!! ');
        }
        return $this->render('ParcInfoBundle:Default:EditionRapport/EditionRapport.html.twig', array('form' => $form->createView()));
    }    
    
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
        if ($form1->get('ping')->isClicked()) {
            // -c pour linux et -w pour windows
            $process = new Process('ping -w 1 '.$materiel->getNomMat());
            $process->run();

            if($process->isSuccessful()){
                $couleur='green';
            }else{
                $adr=$em->getRepository('ParcInfoBundle:Caracteristique')
                        ->findOneBy(array('id'=>$materiel->getNumCarac()))->getNumCaracRes();
                $adr = $em->getRepository('ParcInfoBundle:CaracteristiqueRes')->findOneBy(array('id'=>$adr))->getAdressIp();
                // -c pour linux et -w pour windows
                $process = new Process('ping -w 1 '.$adr);
                $process->run();
                if($process->isSuccessful()){
                    $couleur='green';
                }else{
                    $couleur='red';
                }
               
            }
        }

        return $this->render('ParcInfoBundle:Default:Materiel/ficheMateriel.html.twig', array("materiel" => $materiel,'form' => $form->createView(),'form1' => $form1->createView(),'couleur'=>$couleur));
    }

    public function etatAction($numSite, $idEtat) {
        $em = $this->getDoctrine()->getManager();

        $mats = $em->getRepository('ParcInfoBundle:Materiel')
                ->findBy(array('numSite' => $numSite, 'numEtat' => $idEtat));
        $etat = $em->getRepository('ParcInfoBundle:Etat')->find($idEtat)->getLibelleEtat();
        $type = $em->getRepository('ParcInfoBundle:Type')->findAll();
        return $this->render('ParcInfoBundle:Default:Etat/affichageMaterielByEtat.html.twig', array('materiels' => $mats, 'etat' => $etat, 'type' => $type));
    }

    
    public function deleteMatAction($idMat) {
        $em = $this->getDoctrine()->getManager();

        $mat = $em->getRepository('ParcInfoBundle:Materiel')->find($idMat);
        
        $em->remove($mat);
        $em->flush();
        
        return $this->redirect($this->generateUrl('parc_info_homepage'));
    }
}
