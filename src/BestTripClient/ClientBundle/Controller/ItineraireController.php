<?php

namespace BestTripClient\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \BestTripClient\ClientBundle\Entity\Itineraire;
use \BestTripClient\ClientBundle\Form\ItineraireForm;
use \Symfony\Component\HttpFoundation\JsonResponse;
use \BestTripClient\ClientBundle\Entity\Media;

class ItineraireController extends Controller {

    public function ConsulterAction() {
        $request = $this->get('request');
       
        $ville = $request->get('Ville');
        
        $itineraire = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Itineraire')->findAll();
        $pays = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Pays')->findAll();
        
        if ( $ville != null) {
            $itineraireRech =array();
            foreach ($itineraire as $i) {
                $villes = $i->getIdVille();
                foreach($villes as $v){
                    if(in_array($v->getIdVille(), $ville)){
                        array_push($itineraireRech, $i);
                    }
             
                }
              
            }
            $itineraire = $itineraireRech;
            
        }



        foreach ($itineraire as $it) {
            $media = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Media')->findOneByIdItineraire($it->getIdItineraire());

            $note = 0;
            $eva = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Evaluation')->findByIdItineraire($it->getIdItineraire());

            $total = sizeof($eva);
            foreach ($eva as $e) {
                $note = $note + $e->getNote();
            }
            if ($total > 0) {
                $noteTotal = $note / $total;
            } else {
                $noteTotal = 0;
            }
            $it->setNote($noteTotal);
            $it->setNumber($total);
            $it->setAttachement($media);
        }

        return $this->render('ClientBundle:Itineraire:ConsulterAllItineraireView.html.twig', array("itineraires" => $itineraire, "pays" => $pays, "number" => sizeof($itineraire)));
    }

    public function DetailsAction($id) {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $ss = $em->getRepository('ClientBundle:Signalisation')->findBy(array('idItineraire' => $id, 'idUtilisateur' => $user));
        
        
        $itineraire = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Itineraire')->findByIdItineraire($id);
        $AllUserIt = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Itineraire')->findByIdUtilisateur($itineraire[0]->getIdUtilisateur());
        $eva = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Evaluation')->findBy(array('idItineraire' => $id, 'idUtilisateur' => $this->getUser()));
        $allEva = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Evaluation')->findByIdItineraire($id);
        $note = 0;
        $total = sizeof($allEva);
        foreach ($allEva as $all) {
            $note = $note + $all->getNote();
        }
        if ($total > 0) {
            $noteTotal = $note / $total;
        } else {
            $noteTotal = 0;
        }

        $itineraire[0]->setNote($noteTotal);
        $itineraire[0]->setNumber($total);
        $images = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Media')->findBy(array('idItineraire' => $id, 'type' => 'image'));
        $video = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Media')->findBy(array('idItineraire' => $id, 'type' => 'video'));
        
        if($video != null){
           $len= strlen ($video[0]->getLien() );
        $ch1 = substr($video[0]->getLien(), 0, 24);
        $ch2='embed/';
        $ch3=  substr($video[0]->getLien(), 32, $len);
        $video=$ch1.$ch2.$ch3;
        
        }
        
        if (sizeof($itineraire[0]->getIdVille()) == 3) {
            $villes = "&origin=" . $itineraire[0]->getIdVille()[0] . "+" . $itineraire[0]->getIdVille()[0]->getIdPays() . "
            &destination=" . $itineraire[0]->getIdVille()[2] . "+" . $itineraire[0]->getIdVille()[2]->getIdPays() . "
            &waypoints=" . $itineraire[0]->getIdVille()[1] . "+" . $itineraire[0]->getIdVille()[1]->getIdPays();
        } elseif (sizeof($itineraire[0]->getIdVille()) == 2) {
            $villes = "&origin=" . $itineraire[0]->getIdVille()[0] . "+" . $itineraire[0]->getIdVille()[0]->getIdPays() . "
            &destination=" . $itineraire[0]->getIdVille()[1] . "+" . $itineraire[0]->getIdVille()[1]->getIdPays();
        } else {
            $villes = "&origin=" . $itineraire[0]->getIdVille()[0] . "+" . $itineraire[0]->getIdVille()[0]->getIdPays() . "
            &destination=" . $itineraire[0]->getIdVille()[0] . "+" . $itineraire[0]->getIdVille()[0]->getIdPays();
        }

        return $this->render('ClientBundle:Itineraire:ConsulterItineraireView.html.twig', array("itineraire" => $itineraire[0], "images" => $images, 'video' => $video, 'nbr' => sizeof($AllUserIt), 'eva' => $eva, 'villes' => $villes,'signalisation'=>$ss));
    }

