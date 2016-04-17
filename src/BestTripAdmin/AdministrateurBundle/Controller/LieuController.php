<?php

namespace BestTripAdmin\AdministrateurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BestTripAdmin\AdministrateurBundle\Entity\Lieu;
use BestTripAdmin\AdministrateurBundle\Form\LieuForm;
use \Symfony\Component\HttpFoundation\JsonResponse;
use BestTripAdmin\AdministrateurBundle\Entity\Media;

class LieuController extends Controller {

    public function AjoutAction() {
        $lieu = new Lieu();

        $form = $this->createForm(new LieuForm(), $lieu);
        $request = $this->get('request');
        $pays = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:Pays')->findAll();
        $form->handleRequest($request);

        $formView = $form->createView();

        if ($form->isValid()) {

            $ville = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:Ville')->find($request->get('Ville'));
            $lieu->setIdVille($ville);
            $em = $this->getDoctrine()->getManager();
          
            
            
            $em->persist($lieu);
            if ($form->getData()->getAttachement()['file'] != null) {
                foreach ($form->getData()->getAttachement()['file'] as $image) {
                    $media = new Media();
                    $media->setDateAjout(new \DateTime('now'));
                    $media->setIdLieu($lieu);
                    $media->setType("image");
                    $media->file = $image;
                    $em->persist($media);
                }
            }
            $em->flush();

            return $this->redirect($this->generateUrl('administrateur_consulter_lieu'));
        }
        return $this->render('AdministrateurBundle:Lieu:AjoutView.html.twig', array("form" => $formView, "pays" => $pays));
    }

    public function ConsulterAction() {
        $em = $this->getDoctrine()->getManager();
        $lieu = $em->getRepository('AdministrateurBundle:Lieu')->findAll();
        $view = 'AdministrateurBundle:Lieu:ConsulterView.html.twig';

        return $this->render($view, array('lieux' => $lieu));
    }

    public function SupprimerAction($id) {
        $em = $this->getDoctrine()->getManager();
        $lieu = $em->getRepository('AdministrateurBundle:Lieu')->find($id);
        $media = $em->getRepository('AdministrateurBundle:Media')->findByIdLieu($id);
        $em->remove($lieu);
        if ($media != null) {
            foreach ($media as $m) {
                $em->remove($m);
            }
        }

        $em->flush();
        return $this->redirect($this->generateUrl('administrateur_consulter_lieu'));
    }

    public function ModifierAction($id) {
        $em = $this->getDoctrine()->getManager();
        $lieu = $em->getRepository("AdministrateurBundle:Lieu")->find($id);
        $pays = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:Pays')->findAll();
        $villeChoisit = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:Ville')->find($lieu->getIdVille());
        $villes = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:Ville')->findByIdPays($villeChoisit->getIdPays());
        $paysChoisit = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:Pays')->find($villeChoisit->getIdPays());
        $images = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:Media')->findByIdLieu($id);
        $form = $this->createForm(new LieuForm(), $lieu);
        $form->handleRequest($this->getRequest());
       
            if ($form->isValid()) {
                $ville = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:Ville')->find($this->getRequest()->get('Ville'));
                $lieu->setIdVille($ville);
                $em->persist($lieu);
                if ($form->getData()->getAttachement()['file'] != null) {
                    foreach ($form->getData()->getAttachement()['file'] as $image) {
                        $media = new Media();
                        $media->setDateAjout(new \DateTime('now'));
                        $media->setIdLieu($lieu);
                        $media->setType("image");
                        $media->file = $image;
                        $em->persist($media);
                    }
                }
                $em->flush();
                 return $this->redirect($this->generateUrl('administrateur_consulter_lieu'));
            }
           
        
        return ($this->render('AdministrateurBundle:Lieu:ModifierView.html.twig', array('form' => $form->createView(), 'lieu' => $lieu, 'pays' => $pays,
                    'villes' => $villes, 'villeChoisit' => $villeChoisit,
                    'paysChoisit' => $paysChoisit, "images" => $images)));
    }

    public function GetVilleAction($id) {

        $ville = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:Ville')->findByIdPays($id);
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

}
