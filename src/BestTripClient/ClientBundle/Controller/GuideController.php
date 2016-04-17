<?php

namespace BestTripClient\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GuideController extends Controller {

    public function ListerVilleAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->get('request');

        $guides = $em->getRepository('ClientBundle:Guide')->findAll();
        $guids = array();
        foreach ($guides as $gui) {
            if (!is_null($gui->getidVille())) {
                $media = $em->getRepository('ClientBundle:Media')->findOneByidVille($gui->getidVille());
                $gui->setImage($media->getLien());
                array_push($guids, $gui);
            }
        }
        $guidees = $this->get('knp_paginator')->paginate($guids, $request->query->get('page', 1), 8);

        $view = 'ClientBundle:Guide:GuideVille.html.twig';
        return $this->render($view, array('guides' => $guidees));
    }

    public function ListerPaysAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->get('request');

        $guides = $em->getRepository('ClientBundle:Guide')->findAll();
        $guids = array();
        foreach ($guides as $gui) {
            if (!is_null($gui->getidPays())) {
                $media = $em->getRepository('ClientBundle:Media')->findOneByidPays($gui->getidPays());
                $gui->setImage($media->getLien());
                array_push($guids, $gui);
            }
        }
        $guidees = $this->get('knp_paginator')->paginate($guids, $request->query->get('page', 1), 8);

        $view = 'ClientBundle:Guide:GuidePays.html.twig';
        return $this->render($view, array('guides' => $guidees));
    }

}
