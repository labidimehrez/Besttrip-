<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OffrePersonnelleForm
 *
 * @author wissal
 */

namespace BestTripClient\ClientBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class OffrePersonnelleForm extends AbstractType {

    public function getName() {
        return 'OffrePersonnelle';
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
        ->add('dateDebut','date')
        ->add('dateFin','date')
        ->add('description','textarea',array('attr'=>array('class'=>'input-text','rows'=>"6",'class'=>"input-text", 'placeholder'=>"Décrire ...", 'style' => 'width: 300px;')))
        ->add('prix','integer',array('attr'=>array('class'=>'input-text', 'style' => 'width: 300px;')))
        ->add('contact','text',array('attr'=>array('class'=>'input-text', 'style' => 'width: 300px;')))
        ->add('titre','text',array('attr'=>array('class'=>'input-text', 'style' => 'width: 300px;')))
        ->add('devise','choice',array('choices'=>array('DTN'=>'DTN','EUR'=>'EUR')))
        ->add('Valider', 'submit', array('attr' => array('class' => 'btn btn-primary', 'style' => 'width: 100px;')));
    }

//put your code here
}
