<?php

namespace BestTripAdmin\AdministrateurBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use BestTripAdmin\AdministrateurBundle\Form\MediaForm;

class LieuForm extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nom', 'text', array('attr' => array('class' => 'form-control', 'style' => 'width: 300px;')))
                ->add('adresse', 'text', array('attr' => array('class' => 'form-control', 'style' => 'width: 300px;', 'placeholder'=>'Enter your address',
             'onFocus'=>'geolocate()')))           
                ->add('type','choice',array('choices'=>array('Hotel'=>'Hotel','Restaurant'=>'Restaurant'),'attr'=>array('class'=>'form-control', 'style' => 'width: 300px;')))
                ->add('attachement',new MediaForm())
                ->add('Envoyer', 'submit',array('attr' => array('class' => 'btn btn-primary', 'style' => 'width: 100px;')))
                
        ;
    }

    public function getName() {
        return 'besttripadmin_administrateurbundle_lieu';
    }

}
