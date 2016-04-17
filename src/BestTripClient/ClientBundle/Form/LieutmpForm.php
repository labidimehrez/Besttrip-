<?php

namespace BestTripClient\ClientBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class LieutmpForm extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('type', 'choice', array('choices' => array('Hotel' => 'Hotel', 'Restaurant' => 'Restaurant')))
                ->add('nom','text',array('attr' => array('class'=>"input-text full-width", 'style' => 'width: 300px;')))
        ;
    }

    /**
     * @return string
     */
    public function getName() {
        return 'besttripclient_clientbundle_lieutmp';
    }

}
