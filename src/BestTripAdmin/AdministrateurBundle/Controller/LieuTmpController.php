<?php

namespace BestTripAdmin\AdministrateurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BestTripAdmin\AdministrateurBundle\Entity\Lieutmp;
use BestTripAdmin\AdministrateurBundle\Entity\Lieu;

class LieuTmpController extends Controller {

    public function ConsulterAction() {
        $em = $this->getDoctrine()->getManager();
        $lieux = $em->getRepository('AdministrateurBundle:Lieutmp')->findAll();
        $view = 'AdministrateurBundle:LieuTmp:Consulter.html.twig';

        return $this->render($view, array('lieux' => $lieux));
    }

    public function IgnorerAction($id) {
        $em = $this->getDoctrine()->getManager();
        $lieu = $em->getRepository('AdministrateurBundle:Lieutmp')->find($id);
        $em->remove($lieu->getIdRec());
        $em->remove($lieu);
        $em->flush();
        return $this->redirect($this->generateUrl('administrateur_consulter_Lieutmp'));
    }

    public function AccepterAction($id) {
        $em = $this->getDoctrine()->getManager();
        $lieut = $em->getRepository('AdministrateurBundle:Lieutmp')->find($id);
        $rec = $lieut->getIdRec();
        $lieu = new Lieu();
        $lieu->setAdresse($lieut->getAdresse());
        $lieu->setIdVille($lieut->getIdVille());
        $lieu->setNom($lieut->getNom());
        $lieu->setType($lieut->getType());
        $em->persist($lieu);
        $em->flush();
        $em->remove($lieut);
        $em->flush();
        $rec->setIdLieu($lieu);
        $em->persist($rec);
        $em->flush();
        return $this->redirect($this->generateUrl('administrateur_consulter_Lieutmp'));
    }

    public function VisualiserAction($id) {
        $em = $this->getDoctrine()->getManager();
        $lieut = $em->getRepository('AdministrateurBundle:Lieutmp')->find($id);
        $adr = $lieut->getAdresse();
        $ville = $lieut->getIdVille()->getNom();
        $nom = $lieut->getNom();
        return $this->render('AdministrateurBundle:LieuTmp:Visualiser.html.twig', array("adresse" => $adr, "ville" => $ville,'idLieux'=>$id));
    }

}
