<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OffreProfessionnelleClientController
 *
 * @author wissal
 */

namespace BestTripClient\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BestTripClient\ClientBundle\Entity\OffreProfessionnelle;
use BestTripClient\ClientBundle\Form\OffreProfessionnelleForm;

class OffreProfessionnelleController extends Controller {

    //put your code here

    public function ChercherAction() {
        $em = $this->getDoctrine()->getManager();
        $offres = $em->getRepository('ClientBundle:OffreProfessionnelle')->findAll();
        $pays = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Pays')->findAll();
        if ($this->getRequest()->isMethod('POST')) {
            $offresrech = array();
            $request = $this->get('request');
            foreach ($offres as $o) {
                if ($request->get('type') != '0') {
                    if ($o->getType() == $request->get('type')) {
                        if ($request->get('Ville') != '0') {
                            foreach ($o->getIdVille() as $v) {
                                if ($v->getIdVille() == $request->get('Ville')) {
                                    array_push($offresrech, $o);
                                }
                            }
                        } else {
                            array_push($offresrech, $o);
                        }
                    }
                } else {
                    if ($request->get('Ville') != '0') {
                        foreach ($o->getIdVille() as $v) {
                            if ($v->getIdVille() == $request->get('Ville')) {
                                array_push($offresrech, $o);
                            }
                        }
                    } else {
                        array_push($offresrech, $o);
                    }
                }
            }
        }
        $view = 'ClientBundle:OffreProfessionnelle:ConsulterView.html.twig';
        return $this->render($view, array('offres' => $offresrech, "Pays" => $pays));
    }

    public function ConsulterAction() {
        $em = $this->getDoctrine()->getManager();
        $offres = $em->getRepository('ClientBundle:OffreProfessionnelle')->findAll();
        $pays = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Pays')->findAll();
        $view = 'ClientBundle:OffreProfessionnelle:ConsulterView.html.twig';
        return $this->render($view, array('offres' => $offres, "Pays" => $pays));
    }

    public function ConsulterMesOffreAction() {
        if ($this->getUser() === null) {
            return $this->redirect($this->generateUrl('client_homepage'));
        }
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $offres = $em->getRepository('ClientBundle:OffreProfessionnelle')->findByIdUtilisateur($user);
        $view = 'ClientBundle:OffreProfessionnelle:ConsulterMesOffreView.html.twig';
        return $this->render($view, array('offres' => $offres));
    }

    public function ConsulterMonOffreAction($id) {
        
        $em = $this->getDoctrine()->getManager();
        $offre = $em->getRepository('ClientBundle:OffreProfessionnelle')->find($id);
        $villes = array();
        foreach ($offre->getIdVille() as $ville) {
            array_push($villes, $ville->getNom());
        }
        $photos = array();
        foreach ($offre->getIdVille() as $ville) {
            $media = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Media')->findOneByIdVille($ville);
            array_push($photos, $media);
        }

        $view = 'ClientBundle:OffreProfessionnelle:ConsulterOffreView.html.twig';
        return $this->render($view, array('offre' => $offre, 'villes' => $villes, 'img' => $photos));
    }

    public function ConsulterUneOffreAction($id) {
        $eva = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Evaluation')->findBy(array('idOffreprofessionnelle' => $id, 'idUtilisateur' => $this->getUser()));
        $em = $this->getDoctrine()->getManager();
        $offre = $em->getRepository('ClientBundle:OffreProfessionnelle')->find($id);
        $user = $this->getUser();
        $pp = $em->getRepository('ClientBundle:Participation')->findBy(array('idOffrep' => $offre, 'idUtilisateur' => $user));
        $par = $em->getRepository('ClientBundle:Participation')->findBy(array('idOffrep' => $offre));
        $counter = 0;
        foreach ($par as $pa) {
            $counter = $counter + 1;
        }
        $nbr=0;
        $nbr= $offre->getNbMax()- $counter;

        $villes = array();
        foreach ($offre->getIdVille() as $ville) {
            array_push($villes, $ville->getNom());
        }
        $photos = array();
        foreach ($offre->getIdVille() as $ville) {
            $media = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Media')->findOneByIdVille($ville);
            array_push($photos, $media);
        }
        $view = 'ClientBundle:OffreProfessionnelle:ConsulterUneOffreView.html.twig';
        return $this->render($view, array('offre' => $offre, 'villes' => $villes, 'img' => $photos, 'counter' => $counter, 'participations' => $pp,'eva'=>$eva,'nbre'=>$nbr));
    }

    public function AjouterAction() {
        if ($this->getUser() === null) {
            return $this->redirect($this->generateUrl('client_homepage'));
        }
        $offre = new OffreProfessionnelle();
        $form = $this->createForm(new OffreProfessionnelleForm(), $offre);
        $pays = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Pays')->findAll();
        $compa = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Compagnie')->findAll();
        $request = $this->get('request');
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $offre->setDateAjout(new \DateTime('now'));
            $user = $this->getUser();
            $offre->setIdUtilisateur($user);
            $offre->setPhoto("notexiste.bmp");
            $compagnie = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Compagnie')->find($request->get('compagnie'));
            $offre->setIdCompagnie($compagnie);
            foreach ($request->get('Ville') as $ville) {
                $v = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Ville')->find($ville);
                $offre->addIdVille($v);
            }
            $em->persist($offre);
            $em->flush();
            return $this->redirect($this->generateUrl('client_Compte'));
        }
        return $this->render('ClientBundle:OffreProfessionnelle:AjouterView.html.twig', array("form" => $form->createView(), "pays" => $pays, "compa" => $compa));
    }

    public function SupprimerAction($id) {
        $em = $this->getDoctrine()->getManager();
        $offre = $em->getRepository('ClientBundle:OffreProfessionnelle')->find($id);
        $em->remove($offre);
        $em->flush();
        return $this->redirect($this->generateUrl('client_Compte'));
    }

    public function ModifierAction($id) {
        $em = $this->getDoctrine()->getManager();
        $offre = $em->getRepository('ClientBundle:OffreProfessionnelle')->find($id);
        $form = $this->createForm(new OffreProfessionnelleForm(), $offre);
        $request = $this->get('request');
        $compa = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Compagnie')->findAll();
        $compaChoisit = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Compagnie')->find($offre->getIdCompagnie());
        if ($this->getRequest()->isMethod('POST')) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $em->persist($offre);
                $em->flush();
                return $this->redirect($this->generateUrl('client_Compte'));
            }
        }
        return $this->render('ClientBundle:OffreProfessionnelle:ModifierView.html.twig', array("form" => $form->createView(), "offre" => $offre, 'compChoisit' => $compaChoisit, 'comp' => $compa));
    }

}