    public function AjouterItineraireClientAction() {

        if ($this->getUser() === null) {
            return $this->redirect($this->generateUrl('client_homepage'));
        }
        $itineraire = new Itineraire();
        $form = $this->createForm(new ItineraireForm(), $itineraire);
        $pays = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Pays')->findAll();
        $request = $this->get('request');
        $form->handleRequest($request);
        if ($form->isValid()) {
            /* var_dump($form->getData()->getAttachement()['file']);
              var_dump($form->getData()->getTitre());
              var_dump($request->get('Ville'));
              var_dump($form->getData()->getDescription());
              var_dump($form->getData()->getDateDebut());
              var_dump($form->getData()->getDateFin());
              var_dump($form->getData()->getDepense());
              var_dump($request->get('devise'));
              die(); */
            $em = $this->getDoctrine()->getManager();
            $itineraire->setDevise($request->get('devise'));
            $itineraire->setDateAjout(new \DateTime('now'));
            $user = $this->getUser();
            $itineraire->setIdUtilisateur($user);
            foreach ($request->get('Ville') as $ville) {
                $v = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Ville')->find($ville);
                $itineraire->addIdVille($v);
            }
            $em->persist($itineraire);
            if ($form->getData()->getAttachement()['file'] != null) {
                foreach ($form->getData()->getAttachement()['file'] as $image) {
                    $media = new Media();
                    $media->setDateAjout(new \DateTime('now'));
                    $media->setIdItineraire($itineraire);
                    $media->setType("image");
                    $media->file = $image;
                    $em->persist($media);
                }
            }
            if ($form->getData()->getVideo() != '') {
                $media = new Media();
                $media->setDateAjout(new \DateTime('now'));
                $media->setIdItineraire($itineraire);
                $media->setType("video");
                $media->setLien($form->getData()->getVideo());
                $em->persist($media);
            }
            $em->flush();
            return $this->redirect($this->generateUrl('client_consulter_itineraire'));
        }
        return $this->render('ClientBundle:Itineraire:AjoutItineraireView.html.twig', array("form" => $form->createView(), "pays" => $pays));
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
    
    public function ModifierAction($id){
        $em = $this->getDoctrine()->getManager();
        $itineraire = $em->getRepository('ClientBundle:Itineraire')->find($id);
        $form = $this->createForm(new ItineraireForm(), $itineraire);
       
        if ($this->getRequest()->isMethod('POST')) {
            $form->handleRequest($this->getRequest());
            $request = $this->get('request');
            $itineraire->setDevise($request->get('devise'));
               
                $em->persist($itineraire);
                $em->flush();
                return $this->redirect($this->generateUrl('client_Compte'));
            
        }
        return $this->render('ClientBundle:Itineraire:ModifierItineraireView.html.twig', array("form" => $form->createView(),"itineraire"=>$itineraire));
    }
    
    public function SupprimerAction($id){
        $em = $this->getDoctrine()->getManager();
        $iti = $em->getRepository('ClientBundle:Itineraire')->find($id);
         $media = $em->getRepository('ClientBundle:Media')->findByIdItineraire($id);
        $em->remove($iti);
        if ($media != null) {
            foreach ($media as $m) {
                $em->remove($m);
            }
        }
        $em->flush();
        return $this->redirect($this->generateUrl('client_Compte'));
    }

}
