<?php

namespace BestTripClient\ClientBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ClientForm extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('email','text',array('attr'=>array('class'=>'input-text full-width')))
                ->add('motDePasse','password',array('attr'=>array('class'=>'input-text full-width')))
                ->add('nom','text',array('attr'=>array('class'=>'input-text full-width')))
                ->add('prenom','text',array('attr'=>array('class'=>'input-text full-width')))
                ->add('telephone','number',array('attr'=>array('class'=>'input-text full-width')))
                ->add('sexe','choice', array('choices' => array ('M'=> 'Masculin','F'=>'Féminin'), 'expanded'  => true))
                ->add('type','choice', array('choices' => array ('Client'=> 'Client','Gerant'=>'Gerant')))
                ->add('nomAgence','text',array('attr'=>array('class'=>'input-text full-width')))
                ->add('adresse','text',array('attr'=>array('class'=>'input-text full-width')))
                ->add('abbNewslettre', 'checkbox')
                ->add('Enregistrer','submit',array('attr'=>array('class'=>'class="button btn-large green full-width"')));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'besttripclient_clientbundle_lieutmp';
    }

}
