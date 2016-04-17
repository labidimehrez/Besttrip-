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

namespace BestTripClient\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \BestTripClient\ClientBundle\Entity\Signalisation;
use \Symfony\Component\HttpFoundation\JsonResponse;


class SignalisationController extends Controller {

    //put your code here

    public function AjoutSignalisationItneraireAction( $com,$idi) {

        $s = new Signalisation();
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $tp = "Itinéraire";
        $et = "non vu";
        $da = new \DateTime('now');
        $user = $this->getUser();
        //$user=$em->getRepository('ClientBundle:Utilisateur')->find(9);
        $itin = $em->getRepository('ClientBundle:Itineraire')->find($idi);

        $ss = $em->getRepository('ClientBundle:Signalisation')->findBy(array('idItineraire' => $itin, 'idUtilisateur' => $user));

        if ($ss != null) {
            return $this->render('ClientBundle:Signalisation:consulter.html.twig');
        } else {



            $s->setType($tp);
            $s->setCommentaire($com);
            $s->setEtat($et);
            $s->setDateAjout($da);
            $s->setIdUtilisateur($user);
            $s->setIdItineraire($itin);

            $em->persist($s);
            $em->flush();
        }
        $json = array("success");
        $response = new JsonResponse();
        return $response->setData($json);
    }

    public function AjoutSignalisationRecommandationAction() {

        $s = new Signalisation();
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $tp = "Recommandation";
        $et = "non vu";
        $da = new \DateTime('now');
        $user = $em->getRepository('ClientBundle:Utilisateur')->find(9);
        $rec = $em->getRepository('ClientBundle:Recommandation')->find(333);

        $ss = $em->getRepository('ClientBundle:Signalisation')->findBy(array('idRecommandation' => $rec, 'idUtilisateur' => $user));

        if ($ss != null) {
            return $this->render('ClientBundle:Signalisation:consulter.html.twig');
        } else {
            if ($request->getMethod() == 'POST') {
                $com = $request->get('com');

                $s->setType($tp);
                $s->setCommentaire($com);
                $s->setEtat($et);
                $s->setDateAjout($da);
                $s->setIdUtilisateur($user);
                $s->setIdRecommandation($rec);

                $em->persist($s);
                $em->flush();
            }
        }

        return $this->render('ClientBundle:Signalisation:consulter.html.twig');
    }

    public function AjoutSignalisationOffreAction($com,$ido) {

        $s = new Signalisation();
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $tp = "Offre personnelle";
        $et = "non vu";
        $da = new \DateTime('now');
        //$user=$em->getRepository('ClientBundle:Utilisateur')->find(9);
        $user = $this->getUser();
        $offre = $em->getRepository('ClientBundle:OffrePersonnelle')->find($ido);

        $ss = $em->getRepository('ClientBundle:Signalisation')->findBy(array('idOffrep' => $offre, 'idUtilisateur' => $user));

        if ($ss != null) {
            return $this->redirect($this->generateUrl('client_consulterOffre_offrepersonnelle', array('id' => $ido)));
        } else {
            
                
                $s->setType($tp);
                $s->setCommentaire($com);
                $s->setEtat($et);
                $s->setDateAjout($da);
                $s->setIdUtilisateur($user);
                $s->setIdOffrep($offre);

                $em->persist($s);
                $em->flush();
                
            
        }
           $json = array("success");
        $response = new JsonResponse();
        return $response->setData($json);
        
    }

}
