<?php

namespace BestTripClient\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BestTripClient\ClientBundle\Entity\Recommandation;
use BestTripClient\ClientBundle\Entity\Lieutmp;
use \Symfony\Component\HttpFoundation\JsonResponse;
use BestTripClient\ClientBundle\Form\RecommandationForm;
use BestTripClient\ClientBundle\Form\LieutmpForm;

class RecommandationController extends Controller {

    public function AjoutAction() {
        if ($this->getUser() === null) {
            return $this->redirect($this->generateUrl('client_homepage'));
        }
        $rec = new Recommandation();
        $lieutmp = new Lieutmp();
        $rec->setDateAjout(new \DateTime('now'));
        $form = $this->createForm(new RecommandationForm(), $rec);
        $form1 = $this->createForm(new LieutmpForm(), $lieutmp);
        $pays = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:Pays')->findAll();
        return $this->render('ClientBundle:Recommandation:AjoutView.html.twig', array("pays" => $pays, "form" => $form->createView(), "form1" => $form->createView(), "form2" => $form->createView(), "form3" => $form->createView(), "forml" => $form1->createView()));
    }

    public function AjoutLieuAction() {
        if ($this->getUser() === null) {
            return $this->redirect($this->generateUrl('client_homepage'));
        }
        $rec = new Recommandation();
        $rec->setDateAjout(new \DateTime('now'));
        $form = $this->createForm(new RecommandationForm(), $rec);
        $request = $this->get('request');
        if ($this->getRequest()->isMethod('POST')) {
            $form->handleRequest($this->getRequest());
            $em = $this->getDoctrine()->getManager();
            $lieu = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Lieu')->find($request->get('Lieu'));
            $rec->setIdLieu($lieu);
            $rec->setIdUtilisateur($this->getUser());
            $em->persist($rec);
            $em->flush();
            return $this->redirect($this->generateUrl('client_Recommandation_Consulter'));
        }
    }

    public function AjoutVilleAction() {
        if ($this->getUser() === null) {
            return $this->redirect($this->generateUrl('client_homepage'));
        }
        $rec = new Recommandation();
        $rec->setDateAjout(new \DateTime('now'));
        $form = $this->createForm(new RecommandationForm(), $rec);
        $request = $this->get('request');
        if ($this->getRequest()->isMethod('POST')) {
            $form->handleRequest($this->getRequest());
            $em = $this->getDoctrine()->getManager();
            $ville = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Ville')->find($request->get('Ville'));
            $rec->setIdVille($ville);
            $rec->setIdUtilisateur($this->getUser());
            $em->persist($rec);
            $em->flush();
            return $this->redirect($this->generateUrl('client_Recommandation_Consulter'));
        }
    }

    public function AjoutCompagnieAction() {
        if ($this->getUser() === null) {
            return $this->redirect($this->generateUrl('client_homepage'));
        }
        $rec = new Recommandation();
        $rec->setDateAjout(new \DateTime('now'));
        $form = $this->createForm(new RecommandationForm(), $rec);
        $request = $this->get('request');
        if ($this->getRequest()->isMethod('POST')) {
            $form->handleRequest($this->getRequest());
            $em = $this->getDoctrine()->getManager();
            $comp = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Compagnie')->find($request->get('Compagnie'));
            $rec->setIdCompagnie($comp);
            $rec->setIdUtilisateur($this->getUser());
            $em->persist($rec);
            $em->flush();
            return $this->redirect($this->generateUrl('client_Recommandation_Consulter'));
        }
    }

    public function AjoutLieutmpAction() {
        if ($this->getUser() === null) {
            return $this->redirect($this->generateUrl('client_homepage'));
        }
        $rec = new Recommandation();
        $lieutmp = new Lieutmp();
        $form1 = $this->createForm(new LieutmpForm(), $lieutmp);
        $form = $this->createForm(new RecommandationForm(), $rec);
        $request = $this->get('request');
        if ($this->getRequest()->isMethod('POST')) {
            $form->handleRequest($this->getRequest());
            $form1->handleRequest($this->getRequest());
            $em = $this->getDoctrine()->getManager();
            $rec->setIdUtilisateur($this->getUser());
            $em->persist($rec);
            $em->flush();
            $ville = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Ville')->find($request->get('Ville'));
            $lieutmp->setIdRec($rec);
            $lieutmp->setAdresse($request->get('Adresse'));
            $lieutmp->setIdVille($ville);
            $em->persist($lieutmp);
            $em->flush();

            return $this->redirect($this->generateUrl('client_Recommandation_Consulter'));
        }
    }

    public function GetVilleAction($id) {

        $ville = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Ville')->findByIdPays($id);
        $json = array();
        if ($ville) {
            foreach ($ville as $v) {
                //   array_push($json, $v);
                $json[$v->getIdVille()] = $v->getNom();
            }
        } else {
            $json = null;
        }
        $response = new JsonResponse();
        return $response->setData($json);
    }

