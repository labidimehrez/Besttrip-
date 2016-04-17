<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OffreProfessionnelle
 *
 * @author wissal
 */

namespace BestTripClient\ClientBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class OffreProfessionnelleForm extends AbstractType {

    public function getName() {
        return 'OffreProfessionnelleClient';
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('dateDebut', 'date')
                ->add('dateFin', 'date')
                ->add('description', 'textarea', array('attr' => array('class' => 'ckeditor', 'rows' => "10", 'class' => "ckeditor", 'placeholder' => "Décrire ...", 'style' => 'width: 300px;')))
                ->add('prix', 'integer', array('attr' => array('class' => 'input-text', 'style' => 'width: 300px;')))
                ->add('nbMax', 'integer', array('attr' => array('class' => 'input-text', 'style' => 'width: 300px;')))
                ->add('titre', 'text', array('attr' => array('class' => 'input-text', 'style' => 'width: 300px;')))
                ->add('devise', 'choice', array('choices' => array('DTN' => 'DTN', 'EUR' => 'EUR')))
                ->add('file', 'file', array( 'required' => false, 'attr' => array('class'=>'filestyle', 'data-buttonBefore'=> "true", 'style' => 'width: 300px;')))
                ->add('type', 'choice', array('choices' => array('sejour' => 'sejour', 'croisiere' => 'croisiere')))
                ->add('Valider', 'submit', array('attr' => array('class' => 'btn btn-primary', 'style' => 'width: 100px;')));
    }

//put your code here
}
