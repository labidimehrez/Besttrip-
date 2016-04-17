<?php

namespace BestTripAdmin\AdministrateurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BestTripAdmin\AdministrateurBundle\Entity\Geranttmp;
use BestTripAdmin\AdministrateurBundle\Entity\Utilisateur;

class GerantTmpController extends Controller {

    public function ConsulterAction() {
        $em = $this->getDoctrine()->getManager();
        $geranttmp = $em->getRepository('AdministrateurBundle:Geranttmp')->findAll();
        $view = 'AdministrateurBundle:Geranttmp:Consulter.html.twig';

        return $this->render($view, array('geranttmp' => $geranttmp));
    }

    public function IgnorerAction($id) {
        $em = $this->getDoctrine()->getManager();
        $geranttmp = $em->getRepository('AdministrateurBundle:Geranttmp')->find($id);
        $em->remove($geranttmp);
        $em->flush();
        return $this->redirect($this->generateUrl('administrateur_consulter_Geranttmp'));
    }

    public function ConfirmerAction ($id) {
        $em = $this->getDoctrine()->getManager();
        $geranttmp = $em->getRepository('AdministrateurBundle:Geranttmp')->find($id);
        $gerant = new Utilisateur();
        $gerant->setNomAgence($geranttmp->getNomAgence());
        $gerant->setAdresse($geranttmp->getAdresse());
        $gerant->setEmail($geranttmp->getEmail());
        $gerant->setMotDePasse($geranttmp->getMotDePasse());
        $gerant->setType("Gerant");
        $gerant->setAbbnewslettre(0);
        $gerant->setEtatCompte(1);
        $gerant->setDateAjout(new \DateTime('now'));
        $em->persist($gerant);
        $em->flush();
        $em->remove($geranttmp);
        $em->flush();
        return $this->redirect($this->generateUrl('administrateur_consulter_Geranttmp'));
    }

}
