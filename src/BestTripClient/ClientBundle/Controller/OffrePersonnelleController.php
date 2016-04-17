<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OffrePersonnelleController
 *
 * @author wissal
 */

namespace BestTripClient\ClientBundle\Controller;

use BestTripClient\ClientBundle\Entity\OffrePersonnelle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BestTripClient\ClientBundle\Form\OffrePersonnelleForm;
use \Symfony\Component\HttpFoundation\JsonResponse;

class OffrePersonnelleController extends Controller {

    //put your code here
    public function AjoutAction() {
        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $user = $this->getUser();

            if ($user->getType() == 'Client') {
                $offreperso = new OffrePersonnelle();
                $offreperso->setDateAjout(new \DateTime('now'));
                $offreperso->setIdUtilisateur($user);
                $pays = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Pays')->findAll();
                $request = $this->get('request');
                $form = $this->createForm(new OffrePersonnelleForm(), $offreperso);
                if ($this->getRequest()->isMethod('POST')) {
                    $form->handleRequest($this->getRequest());
                    if ($form->isValid()) {
                        $ville = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Ville')->find($request->get('Ville'));
                        $offreperso->setIdVille($ville);
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($offreperso);
                        $em->flush();
                        return $this->redirect($this->generateUrl('client_Compte'));
                    }
                }
                return $this->render('ClientBundle:OffrePersonnelle:AjouterView.html.twig', array("form" => $form->createView(), "Pays" => $pays));
            }
            return $this->redirect($this->generateUrl('login_user'));
        }
        return $this->redirect($this->generateUrl('login_user'));
    }

    public function GetVilleAction($id) {

        $ville = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Ville')->findByIdPays($id);
        $json = array();

        if ($ville) {
            foreach ($ville as $v) {
                $json[$v->getIdVille()][] = $v->getNom();
            }
        } else {
            $json = null;
        }

        $response = new JsonResponse();
        return $response->setData($json);
    }

    public function ConsulterAllAction() {
        $em = $this->getDoctrine()->getManager();
        $offres = $em->getRepository('ClientBundle:OffrePersonnelle')->findAll();
        $pays = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Pays')->findAll();
        foreach ($offres as $offre) {
            $media = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Media')->findOneByIdVille($offre->getidVille());
            if (!is_null($media)) {
                $offre->setImage($media->getLien());
            } else {
                $offre->setImage("notexiste.bmp");
            }
        }
        $view = 'ClientBundle:OffrePersonnelle:ConsulterAllView.html.twig';
        return $this->render($view, array('offres' => $offres, "Pays" => $pays));
    }

    public function ConsulterOffreAction($id) {
        $em = $this->getDoctrine()->getManager();
        $offre = $em->getRepository('ClientBundle:OffrePersonnelle')->find($id);
        $media = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Media')->findOneByIdVille($offre->getidVille());
        $mediapays = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Media')->findOneByIdPays($offre->getidVille()->getidPays());
        $user = $this->getUser();
        $ss = $em->getRepository('ClientBundle:Signalisation')->findBy(array('idOffrep' => $offre, 'idUtilisateur' => $user));
        $eva = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Evaluation')->findBy(array('idOffrepersonnelle' => $id, 'idUtilisateur' => $this->getUser()));
        $ville = $offre->getidVille() . "+" . $offre->getidVille()->getidPays();
        if (!is_null($mediapays)) {
            $offre->setImagepays($mediapays->getLien());
        } else {
            $offre->setImagepays("notexiste.bmp");
        }
        if (!is_null($media)) {
            $offre->setImage($media->getLien());
        } else {
            $offre->setImage("notexiste.bmp");
        }
        $view = 'ClientBundle:OffrePersonnelle:ConsulterOffreView.html.twig';
        return $this->render($view, array('offre' => $offre, 'ville' => $ville, 'signalisation' => $ss, 'eva' => $eva));
    }

    public function ConsulterMonOffreAction($id) {
        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $user = $this->getUser();

            if ($user->getType() == 'Client') {
                $em = $this->getDoctrine()->getManager();
                $offre = $em->getRepository('ClientBundle:OffrePersonnelle')->find($id);
                $media = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Media')->findOneByIdVille($offre->getidVille());
                $mediapays = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Media')->findOneByIdPays($offre->getidVille()->getidPays());

                if (!is_null($mediapays)) {
                    $offre->setImagepays($mediapays->getLien());
                } else {
                    $offre->setImagepays("notexiste.bmp");
                }
                if (!is_null($media)) {
                    $offre->setImage($media->getLien());
                } else {
                    $offre->setImage("notexiste.bmp");
                }
                $view = 'ClientBundle:OffrePersonnelle:ConsulterOffreCView.html.twig';
            }
        }
        return $this->render($view, array('offre' => $offre));
    }

    public function ConsulterAction() {
        if ($this->getUser() === null) {
            return $this->redirect($this->generateUrl('client_homepage'));
        }
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $offres = $em->getRepository('ClientBundle:OffrePersonnelle')->findByIdUtilisateur($user);
        foreach ($offres as $offre) {
            $media = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Media')->findOneByIdVille($offre->getidVille());
            if (!is_null($media)) {
                $offre->setImage($media->getLien());
            } else {
                $offre->setImage("notexiste.bmp");
            }
        }
        $view = 'ClientBundle:OffrePersonnelle:ConsulterView.html.twig';
        return $this->render($view, array('offres' => $offres));
    }

    public function SupprimerAction($id) {
        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $user = $this->getUser();

            if ($user->getType() == 'Client') {
                $em = $this->getDoctrine()->getManager();
                $offre = $em->getRepository('ClientBundle:OffrePersonnelle')->find($id);
                $em->remove($offre);
                $em->flush();
            }
        }
        return $this->redirect($this->generateUrl('client_consulterAll_offrepersonnelle'));
    }

    public function ModifierAction($id) {
        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $user = $this->getUser();

            if ($user->getType() == 'Client') {
                $em = $this->getDoctrine()->getManager();
                $offre = $em->getRepository('ClientBundle:OffrePersonnelle')->find($id);
                $form = $this->createForm(new OffrePersonnelleForm(), $offre);
                $request = $this->get('request');
                $pays = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Pays')->findAll();
                $villeChoisit = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Ville')->find($offre->getIdVille());
                $paysChoisit = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Pays')->find($villeChoisit->getIdPays());
                $villes = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Ville')->findByIdPays($villeChoisit->getIdPays());
                if ($this->getRequest()->isMethod('POST')) {
                    $form->handleRequest($this->getRequest());
                    if ($form->isValid()) {
                        $ville = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Ville')->find($request->get('Ville'));
                        $offre->setIdVille($ville);
                        $em->persist($offre);
                        $em->flush();
                        return $this->redirect($this->generateUrl('client_consulterAll_offrepersonnelle'));
                    }
                }
                return $this->render('ClientBundle:OffrePersonnelle:ModifierView.html.twig', array("form" => $form->createView(), "offre" => $offre, "Pays" => $pays, 'villes' => $villes, 'villeChoisit' => $villeChoisit, 'paysChoisit' => $paysChoisit));
            }
        }
        return $this->redirect($this->generateUrl('client_consulterAll_offrepersonnelle'));
    }

    public function ChercherAction() {
        $em = $this->getDoctrine()->getManager();
        $offres = $em->getRepository('ClientBundle:OffrePersonnelle')->findAll();
        $pays = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Pays')->findAll();
        if ($this->getRequest()->isMethod('POST')) {
            $offresrech = array();
            $request = $this->get('request');
            foreach ($offres as $o) {

                if ($request->get('Ville') != '0') {
                    if ($o->getIdVille()->getIdVille() == $request->get('Ville')) {
                        $media = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Media')->findOneByIdVille($o->getidVille());
                        if (!is_null($media)) {
                            $o->setImage($media->getLien());
                        } else {
                            $o->setImage("notexiste.bmp");
                        }
                        array_push($offresrech, $o);
                    }
                } else {
                    $media = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Media')->findOneByIdVille($o->getidVille());
                    if (!is_null($media)) {
                        $o->setImage($media->getLien());
                    } else {
                        $o->setImage("notexiste.bmp");
                    }
                    array_push($offresrech, $o);
                }
            }
        }
        $view = 'ClientBundle:OffrePersonnelle:ConsulterAllView.html.twig';
        return $this->render($view, array('offres' => $offresrech, "Pays" => $pays));
    }

}