    public function GetLieuxAction($id, $type) {
        $lieu = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Lieu')->findBy(array('idVille' => $id, 'type' => $type));
        $json = array();
        if ($lieu) {
            foreach ($lieu as $l) {
                $json[$l->getIdLieu()][] = $l->getNom();
            }
        } else {
            $json = null;
        }
        $response = new JsonResponse();
        return $response->setData($json);
    }

    public function GetCompagnieAction($type) {
        $cmp = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Compagnie')->findByType($type);
        $json = array();
        if ($cmp) {
            foreach ($cmp as $c) {
                $json[$c->getIdCompagnie()][] = $c->getNom();
            }
        } else {
            $json = null;
        }
        $response = new JsonResponse();
        return $response->setData($json);
    }

    public function GetCompagnieDetAction($id) {
        $cmp = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Compagnie')->find($id);
        $json = array();
        array_push($json, $cmp->getNom());
        array_push($json, $cmp->getType());
        array_push($json, $cmp->getLien());
        $response = new JsonResponse();
        return $response->setData($json);
    }

    public function ConsulterAction() {
        $em = $this->getDoctrine()->getManager();
        $rec1 = $em->getRepository('ClientBundle:Recommandation')->findAll();
        $request = $this->get('request');
        foreach ($rec1 as $r) {
            $r->setImage("uploads/Utilisateurs/" . $r->getIdUtilisateur()->getLogo());
        }
        $view = 'ClientBundle:Recommandation:ConsulterView.html.twig';
        $pays = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:Pays')->findAll();
        $rec = $this->get('knp_paginator')->paginate($rec1, $request->query->get('page', 1), 4);
        return $this->render($view, array('rec' => $rec, 'nb' => sizeof($rec1), 'Action' => 'Les recommandations Publiées par Nos Clients', 'pays' => $pays));
    }

    public function ModifierAction($id) {
        if ($this->getUser() === null) {
            return $this->redirect($this->generateUrl('client_homepage'));
        }
        $em = $this->getDoctrine()->getManager();
        $rec = $em->getRepository("ClientBundle:Recommandation")->find($id);
        $form = $this->createForm(new RecommandationForm(), $rec);
        $req = $this->getRequest();
        if ($req->getMethod() == 'POST') {
            $form->bind($req);
            if ($form->isValid()) {
                $em->persist($rec);
                $em->flush();
            }
            return $this->redirect($this->generateUrl('client_Compte'));
        }
        $view = 'ClientBundle:Recommandation:ModifierView.html.twig';
        return ($this->render($view, array('form' => $form->createView(), 'rec' => $rec)));
    }

    public function SupprimerAction($id) {
        if ($this->getUser() === null) {
            return $this->redirect($this->generateUrl('client_homepage'));
        }
        $em = $this->getDoctrine()->getManager();
        $rec = $em->getRepository('ClientBundle:Recommandation')->find($id);
        $em->remove($rec);
        $em->flush();
        return $this->redirect($this->generateUrl('client_Compte'));
    }

    public function ChercherAction() {
        $em = $this->getDoctrine()->getManager();
        $rec = $em->getRepository('ClientBundle:Recommandation')->findAll();
        $rec1 = array();
        $request = $this->get('request');
        if (!is_null($request->get('type'))) {
            foreach ($rec as $r) {
                if (($request->get('type') == 'Ville') && (!is_null($r->getidVille()))) {
                    if ((!($request->get('nom') == '')) && ($request->get('nom') == $r->getidVille()->getNom())) {
                        array_push($rec1, $r);
                    } elseif ($request->get('nom') == '') {
                        array_push($rec1, $r);
                    }
                }
                if (($request->get('type') == 'Lieu') && (!is_null($r->getidLieu()))) {
                    if ((!($request->get('nom') == '')) && ($request->get('nom') == $r->getidLieu()->getNom())) {
                        array_push($rec1, $r);
                    } elseif ($request->get('nom') == '') {
                        array_push($rec1, $r);
                    }
                }
                if (($request->get('type') == 'Compagnie') && (!is_null($r->getidCompagnie()))) {
                    if ((!($request->get('nom') == '')) && ($request->get('nom') == $r->getIdCompagnie()->getNom())) {
                        array_push($rec1, $r);
                    } elseif ($request->get('nom') == '') {
                        array_push($rec1, $r);
                    }
                }
            }
        }
        foreach ($rec1 as $r) {
            $r->setImage("uploads/Utilisateurs/" . $r->getIdUtilisateur()->getLogo());
        }
        $view = 'ClientBundle:Recommandation:ConsulterView.html.twig';
        $rec = $this->get('knp_paginator')->paginate($rec1, $request->query->get('page', 1), 20);
        return $this->render($view, array('rec' => $rec, 'nb' => sizeof($rec1), 'Action' => 'Resultat de recherche'));
    }

}
