<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ParticipationController
 *
 * @author marwen
 */

namespace BestTripClient\ClientBundle\Controller;

use \Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \BestTripClient\ClientBundle\Entity\Participation;

class ParticipationController extends Controller {

    //put your code here

    public function ParticipationOffreAction($ido) {

        $p = new Participation();
        $em = $this->getDoctrine()->getManager();



        $da = new \DateTime('now');
        $user = $this->getUser();
        //$user = $em->getRepository('ClientBundle:Utilisateur')->find(7);

        $offre = $em->getRepository('ClientBundle:OffreProfessionnelle')->find($ido);
      
        $p->setDateParticipation($da);
        $p->setIdUtilisateur($user);
        $p->setIdOffrep($offre);
        $em->persist($p);
        $em->flush();
       


        $json = array("success");
        $response = new JsonResponse();
        return $response->setData($json);
    }

    public function ParticipationparrainageAction($idp) {

        $p = new Participation();
        $em = $this->getDoctrine()->getManager();
        $da = new \DateTime('now');
        $user = $this->getUser();

        //$user = $em->getRepository('ClientBundle:Utilisateur')->find(9);

        $parr = $em->getRepository('ClientBundle:Parrainage')->find($idp);
        
            $p->setDateParticipation($da);
            $p->setIdUtilisateur($user);
            $p->setIdParrainage($parr);
            $em->persist($p);
            $em->flush();
        
        $json = array("success");
        $response = new JsonResponse();
        return $response->setData($json);
    }

    public function AnnulerParticipationOffreAction($ido) {

        $p = new Participation();
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $user = $this->getUser();
        //$user = $em->getRepository('ClientBundle:Utilisateur')->find(9);
        $offre = $em->getRepository('ClientBundle:OffreProfessionnelle')->find($ido);

        $pp = $em->getRepository('ClientBundle:Participation')->findBy(array('idOffrep' => $offre, 'idUtilisateur' => $user));

        foreach ($pp as $p) {
            $em->remove($p);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('client_Compte'));
    }

    public function AnnulerParticipationParrainageAction($idp) {

        $p = new Participation();
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $user = $this->getUser();
//$user = $em->getRepository('ClientBundle:Utilisateur')->find(9);
        $parr = $em->getRepository('ClientBundle:Parrainage')->find($idp);
        $pp = $em->getRepository('ClientBundle:Participation')->findBy(array('idParrainage' => $parr, 'idUtilisateur' => $user));

        foreach ($pp as $p) {
            $em->remove($p);
            $em->flush();
        }
        return $this->redirect($this->generateUrl('client_Compte'));
    }

    public function consulterparticipationAction() {

        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $usr = $this->getUser();
        $user = $em->getRepository('ClientBundle:Utilisateur')->find($usr->getIdUtilisateur());
        $participations = $em->getRepository('ClientBundle:Participation')->findBy(array('idUtilisateur' => $user));
        $PO = array();
        $PP = array();
        foreach ($participations as $p) {
            if ($p->getIdOffrep() != null) {
                array_push($PO, $p);
            } else {
                array_push($PP, $p);
            }
        }


        $size = sizeof($participations);
        return $this->redirect($this->generateUrl('client_Compte'));
    }

    public function nomayaAction() {
        return $this->render('ClientBundle:Participation:nomaya.html.twig');
    }

}
