<?php

namespace BestTripClient\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LieuController extends Controller {

    public function ConsulterAction($id) {
        $em = $this->getDoctrine()->getManager();
        $lieu = $em->getRepository('ClientBundle:Lieu')->find($id);
        $medias = $em->getRepository('ClientBundle:Media')->findByidLieu($lieu);
        $recommandations = $em->getRepository('ClientBundle:Recommandation')->findByidLieu($lieu);
        foreach ($recommandations as $r) {
            $r->setImage("uploads/Utilisateurs/" . $r->getIdUtilisateur()->getLogo());
        }
        $evaluations = $em->getRepository('ClientBundle:Evaluation')->findByidLieu($lieu);
        $s = 0;
        $res = 'pas encore evalué';

        if (sizeof($evaluations) > 0) {
            foreach ($evaluations as $e) {
                $s = $s + $e->getNote();
            }
            $s = $s / sizeof($evaluations);
            if ($s < 10) {
                $res = $s . '% MAUVAIS';
            }
            if ($s >= 10) {
                $res = $s . '% PAS MAL';
            }
            if ($s >= 40) {
                $res = $s . '% BON';
            }
            if ($s >= 70) {
                $res = $s . '% EXCELENT';
            }
        }
        return $this->render('ClientBundle:Lieu:Consulter.html.twig', array('lieu' => $lieu, 'medias' => $medias, 'rec' => $recommandations, 'eva' => $s, 'res' => $res));
    }

}
