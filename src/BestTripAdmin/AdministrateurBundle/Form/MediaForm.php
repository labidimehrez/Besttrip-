<?php

namespace BestTripAdmin\AdministrateurBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class MediaForm extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('file', 'file',array('attr' => array('multiple'=>'multiple', 'accept'=>'image/*', 'class'=>'hide')))
                
        ;
    }

    public function getName() {
        return 'besttripadmin_administrateurbundle_lieu';
    }

}
