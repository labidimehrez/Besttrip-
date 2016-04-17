<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MailController
 *
 * @author wissal
 */

namespace BestTripAdmin\AdministrateurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \BestTripAdmin\AdministrateurBundle\Entity\Newsletter;

class NewsLetterController extends Controller {

    public function EnvoyerAction() {
        $req = $this->get('request');
        $em = $this->getDoctrine()->getManager();
        $request = $this->container->get('request');
        $data1 = $request->query->get('str');
        $listgerant = $em->getRepository('AdministrateurBundle:Utilisateur')->findBy(array('type'=>'Gerant','abbnewslettre'=>'1'));
        if ($req->getMethod() == 'POST') {
            $dest = $req->get('destination');
            if ($dest == 'Tous') {
                $list = $em->getRepository('AdministrateurBundle:Utilisateur')->findByAbbnewslettre(1);
            } else if ($dest == 'Clients') {
                $list = $em->getRepository('AdministrateurBundle:Utilisateur')->findBy(array('type'=>'Client','abbnewslettre'=>'1'));
            } else if ($dest == 'Gerants') {
                $list = $em->getRepository('AdministrateurBundle:Utilisateur')->findBy(array('type'=>'Gerant','abbnewslettre'=>'1'));
            } else if ($dest == 'Gerant') {
                $list = $em->getRepository('AdministrateurBundle:Utilisateur')->findByEmail($req->get('select'));
            }
            foreach ($list as $use) {
                $mailer = $this->get('mailer');
                $message = $mailer->createMessage()
                        ->setSubject($req->get('sujet'))
                        ->setFrom('besttripsuccess@gmail.com')
                        ->setTo($use->getEmail())
                        ->setContentType("text/html")
                        ->setBody($req->get('mymessage'));
                $mailer->send($message);
            }
            $lettre = new Newsletter();
            $lettre->setDateAjout(new \DateTime('now'));
            $sujet = $req->get('sujet');
            $mess = $req->get('mymessage');
            $lettre->setMessage($mess);
            $lettre->setSujet($sujet);
            $em->persist($lettre);
            $em->flush();
            return $this->render('AdministrateurBundle:NewsLettre:NewsLetterView.html.twig', array('lgerants' => $listgerant));
        }
        return $this->render('AdministrateurBundle:NewsLettre:NewsLetterView.html.twig', array('lgerants' => $listgerant));
    }

}
