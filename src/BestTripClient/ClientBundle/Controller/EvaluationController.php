<?php

namespace BestTripClient\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BestTripClient\ClientBundle\Entity\Evaluation;
use \Symfony\Component\HttpFoundation\JsonResponse;

class EvaluationController extends Controller {

    public function AjoutAction($val, $id) {
        if ($this->getUser() === null) {
            return $this->redirect($this->generateUrl('client_homepage'));
        } else {
            $evaluation = new Evaluation();
            $itineraire = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Itineraire')->find($id);
            $evaluation->setIdItineraire($itineraire);
            $evaluation->setNote($val);
            $evaluation->setDateAjout(new \DateTime('now'));
            $evaluation->setIdUtilisateur($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($evaluation);
            $em->flush();
            $json = array("success");
            $response = new JsonResponse();
            return $response->setData($json);
        }
    }

    public function AjoutOffreProAction($val, $id) {
        if ($this->getUser() === null) {
            return $this->redirect($this->generateUrl('client_homepage'));
        } else {
            $evaluation = new Evaluation();
            $offre = $this->getDoctrine()->getManager()->getRepository('ClientBundle:OffreProfessionnelle')->find($id);
            $evaluation->setIdOffreprofessionnelle($offre);
            $evaluation->setNote($val);
            $evaluation->setDateAjout(new \DateTime('now'));
            $evaluation->setIdUtilisateur($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($evaluation);
            $em->flush();
            $json = array("success");
            $response = new JsonResponse();
            return $response->setData($json);
        }
    }
    
    public function AjoutOffrePersoAction($val, $id) {
        if ($this->getUser() === null) {
            return $this->redirect($this->generateUrl('client_homepage'));
        } else {
            $evaluation = new Evaluation();
            $offre = $this->getDoctrine()->getManager()->getRepository('ClientBundle:OffrePersonnelle')->find($id);
            $evaluation->setIdOffrepersonnelle($offre);
            $evaluation->setNote($val);
            $evaluation->setDateAjout(new \DateTime('now'));
            $evaluation->setIdUtilisateur($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($evaluation);
            $em->flush();
            $json = array("success");
            $response = new JsonResponse();
            return $response->setData($json);
        }
    }

}
