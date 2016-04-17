<?php

namespace BestTripClient\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use BestTripClient\ClientBundle\Form\ClientForm;
use BestTripClient\ClientBundle\Entity\Utilisateur;
use \BestTripClient\ClientBundle\Entity\Geranttmp;

class UtilisateurController extends Controller {

    public function loginAction(Request $request) {
        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('client_homepage'));
        }
        $session = $request->getSession();
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('ClientBundle:Utilisateur:login.html.twig', array(
                    // Valeur du précédent nom d'utilisateur entré par l'internaute
                    'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                    'error' => $error,
        ));
    }

    public function CompteAction(Request $request) {
        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $rec = $em->getRepository('ClientBundle:Recommandation')->findByidUtilisateur($user);
            $request = $this->get('request');
            $evaluation = array();
            foreach ($rec as $r) {
                $r->setImage("uploads/Utilisateurs/" . $r->getIdUtilisateur()->getLogo());
            }
            if ($user->getType() == 'Client') {
                $offres = $em->getRepository('ClientBundle:OffrePersonnelle')->findByIdUtilisateur($user);
                foreach ($offres as $offre) {
                    $media = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Media')->findOneByIdVille($offre->getidVille());
                    if (!is_null($media)) {
                        $offre->setImage($media->getLien());
                    } else {
                        $offre->setImage("notexiste.bmp");
                    }
                }
            } else {
                $offres = $em->getRepository('ClientBundle:OffreProfessionnelle')->findByIdUtilisateur($user);
            }

            if ($user->getType() == 'Client') {
                $itineraire = $em->getRepository('ClientBundle:Itineraire')->findByIdUtilisateur($user);
                foreach ($itineraire as $it) {
                    $media = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Media')->findOneByIdItineraire($it->getIdItineraire());
                    if (!is_null($media)) {
                        $it->setAttachement($media);
                    } else {
                        $it->setImage("notexiste.bmp");
                    }
                    $note = 0;
                    $evaluation = $this->getDoctrine()->getManager()->getRepository('ClientBundle:Evaluation')->findByIdItineraire($it->getIdItineraire());
                    $noteTotal = 0;
                    if (!empty($evaluation)) {
                        foreach ($evaluation as $eva) {
                            $note = $note + $eva->getNote();
                        }
                        $noteTotal = $note / sizeof($evaluation);
                    } else {
                        $noteTotal = 0;
                        
                    }
                    $it->setNote($noteTotal);
                    
                   
                }
            } else {
                $itineraire = null;
                $evaluation = array();
            }
            if ($user->getType() == 'Gerant') {

                $parrainages = $em->getRepository('ClientBundle:Parrainage')->findByIdUtilisateur($user);
            } else {
                $parrainages = null;
            }

            $PO = array();
                $PP = array();
            if ($user->getType() == 'Client') {

                $em = $this->getDoctrine()->getManager();
                $request = $this->getRequest();
                $user = $this->getUser();
                //$user = $em->getRepository('ClientBundle:Utilisateur')->find($usr->getIdUtilisateur());
                $participations = $em->getRepository('ClientBundle:Participation')->findBy(array('idUtilisateur' => $user));
                $PO = array();
                $PP = array();

                foreach ($participations as $p) {

                    if ($p->getIdOffrep() != null) {
                        array_push($PO, $p);
                    } else {
                        array_push($PP, $p);
                    }
                }


                $size = sizeof($participations);
            }






            return $this->render('ClientBundle:Utilisateur:Compte.html.twig', array('offres' => $offres, 'rec' => $rec, 'itineraires' => $itineraire, 'nbr' => sizeof($evaluation), 'parrainages' => $parrainages, 'participations' => $PO, 'participationsp' => $PP));
        }
        return $this->redirect($this->generateUrl('login_user'));
    }

   public function ModifierAction() {
        $user = $this->getUser();
        $req = $this->getRequest();
        if ($req->getMethod() == 'POST') {
            $motDePasse = $req->get('motDePasse');
            $VmotDePasse = $req->get('VmotDePasse');
            $em = $this->getDoctrine()->getManager();
            $utilisateur = $em->getRepository('ClientBundle:Utilisateur')->find($user->getIdUtilisateur());
            if ($motDePasse == $VmotDePasse) {
                $utilisateur->setEmail($req->get('email'));
                $utilisateur->setMotDePasse($motDePasse);
                if($req->get('abbnewslettre')=="on")
                    $utilisateur->setAbbNewslettre(1);
                else
                    $utilisateur->setAbbNewslettre(0);
                $utilisateur->setFile($req->files->get('img'));
                if ($utilisateur->getType() == "Client") {
                    $utilisateur->setNom($req->get('nom'));
                    $utilisateur->setPrenom($req->get('prenom'));
                    $utilisateur->setDateNaissance(new \DateTime($req->get('dateNaissance')));
                    $utilisateur->setTelephone($req->get('telephone'));
                    $utilisateur->setSexe($req->get('sexe'));
                    
                } else {
                    $utilisateur->setNomAgence($req->get('nomAgence'));
                    $utilisateur->setAdresse($req->get('adresse'));
                }
                $em->persist($utilisateur);
                $em->flush();
            }
        }
        return $this->redirect($this->generateUrl('client_Compte'));
    }

    public function DesactiverAction($id) {
        $em = $this->getDoctrine()->getManager();
        $utilisateur = $em->getRepository('ClientBundle:Utilisateur')->find($id);
        $utilisateur->setEtatCompte(0);
        $em->persist($utilisateur);
        $em->flush();
        return $this->redirect($this->generateUrl('logout_user'));
    }

    public function AjouterAction() {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(new ClientForm(), $utilisateur);
        $request = $this->get('request');
        $form->handleRequest($request);
        if ($form->isValid()) {
            $VmotDePasse = $request->get('VmotDePasse');
            if ($VmotDePasse == $utilisateur->getMotDePasse()) {
                $em = $this->getDoctrine()->getManager();
                if ($utilisateur->getType() == "Client") {
                    $utilisateur->setDateNaissance(new \DateTime($request->get('dateNaissance')));
                    $utilisateur->setDateAjout(new \DateTime('now'));
                    $utilisateur->setEtatCompte(1);
                    $em->persist($utilisateur);
                } else {
                    $tmp = new Geranttmp();
                    $tmp->setEmail($utilisateur->getEmail());
                    $tmp->setMotDePasse($utilisateur->getMotDePasse());
                    $tmp->setNomAgence($utilisateur->getNomAgence());
                    $tmp->setAdresse($utilisateur->getAdresse());
                    $em->persist($tmp);
                }
                $em->flush();
                return $this->redirect($this->generateUrl('login_user'));
            }
        }
        return $this->render('ClientBundle:Utilisateur:Ajouter.html.twig', array('monform' => $form->createView()));
    }

}
