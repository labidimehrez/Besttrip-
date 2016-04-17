<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SignalisationController
 *
 * @author marwen
 */

namespace BestTripAdmin\AdministrateurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SignalisationController extends Controller {

    public function ConsulterSignalisationItineraireAction() {

        $em = $this->getDoctrine()->getManager();
        $Signalisation = $em->getRepository('AdministrateurBundle:Signalisation')->findSignalisationItineraire();
        foreach ($Signalisation as $s) {
            $id = $s->getIdItineraire()->getIdItineraire();
            $res = $em->getRepository('AdministrateurBundle:Signalisation')->findNombreSignalisationItineraire($id);
            $s->setNbreSignalisation($res);
        }
        $view = 'AdministrateurBundle:Signalisation:ConsulterSignalisationItineraireView.html.twig';
        return $this->render($view, array('signalisations' => $Signalisation));
    }

    public function IgnorerAction($id) {
        $em = $this->getDoctrine()->getManager();
        $l = $em->getRepository('AdministrateurBundle:Signalisation')->DeleteSignalisationItineraire($id);
        return $this->redirect($this->generateUrl('administrateur_consulter_Signalisation_Itineraire'));
    }

    public function SupprimerSignalisationItineraireAction($idi) {
        $em = $this->getDoctrine()->getManager();
        $r = $em->getRepository('AdministrateurBundle:Signalisation')->DeleteSignalisationANDItineraire($idi);
        $b = $em->getRepository('AdministrateurBundle:Signalisation')->DeleteSignalisationItineraire($idi);
        return $this->redirect($this->generateUrl('administrateur_consulter_Signalisation_Itineraire'));
    }

    
    public function ConsulterSignalisationRecommandationAction() {

        $em = $this->getDoctrine()->getManager();
        $Signalisation = $em->getRepository('AdministrateurBundle:Signalisation')->findSignalisationRecommandation();
        foreach ($Signalisation as $s) {
            $id = $s->getIdRecommandation()->getIdRecommandation();
            $res = $em->getRepository('AdministrateurBundle:Signalisation')->findNombreSignalisationRecommandation($id);
            $s->setNbreSignalisation($res);
        }
        $view = 'AdministrateurBundle:Signalisation:ConsulterSignalisationRecommmandationView.html.twig';
        return $this->render($view, array('signalisations' => $Signalisation));
    }
    
    public function IgnorerRAction($id) {
        $em = $this->getDoctrine()->getManager();
        $l = $em->getRepository('AdministrateurBundle:Signalisation')->DeleteSignalisationRecommandation($id);
        return $this->redirect($this->generateUrl('administrateur_consulter_Signalisation_Recommandation'));
    }
    
    
    
     public function SupprimerSignalisationRecommandationAction($idi) {
        $em = $this->getDoctrine()->getManager();
        $r = $em->getRepository('AdministrateurBundle:Signalisation')->DeleteSignalisationANDRecommandation($idi);
        $b = $em->getRepository('AdministrateurBundle:Signalisation')->DeleteSignalisationRecommandation($idi);
        return $this->redirect($this->generateUrl('administrateur_consulter_Signalisation_Recommandation'));
    }
    
    
    
    public function ConsulterSignalisationOffreAction() {

        $em = $this->getDoctrine()->getManager();
        $Signalisation = $em->getRepository('AdministrateurBundle:Signalisation')->findSignalisationOffre();
        foreach ($Signalisation as $s) {
            $id = $s->getIdOffrep()->getIdOffrep();
            $res = $em->getRepository('AdministrateurBundle:Signalisation')->findNombreSignalisationOffre($id);
            $s->setNbreSignalisation($res);
        }
        $view = 'AdministrateurBundle:Signalisation:ConsulterSignalisationOffreView.html.twig';
        return $this->render($view, array('signalisations' => $Signalisation));
    }
    
    
     public function IgnorerOAction($id) {
        $em = $this->getDoctrine()->getManager();
        $l = $em->getRepository('AdministrateurBundle:Signalisation')->DeleteSignalisationOffre($id);
        return $this->redirect($this->generateUrl('administrateur_consulter_Signalisation_Offre'));
    }
    
    
    
    public function SupprimerSignalisationOffreAction($idi) {
        $em = $this->getDoctrine()->getManager();
        $r = $em->getRepository('AdministrateurBundle:Signalisation')->DeleteSignalisationANDOffre($idi);
        $b = $em->getRepository('AdministrateurBundle:Signalisation')->DeleteSignalisationOffre($idi);
        return $this->redirect($this->generateUrl('administrateur_consulter_Signalisation_Offre'));
    }
    
    public function videoAction(){
        return $this->render('AdministrateurBundle:Signalisation:video.html.twig');
    }
   
    
    
    
    
    

}
