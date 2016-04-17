<?php

namespace BestTripAdmin\AdministrateurBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CompagnieForm extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nom', 'text', array('attr' => array('class' => 'form-control', 'style' => 'width: 300px;','id' => 'autocomplete','onFocus' => 'geolocate()')))
                ->add('type', 'choice', array('choices' => array('Aerienne' => 'Aerienne', 'Maritime' => 'Maritime'), 'attr' => array('class' => 'form-control', 'style' => 'width: 300px;')))
                ->add('file', 'file', array( 'required' => false, 'attr' => array('class'=>'filestyle', 'data-buttonBefore'=> "true", 'style' => 'width: 300px;')))
                ->add('lien', 'url', array('attr' => array('class' => 'form-control', 'style' => 'width: 300px;')))
                ->add('Envoyer', 'submit', array('attr' => array('class' => 'btn btn-primary', 'style' => 'width: 100px;')))
        ;
    }

    /**
     * @return string
     */
    public function getName() {
        return 'besttripadmin_administrateurbundle_compagnie';
    }

}
