<?php

namespace BestTripAdmin\AdministrateurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller {

    public function indexAction() {

        //code goes here that will be run every 5 seconds.    




        return $this->render('AdministrateurBundle:Default:index.html.twig', array());
    }

    public function getSignalisationAction() {
        $em = $this->getDoctrine()->getManager();
       
        $sumi = 0;
        $json = array();
        $Signalisation = $em->getRepository('AdministrateurBundle:Signalisation')->findSignalisationItineraire();
        foreach ($Signalisation as $s) {
            $id = $s->getIdItineraire()->getIdItineraire();
            $res = $em->getRepository('AdministrateurBundle:Signalisation')->findNombreSignalisationItineraire($id);
            if ($res > 2) {
                $sumi = $sumi + 1;
            }
        }
        $sumr = 0;
        $Signalisations = $em->getRepository('AdministrateurBundle:Signalisation')->findSignalisationRecommandation();
        foreach ($Signalisations as $s) {
            $id = $s->getIdRecommandation()->getIdRecommandation();
            $res1 = $em->getRepository('AdministrateurBundle:Signalisation')->findNombreSignalisationRecommandation($id);
            if ($res1 > 5) {
                $sumr = $sumr + 1;
            }
        }

        $sumo = 0;
        $signalisations = $em->getRepository('AdministrateurBundle:Signalisation')->findSignalisationOffre();
        foreach ($signalisations as $s) {
            $id = $s->getIdOffrep()->getIdOffrep();
            $res2 = $em->getRepository('AdministrateurBundle:Signalisation')->findNombreSignalisationOffre($id);
            if ($res2 > 5) {
                $sumo = $sumo + 1;
            }
        }

        $sumt = $sumi + $sumr + $sumo;
        array_push($json, $sumi);
        array_push($json, $sumr);
        array_push($json, $sumo);
        array_push($json, $sumt);
        $response = new JsonResponse();
        return $response->setData($json);
    }
      public function getNotifAction() {
          
        $em = $this->getDoctrine()->getManager();
        $geranttmp = $em->getRepository('AdministrateurBundle:Geranttmp')->findAll();
        $json = array(sizeof($geranttmp));
        $response = new JsonResponse();
        return $response->setData($json);
        
    }
    
     public function getNotifLieuAction() {
          
        $em = $this->getDoctrine()->getManager();
        $lieutmp = $em->getRepository('AdministrateurBundle:Lieutmp')->findAll();
        $json = array(sizeof($lieutmp));
        $response = new JsonResponse();
        return $response->setData($json);
        
    }

}
