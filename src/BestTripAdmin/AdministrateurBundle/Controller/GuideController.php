<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GuideController
 *
 * @author wissal
 */

namespace BestTripAdmin\AdministrateurBundle\Controller;

use \BestTripAdmin\AdministrateurBundle\Entity\Guide;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \BestTripAdmin\AdministrateurBundle\Form\GuideForm;

class GuideController extends Controller {

    //put your code here
    public function AjoutAction() {
        $guide = new Guide();
        $guide->setDateAjout(new \DateTime('now'));
        $pays = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:Pays')->findAll();
        $request = $this->get('request');
        $form = $this->createForm(new GuideForm(), $guide);
        if ($this->getRequest()->isMethod('POST')) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {

                if ($request->get('ch') === 'Ville') {
                    $ville = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:Ville')->find($request->get('Ville'));
                    $guide->setIdVille($ville);
                }
                if ($request->get('ch') === 'Pays') {
                    $pays = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:Pays')->find($request->get('Pays'));
                    $guide->setIdPays($pays);
                }
                $em = $this->getDoctrine()->getManager();
                $em->persist($guide);
                $em->flush();
                return $this->redirect($this->generateUrl('administrateur_ajout_guide'));
            }
        }
        return $this->render('AdministrateurBundle:Guide:AjouterView.html.twig', array("form" => $form->createView(), "Pays" => $pays));
    }

    public function ConsulterAction() {
        $em = $this->getDoctrine()->getManager();
        $guide = $em->getRepository('AdministrateurBundle:Guide')->findAll();
        $view = 'AdministrateurBundle:Guide:ConsulterView.html.twig';
        return $this->render($view, array('guides' => $guide));
    }

    public function SupprimerAction($id) {
        $em = $this->getDoctrine()->getManager();
        $guide = $em->getRepository('AdministrateurBundle:Guide')->find($id);
        $em->remove($guide);
        $em->flush();
        return $this->redirect($this->generateUrl('administrateur_consulter_guide'));
    }

    public function ModifierAction($id) {
        $em = $this->getDoctrine()->getManager();
        $guide = $em->getRepository('AdministrateurBundle:Guide')->find($id);
        $form = $this->createForm(new GuideForm(), $guide);
        $request = $this->get('request');
        if ($guide->getIdPays() != NULL) {
            $paysChoisit = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:Pays')->find($guide->getIdPays());
        } else {
            $paysChoisit = NULL;
        }
        $pays = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:Pays')->findAll();
        if ($guide->getIdVille() != NULL) {
            $villeChoisit = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:Ville')->find($guide->getIdVille());
            $villes = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:Ville')->findByIdPays($villeChoisit->getIdPays());
        } else {
            $villeChoisit = NULL;
            $villes = NULL;
        }
        if ($this->getRequest()->isMethod('POST')) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                if ($request->get('Ville') != NULL) {
                    $ville = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:Ville')->find($request->get('Ville'));
                    $guide->setIdVille($ville);
                } else {
                    $pay = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:Pays')->find($request->get('Pays'));
                    $guide->setIdPays($pay);
                }
                $em->persist($guide);
                $em->flush();
                return $this->redirect($this->generateUrl('administrateur_consulter_guide'));
            }
        }
        return $this->render('AdministrateurBundle:Guide:ModifierView.html.twig', array("form" => $form->createView(), "guide" => $guide, "Pays" => $pays, 'villes' => $villes, 'villeChoisit' => $villeChoisit,
                    'paysChoisit' => $paysChoisit));
    }

}
