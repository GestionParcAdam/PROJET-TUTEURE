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
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Process\Process;
use Symfony\Component\HttpFoundation\Response;

class AjaxController extends Controller
{
     public function defaultAction(Request $request, $data, $id, $type)
    {
        if($request->isXmlHttpRequest())
        {
            if($type == 'user')
            {
                $em = $this->getDoctrine()->getManager();
                $repository = $em->getRepository('ParcInfoBundle:Utilisateur');
                $repository2 = $em->getRepository('ParcInfoBundle:Materiel');

                $data = str_replace(' ','', $data);
                $user = $repository->findOneBy(array('nomUser' => $data));
                \Doctrine\Common\Util\Debug::dump($user);

                $id = str_replace(' ','', $id);
                $materiel = $repository2->find($id);
                
                $materiel->removeUtilisateur($user);
                $em->flush();    
                
                return new Response("ok");
                //$response = array("code" => 100, "success" => true);
                //you can return result as JSON
                //return new Response(json_encode($response));
  
            }
            
            if($type == 'hist')
            {
                $em = $this->getDoctrine()->getManager();
                $repository = $em->getRepository('ParcInfoBundle:Historique');
                $repository2 = $em->getRepository('ParcInfoBundle:Materiel');

                //$data = str_replace(' ','', $data);
                $hist = $repository->find($data);
                
                //$id = str_replace(' ','', $id);
                $materiel = $repository2->findOneBy(array('id' => $id));
                
                $materiel->removeHistorique($hist);
                $em->flush();    
                
                return new Response("ok");
                //$response = array("code" => 100, "success" => true);
                //you can return result as JSON
                //return new Response(json_encode($response));
            } 
            
            if($type == 'log')
            {
                $em = $this->getDoctrine()->getManager();
                $repository = $em->getRepository('ParcInfoBundle:CaracteristiqueLog');
                $repository2 = $em->getRepository('ParcInfoBundle:Materiel');

                //$data = str_replace(' ','', $data);
                $carac = $repository->find($data);

                //$id = str_replace(' ','', $id);
                $materiel = $repository2->findOneBy(array('id' => $id));
                
                $materiel->getNumCarac()->removeNumCaracLog($carac);
                $em->flush();    
                
                return new Response("ok");
                //$response = array("code" => 100, "success" => true);
                //you can return result as JSON
                //return new Response(json_encode($response));
  
            }  
        }
    }  
 }
