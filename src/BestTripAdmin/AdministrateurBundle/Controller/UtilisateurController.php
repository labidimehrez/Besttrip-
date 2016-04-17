<?php

namespace BestTripAdmin\AdministrateurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BestTripAdmin\AdministrateurBundle\Entity\Utilisateur;

class UtilisateurController extends Controller {

    public function ConsulterAction() {
        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository('AdministrateurBundle:Utilisateur')->findByType("Client");
        $gerant = $em->getRepository('AdministrateurBundle:Utilisateur')->findByType("Gerant");
        $view = 'AdministrateurBundle:Utilisateur:Consulter.html.twig';
        return $this->render($view, array('client' => $client,'gerant' => $gerant));
    }

    public function ActiverAction($id) {
        $em = $this->getDoctrine()->getManager();
        $utilisateur = $em->getRepository('AdministrateurBundle:Utilisateur')->find($id);
        $utilisateur->setEtatCompte(1);
        $em->persist($utilisateur);
        $em->flush();
        return $this->redirect($this->generateUrl('administrateur_consulter_Utilisateur'));
    }
    
    public function DesactiverAction($id) {
        $em = $this->getDoctrine()->getManager();
        $utilisateur = $em->getRepository('AdministrateurBundle:Utilisateur')->find($id);
        $utilisateur->setEtatCompte(0);
        $em->persist($utilisateur);
        $em->flush();
        return $this->redirect($this->generateUrl('administrateur_consulter_Utilisateur'));
    }
    
    public function AuthentificationAction() {
        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository('AdministrateurBundle:Utilisateur')->findByType("Client");
        $view = 'AdministrateurBundle:Utilisateur:Consulter.html.twig';
        return $this->render($view, array('client' => $client));
    }

}
