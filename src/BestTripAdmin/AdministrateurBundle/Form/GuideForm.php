<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GuideForm
 *
 * @author wissal
 */

namespace BestTripAdmin\AdministrateurBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class GuideForm extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                
                ->add('titre', 'text', array('attr' => array('class' => 'form-control', 'style' => 'width: 300px;')))
                ->add('description', 'text', array('attr' => array('class' => 'form-control', 'style' => 'width: 300px;')))
                ->add('Envoyer', 'submit', array('attr' => array('class' => 'btn btn-primary', 'style' => 'width: 100px;')))
                ->add('file','file', array( 'required' => false))
        ;
    }

    public function getName() {
        return 'besttripadmin_administrateurbundle_guide';
    }

//put your code here
}
