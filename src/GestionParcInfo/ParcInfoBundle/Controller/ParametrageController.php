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



class ParametrageController extends Controller
{
    
     public function parametrageAction()
    {
         
           
        return $this->render('ParcInfoBundle:Default:Parametrage/parametrage.html.twig');
    }
    
    public function typeAction(Request $request)
    {
        $f=$this->createFormBuilder()
                            ->setAction($this->generateUrl('parc_info_parametrageType'))
                            ->add('ajtype', 'text')
                            ->add('ajouter', 'submit',array('label'=>' '))
                            ->add('types', 'entity',array('class' => 'ParcInfoBundle:Type', 
                                                             'property' => 'libelleType',
                                                              'empty_value' => 'Aucun','expanded'=>false,'multiple'=>true))
                            ->add('supprimer', 'submit',array('label'=>' '))->getForm();
                    return $this->render('ParcInfoBundle:Default:Parametrage/parametrageType.html.twig', array('form' => $f->createView()));
                    
    }
    public function statutAction(Request $request)
    {

        return $this->render('ParcInfoBundle:Default:Parametrage/parametrageStatut.html.twig');
                    
    }
    public function etatAction(Request $request)
    {
       
        return $this->render('ParcInfoBundle:Default:Parametrage/parametrageEtat.html.twig');
                    
    }
    public function userAction(Request $request)
    {
       
        return $this->render('ParcInfoBundle:Default:Parametrage/parametrageUser.html.twig');
                    
    }
    public function sessionAction(Request $request)
    {
       
        return $this->render('ParcInfoBundle:Default:Parametrage/parametrageSession.html.twig');
                    
    }
    public function fabricantAction(Request $request)
    {
       
        return $this->render('ParcInfoBundle:Default:Parametrage/parametrageFabricant.html.twig');
                    
    }
    public function RevendeurAction(Request $request)
    {
       
        return $this->render('ParcInfoBundle:Default:Parametrage/parametrageRevendeur.html.twig');
                    
    }
    public function siteAction(Request $request)
    {
       
        return $this->render('ParcInfoBundle:Default:Parametrage/parametrageSite.html.twig');
                    
    }
 }
