<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SignalisationController
 *
 * @author marwen
 */

namespace BestTripAdmin\AdministrateurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \Symfony\Component\HttpFoundation\JsonResponse;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Zend\Json\Expr;

class StatistiqueController extends Controller {

    public function getAllAction() {
        $date = new \DateTime('now');
        $client = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:Utilisateur')->findBy(array('dateAjout' => $date, 'type' => "Client"));
        $gerant = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:Utilisateur')->findBy(array('dateAjout' => $date, 'type' => "Gerant"));
        $itineraire = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:Itineraire')->findBy(array('dateAjout' => $date));
        $recommandation = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:Recommandation')->findBy(array('dateAjout' => $date));

        $aCats = array('Client', 'Gerant', 'Itineraire', 'Recommandation');

        $aValRows[] = array('name' => $aCats[0], 'val' => sizeof($client));
        $aValRows[] = array('name' => $aCats[1], 'val' => sizeof($gerant));
        $aValRows[] = array('name' => $aCats[2], 'val' => sizeof($itineraire));
        $aValRows[] = array('name' => $aCats[3], 'val' => sizeof($recommandation));

        $a['categories'] = $aCats;
        $a['values'] = $aValRows;
        $aJson = new JsonResponse();
        return $aJson->setData($a);
    }

    public function chartAction() {

        $request = $this->get('request');
        $client = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:Utilisateur')->findBy(array('type' => "Client"));
        $gerant = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:Utilisateur')->findBy(array('type' => "Gerant"));
        $itineraire = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:Itineraire')->findAll();
        $recommandation = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:Recommandation')->findAll();
        /* var_dump(sizeof( $itineraire));
          var_dump($itineraire[2]);
          die(); */
        $nbrClient = 0;
        $nbrGerant = 0;
        $nbrItineraire = 0;
        $nbrRecommandation = 0;
        $name = null;
        $data = array();
        $cat = array();
        $ob = array();
        $erreur = array();

        if ($request->get('ch') != null && $request->get('dd') != null && $request->get('df') != null) {
            if ($request->get('ch') === "All") {


                foreach ($client as $c) {
                    if (strtotime($c->getDateAjout()->format('d-m-Y')) >= strtotime($request->get('dd')) && strtotime($c->getDateAjout()->format('d-m-Y')) <= strtotime($request->get('df'))) {
                        $nbrClient = $nbrClient + 1;
                    }
                }
                foreach ($gerant as $c) {
                    if (strtotime($c->getDateAjout()->format('d-m-Y')) >= strtotime($request->get('dd')) && strtotime($c->getDateAjout()->format('d-m-Y')) <= strtotime($request->get('df'))) {
                        $nbrGerant = $nbrGerant + 1;
                    }
                }
                foreach ($itineraire as $c) {
                    if (strtotime($c->getDateAjout()->format('d-m-Y')) >= strtotime($request->get('dd')) && strtotime($c->getDateAjout()->format('d-m-Y')) <= strtotime($request->get('df'))) {
                        $nbrItineraire = $nbrItineraire + 1;
                    }
                }
                foreach ($recommandation as $c) {
                    if (strtotime($c->getDateAjout()->format('d-m-Y')) >= strtotime($request->get('dd')) && strtotime($c->getDateAjout()->format('d-m-Y')) <= strtotime($request->get('df'))) {
                        $nbrRecommandation = $nbrRecommandation + 1;
                    }
                }
                $name = 'Stat Général';
                $data = array($nbrClient, $nbrGerant, $nbrItineraire, $nbrRecommandation);
                $cat = array('Client', 'Gerant', 'Itineraire', 'Recommandation');



                $series = array(
                    array(
                        'name' => $name,
                        'type' => 'column',
                        'color' => '#4572A7',
                        'yAxis' => 1,
                        'data' => $data,
                    )
                );

                $yData = array(
                    array(
                    ),
                    array(
                        'labels' => array(
                            'formatter' => new Expr('function () { return this.value}'),
                            'style' => array('color' => '#4572A7')
                        ),
                        'gridLineWidth' => 0,
                        'title' => array(
                            'text' => $name,
                            'style' => array('color' => '#4572A7')
                        ),
                    ),
                );
                $categories = $cat;
                $ob = new Highchart();
                $ob->chart->renderTo('container'); // The #id of the div where to render the chart
                $ob->chart->type('column');
                $ob->title->text('Statistique Général de ' . $request->get('dd') . ' au ' . $request->get('df'));
                $ob->xAxis->categories($categories);
                $ob->yAxis($yData);
                $ob->legend->enabled(false);
                $formatter = new Expr('function () {
 var unit = {
 "Stat Général": this.x
 }[this.series.name];
 return  "<b>" + this.y + "</b> " + unit + " ajoutées";
 }');
                $ob->tooltip->formatter($formatter);
                $ob->series($series);
                if ($nbrClient === 0) {
                    $erreur = array("err" => "Pas d'activitées durant cette période :" . $request->get('dd') . "/" . $request->get('df'));
                }
            }
            if ($request->get('ch') === "Client") {
                $cat = array();
                $data = array();
                
            
                
                for ($i = 0; $i < sizeof($client); $i++) {
                
              
                    if ((strtotime($client[$i]->getDateAjout()->format('Y-m-d')) >= strtotime($request->get('dd'))) && (strtotime($client[$i]->getDateAjout()->format('Y-m-d')) <= strtotime($request->get('df')))) {
                        if (!in_array($client[$i]->getDateAjout()->format('Y-m-d'), $cat)) {
                            array_push($cat, $client[$i]->getDateAjout()->format('Y-m-d'));
                            $nbrClient = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:Utilisateur')->findBy(array("type" => "Client", "dateAjout" => $client[$i]->getDateAjout()));
                            array_push($data, sizeof($nbrClient));
                        }
                    }
                }
                $name = 'Client';
                $series = array(
                    array(
                        'name' => $name,
                        'type' => 'spline',
                        'color' => '#4572A7',
                        'yAxis' => 1,
                        'data' => $data,
                    )
                );

                $yData = array(
                    array(
                    ),
                    array(
                        'labels' => array(
                            'formatter' => new Expr('function () { return this.value}'),
                            'style' => array('color' => '#4572A7')
                        ),
                        'gridLineWidth' => 0,
                        'title' => array(
                            'text' => $name,
                            'style' => array('color' => '#4572A7')
                        ),
                    ),
                );

                $formatter = new Expr('function () {
 var unit = {
 "Client": "client"
 }[this.series.name];
 return "En "+ this.x + ": <b>" + this.y + "</b> " + unit + " été ajoutées";
 }');
                $categories = $cat;
                $ob = new Highchart();
                $ob->chart->renderTo('container'); // The #id of the div where to render the chart
                $ob->chart->type('column');
                $ob->title->text('Nombre des clients en total de ' . $request->get('dd') . ' au ' . $request->get('df'));
                $ob->xAxis->categories($categories);
                $ob->yAxis($yData);
                $ob->legend->enabled(false);
                $ob->tooltip->formatter($formatter);
                $ob->series($series);
                if (empty($data)) {
                    $erreur = array("err" => "Pas de comptes clients ajoutés durant cette période :" . $request->get('dd') . "/" . $request->get('df'));
                }
            }
            if ($request->get('ch') === "Gerant") {
                $cat = array();
                $data = array();
                for ($i = 0; $i < sizeof($gerant); $i++) {
                    if (strtotime($gerant[$i]->getDateAjout()->format('d-m-Y')) >= strtotime($request->get('dd')) && strtotime($gerant[$i]->getDateAjout()->format('d-m-Y')) <= strtotime($request->get('df'))) {
                        if (!in_array($gerant[$i]->getDateAjout()->format('d-m-Y'), $cat)) {
                            array_push($cat, $gerant[$i]->getDateAjout()->format('d-m-Y'));
                            $nbrGerant = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:Utilisateur')->findBy(array("type" => "Gerant", "dateAjout" => $gerant[$i]->getDateAjout()));
                            array_push($data, sizeof($nbrGerant));
                        }
                    }
                }
                $name = 'Gérant';
                $series = array(
                    array(
                        'name' => $name,
                        'type' => 'spline',
                        'color' => '#4572A7',
                        'yAxis' => 1,
                        'data' => $data,
                    )
                );

                $yData = array(
                    array(
                    ),
                    array(
                        'labels' => array(
                            'formatter' => new Expr('function () { return this.value}'),
                            'style' => array('color' => '#4572A7')
                        ),
                        'gridLineWidth' => 0,
                        'title' => array(
                            'text' => $name,
                            'style' => array('color' => '#4572A7')
                        ),
                    ),
                );

                $formatter = new Expr('function () {
 var unit = {
 "Gérant": "gérant"
 }[this.series.name];
 return "En "+ this.x + ": <b>" + this.y + "</b> " + unit + " été ajoutées";
 }');
                $categories = $cat;
                $ob = new Highchart();
                $ob->chart->renderTo('container'); // The #id of the div where to render the chart
                $ob->chart->type('column');
                $ob->title->text('Nombre de gérants en total de ' . $request->get('dd') . ' au ' . $request->get('df'));
                $ob->xAxis->categories($categories);
                $ob->yAxis($yData);
                $ob->legend->enabled(false);
                $ob->tooltip->formatter($formatter);
                $ob->series($series);
                if (empty($data)) {
                    $erreur = array("err" => "Pas de comptes gérants ajoutés durant cette période :" . $request->get('dd') . "/" . $request->get('df'));
                }
            }
            if ($request->get('ch') === "Itineraire") {
                $cat = array();
                $data = array();

                for ($i = 0; $i < sizeof($itineraire); $i++) {
                    if (strtotime($itineraire[$i]->getDateAjout()->format('d-m-Y')) >= strtotime($request->get('dd')) && strtotime($itineraire[$i]->getDateAjout()->format('d-m-Y')) <= strtotime($request->get('df'))) {
                        if (!in_array($itineraire[$i]->getDateAjout()->format('d-m-Y'), $cat)) {
                            array_push($cat, $itineraire[$i]->getDateAjout()->format('d-m-Y'));
                            $nbrItineraire = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:Itineraire')->findByDateAjout($itineraire[$i]->getDateAjout());
                            array_push($data, sizeof($nbrItineraire));
                        }
                    }
                }

                $name = 'Itineraire';
                $series = array(
                    array(
                        'name' => $name,
                        'type' => 'spline',
                        'color' => '#4572A7',
                        'yAxis' => 1,
                        'data' => $data,
                    )
                );

                $yData = array(
                    array(
                    ),
                    array(
                        'labels' => array(
                            'formatter' => new Expr('function () { return this.value}'),
                            'style' => array('color' => '#4572A7')
                        ),
                        'gridLineWidth' => 0,
                        'title' => array(
                            'text' => $name,
                            'style' => array('color' => '#4572A7')
                        ),
                    ),
                );

                $formatter = new Expr('function () {
 var unit = {
 "Itineraire": "itineraire"
 }[this.series.name];
 return "En "+ this.x + ": <b>" + this.y + "</b> " + unit + " été ajoutées";
 }');
                $categories = $cat;
                $ob = new Highchart();
                $ob->chart->renderTo('container'); // The #id of the div where to render the chart
                $ob->chart->type('column');
                $ob->title->text('Nombre des itinéraires ajoutés en total de ' . $request->get('dd') . ' au ' . $request->get('df'));
                $ob->xAxis->categories($categories);
                $ob->yAxis($yData);
                $ob->legend->enabled(false);
                $ob->tooltip->formatter($formatter);
                $ob->series($series);
                if (empty($data)) {
                    $erreur = array("err" => "Pas d'itinéraires ajoutés durant cette période :" . $request->get('dd') . "/" . $request->get('df'));
                }
            }
            if ($request->get('ch') === "Recommandation") {
                $cat = array();
                $data = array();

                for ($i = 0; $i < sizeof($recommandation); $i++) {
                    if (strtotime($recommandation[$i]->getDateAjout()->format('d-m-Y')) >= strtotime($request->get('dd')) && strtotime($recommandation[$i]->getDateAjout()->format('d-m-Y')) <= strtotime($request->get('df'))) {
                        if (!in_array($recommandation[$i]->getDateAjout()->format('d-m-Y'), $cat)) {
                            array_push($cat, $itineraire[$i]->getDateAjout()->format('d-m-Y'));
                            $nbrRecommandation = $this->getDoctrine()->getManager()->getRepository('AdministrateurBundle:recommandation')->findByDateAjout($recommandation[$i]->getDateAjout());
                            array_push($data, sizeof($nbrRecommandation));
                        }
                    }
                }

                $name = 'Recommandation';
                $series = array(
                    array(
                        'name' => $name,
                        'type' => 'spline',
                        'color' => '#4572A7',
                        'yAxis' => 1,
                        'data' => $data,
                    )
                );

                $yData = array(
                    array(
                    ),
                    array(
                        'labels' => array(
                            'formatter' => new Expr('function () { return this.value}'),
                            'style' => array('color' => '#4572A7')
                        ),
                        'gridLineWidth' => 0,
                        'title' => array(
                            'text' => $name,
                            'style' => array('color' => '#4572A7')
                        ),
                    ),
                );

                $formatter = new Expr('function () {
 var unit = {
 "Recommandation": "recommandations"
 }[this.series.name];
 return "En "+ this.x + ": <b>" + this.y + "</b> " + unit + " été ajoutées";
 }');
                $categories = $cat;
                $ob = new Highchart();
                $ob->chart->renderTo('container'); // The #id of the div where to render the chart
                $ob->chart->type('column');
                $ob->title->text('Nombre des recommandations ajoutées en total de ' . $request->get('dd') . ' au ' . $request->get('df'));
                $ob->xAxis->categories($categories);
                $ob->yAxis($yData);
                $ob->legend->enabled(false);
                $ob->tooltip->formatter($formatter);
                $ob->series($series);
                if (empty($data)) {
                    $erreur = array("err" => "Pas de recomandations ajoutées durant cette période :" . $request->get('dd') . "/" . $request->get('df'));
                }
            }
        }

        /* foreach ($client as $c ) {
          var_dump($c->getDateAjout());
          echo $c->getDateAjout()->format('d-m-Y');
          }

          die(); */

        return $this->render('AdministrateurBundle:Statistique:statistique.html.twig', array(
                    'chart' => $ob, 'error' => $erreur
        ));
    }

}
