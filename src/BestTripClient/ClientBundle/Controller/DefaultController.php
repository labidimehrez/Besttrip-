<?php

namespace BestTripClient\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function IndexAction() {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("SELECT r as rec, COUNT(r.idRecommandation) as nb
FROM ClientBundle:Recommandation r 
WHERE r.idLieu IS NOT NULL 
GROUP BY r.idLieu
ORDER BY nb desc
")->setMaxResults(3);
        $query2 = $em->createQuery("SELECT o as offre
FROM ClientBundle:OffreProfessionnelle o 
ORDER BY o.dateAjout desc
")->setMaxResults(4);
        $query3 = $em->createQuery("SELECT e as ev, COUNT(e.idEvaluation) as nb
FROM ClientBundle:Evaluation e 
WHERE e.idItineraire IS NOT NULL 
GROUP BY e.idItineraire
ORDER BY nb desc
")->setMaxResults(4);
        $offres = $query2->getResult();
        $lieux = $query->getResult();
        $Itineraires = $query3->getResult();
        $lieu = array();
        foreach ($lieux as $li) {
            $rec = array();
            $lieur = $li['rec']->getidLieu();
            $media = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Media')->findOneByIdLieu($lieur);
            $lieur->setImage($media->getLien());
            $lieur->setNbrec($li['nb']);
            array_push($lieu, $lieur);
        }
        $itens=array();
        foreach ($Itineraires as $it) {
            $iten = $it['ev']->getIdItineraire();
            $iten->setNumber($it['nb']);
            $media = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Media')->findOneByIdItineraire($iten);
            $iten->setAttachement($media->getLien());
            array_push($itens, $iten);
        }
        return $this->render('ClientBundle:Default:index.html.twig', array('lieux' => $lieu, 'offres' => $offres, 'iteneraires' => $itens));
    }

}
