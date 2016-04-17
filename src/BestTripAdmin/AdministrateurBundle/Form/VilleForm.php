<?php

namespace BestTripAdmin\AdministrateurBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class VilleForm extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('idPays','entity',
                        array('attr' => array('class' => 'form-control', 'style' => 'width: 300px;'),
                            'class'=> 'AdministrateurBundle:Pays',
                            'property' => 'nom'))
                ->add('idVille','entity',
                        array('attr' => array('class' => 'form-control', 'style' => 'width: 300px;'),
                            'class'=> 'AdministrateurBundle:Ville',
                            'property' => 'nom'))              
             ;
    }

    public function getName() {
        return 'besttripadmin_administrateurbundle_lieu';
    }

}
