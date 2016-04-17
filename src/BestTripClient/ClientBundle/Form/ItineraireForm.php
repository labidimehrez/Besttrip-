<?php

namespace BestTripClient\ClientBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use \BestTripClient\ClientBundle\Form\MediaForm;

class ItineraireForm extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('titre','text',array('attr'=>array('class'=>'input-text full-width')))
                ->add('description','textarea',array('attr'=>array('class'=>'input-text full-width','rows'=>"6",'class'=>"input-text full-width", 'placeholder'=>"Décrire ...")))
                ->add('dateDebut','date')
                ->add('dateFin','date')
                ->add('depense')
                ->add('attachement',new MediaForm())
                ->add('video','text',array('attr'=>array('class'=>'input-text full-width', "placeholder"=>"Exemple: https://www.youtube.com/watch?v=4Vij9O5PkLE")))
                ->add('Envoyer histoire','submit',array('attr'=>array('class'=>'class="button btn-large yellow full-width"')))
                ;
    }

    /**
     * @return string
     */
    public function getName() {
        return 'besttripclient_clientbundle_lieutmp';
    }

}
