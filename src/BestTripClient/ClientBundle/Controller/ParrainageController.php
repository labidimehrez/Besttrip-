<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ParrainageController
 *
 * @author wissal
 */

namespace BestTripClient\ClientBundle\Controller;

use BestTripClient\ClientBundle\Entity\Parrainage;
use BestTripClient\ClientBundle\Form\ParrainageForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ParrainageController extends Controller {

    public function ConsulterMESAction() {
        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $user = $this->getUser();
            $em = $this->getDoctrine()->getManager();
            $parrainages = $em->getRepository('ClientBundle:Parrainage')->findByIdUtilisateur($user);
            $view = 'ClientBundle:Parrainage:ConsulterView.html.twig';
            return $this->render($view, array('parrainages' => $parrainages));
        }
        return $this->redirect($this->generateUrl('login_user'));
    }

    public function ConsulterAllAction() {
            $em = $this->getDoctrine()->getManager();
            $parrainages = $em->getRepository('ClientBundle:Parrainage')->findAll();
            $view = 'ClientBundle:Parrainage:ConsulterAllView.html.twig';
            return $this->render($view, array('parrainages' => $parrainages));
    }

    public function ConsulterParItineraireAction($id) {
        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $em = $this->getDoctrine()->getManager();
            $parrainages = $em->getRepository('ClientBundle:Parrainage')->findByIdItineraire($id);
            $view = 'ClientBundle:Parrainage:ConsulterAllView.html.twig';
            return $this->render($view, array('parrainages' => $parrainages));
        }
        return $this->redirect($this->generateUrl('login_user'));
    }

    public function ConsulterMonAction($id) {
        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $em = $this->getDoctrine()->getManager();
            $parrainage = $em->getRepository('ClientBundle:Parrainage')->find($id);
            $iti = $parrainage->getIdItineraire();
            $images = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Media')->findBy(array('idItineraire' => $iti, 'type' => 'image'));
            $video = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Media')->findBy(array('idItineraire' => $iti, 'type' => 'video'));
            $view = 'ClientBundle:Parrainage:ConsulterMonView.html.twig';
            return $this->render($view, array('parrainage' => $parrainage, 'itineraire' => $iti, 'images' => $images, 'video' => $video));
        }
        return $this->redirect($this->generateUrl('login_user'));
    }

    public function ConsulterUnAction($id) {
            $em = $this->getDoctrine()->getManager();
            $parrainage = $em->getRepository('ClientBundle:Parrainage')->find($id);
            $iti = $parrainage->getIdItineraire();
            $images = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Media')->findBy(array('idItineraire' => $iti, 'type' => 'image'));
            $video = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Media')->findBy(array('idItineraire' => $iti, 'type' => 'video'));
            $user = $this->getUser();
            $pp = $em->getRepository('ClientBundle:Participation')->findBy(array('idParrainage' => $parrainage, 'idUtilisateur' => $user));
        $par = $em->getRepository('ClientBundle:Participation')->findBy(array('idParrainage' => $parrainage));
        $counter=0;
        foreach ($par as $pa) {
            $counter = $counter + 1;
        }
           $nbr=0;
           $nbr = $parrainage->getNbmax() - $counter ;
        
        
            $view = 'ClientBundle:Parrainage:ConsulterUnView.html.twig';
            return $this->render($view, array('parrainage' => $parrainage, 'itineraire' => $iti, 'images' => $images, 'video' => $video,'participations'=>$pp,'counter'=>$counter,'nbre'=>$nbr));
       
    }

    public function AnnulerAction($id) {
        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $em = $this->getDoctrine()->getManager();
            $offre = $em->getRepository('ClientBundle:Parrainage')->find($id);
            $em->remove($offre);
            $em->flush();
            return $this->redirect($this->generateUrl('gerant_parrainage_Consulter'));
        }
        return $this->redirect($this->generateUrl('login_user'));
    }

    public function AjouterAction($id) {
        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $par = new Parrainage();
            $form = $this->createForm(new ParrainageForm(), $par);
            $compa = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Compagnie')->findAll();
            $request = $this->get('request');
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $iti = $em->getRepository('ClientBundle:Itineraire')->find($id);
                $par->setDateAjout(new \DateTime('now'));
                $user = $this->getUser();
                $par->setIdUtilisateur($user);
                $compagnie = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Compagnie')->find($request->get('compagnie'));
                $par->setIdCompagnie($compagnie);
                $par->setIdItineraire($iti);
                $em->persist($par);
                $em->flush();
                return $this->redirect($this->generateUrl('client_consulter_itineraire'));
            }
            return $this->render('ClientBundle:Parrainage:AjouterView.html.twig', array("form" => $form->createView(), "compa" => $compa));
        }
        return $this->redirect($this->generateUrl('login_user'));
    }

    public function ModifierAction($id) {
        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $em = $this->getDoctrine()->getManager();
            $par = $em->getRepository('ClientBundle:Parrainage')->find($id);
            $form = $this->createForm(new ParrainageForm(), $par);
            $compa = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Compagnie')->findAll();
            $compaChoisit = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Compagnie')->find($par->getIdCompagnie());
            if ($this->getRequest()->isMethod('POST')) {
                $form->handleRequest($this->getRequest());
                if ($form->isValid()) {
                    $em->persist($par);
                    $em->flush();
                    return $this->redirect($this->generateUrl('client_consulter_itineraire'));
                }
            }
            return $this->render('ClientBundle:Parrainage:ModifierView.html.twig', array("form" => $form->createView(), "parrainage" => $par, "compa" => $compa, 'compChoisit' => $compaChoisit));
        }
        return $this->redirect($this->generateUrl('login_user'));
    }
}
