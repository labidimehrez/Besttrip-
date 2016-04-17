<?php

namespace BestTripClient\ClientBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RecommandationForm extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('description', 'textarea', array('attr' => array('class' => "input-text full-width", 'style' => 'width: 300px;', 'rows' => '5')))
                ->add('titre', 'text', array('attr' => array('class' => "input-text full-width", 'style' => 'width: 300px;')))
                ->add('Envoyer', 'submit')
        ;
    }

    /**
     * @return string
     */
    public function getName() {
        return 'besttripclient_clientbundle_recommandation';
    }

}
