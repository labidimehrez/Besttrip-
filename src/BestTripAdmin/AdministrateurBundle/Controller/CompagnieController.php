<?php

namespace BestTripAdmin\AdministrateurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BestTripAdmin\AdministrateurBundle\Entity\Compagnie;
use BestTripAdmin\AdministrateurBundle\Form\CompagnieForm;

class CompagnieController extends Controller {

    public function AjoutAction() {
        $cmp = new Compagnie();
        $cmp->setDateAjout(new \DateTime('now'));
        $form = $this->createForm(new CompagnieForm(), $cmp);
        if ($this->getRequest()->isMethod('POST')) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($cmp);
                $em->flush();
                return $this->redirect($this->generateUrl('administrateur_consulter_Compagnie'));
            }
        }
        return $this->render('AdministrateurBundle:Compagnie:AjoutView.html.twig', array("form" => $form->createView()));
    }

    public function ConsulterAction() {
        $em = $this->getDoctrine()->getManager();
        $cmp = $em->getRepository('AdministrateurBundle:Compagnie')->findAll();
        $view = 'AdministrateurBundle:Compagnie:ConsulterView.html.twig';

        return $this->render($view, array('comp' => $cmp));
    }

    public function SupprimerAction($id) {
        $em = $this->getDoctrine()->getManager();
        $cmp = $em->getRepository('AdministrateurBundle:Compagnie')->find($id);
        $em->remove($cmp);
        $em->flush();
        return $this->redirect($this->generateUrl('administrateur_consulter_Compagnie'));
    }

    public function ModifierAction($id) {
        $em = $this->getDoctrine()->getManager();
        $cmp = $em->getRepository("AdministrateurBundle:Compagnie")->find($id);
        $form = $this->createForm(new CompagnieForm(), $cmp);
        $req = $this->getRequest();
        if ($req->getMethod() == 'POST') {
            $form->bind($req);
            if ($form->isValid()) {
                $em->persist($cmp);
                $em->flush();
            }
            return $this->redirect($this->generateUrl('administrateur_consulter_Compagnie'));
        }
        return ($this->render('AdministrateurBundle:Compagnie:ModifierView.html.twig', array('form' => $form->createView(), 'cmp' => $cmp)));
    }

}
