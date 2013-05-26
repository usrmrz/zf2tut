<?php

namespace Blog\Form;

//use Zend\Form\Fieldset;
use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods;
//use Zend\Form\FormInterface;
//use Blog\Form\Album as AlbumEntity;

class AlbumForm extends Form
{
    public function __construct()
    {
        parent::__construct();

        $this->setAttribute('id', 'album_table');
        $this->setAttribute('method', 'post')
        ->setHydrator(new ClassMethods(false))
        ->setInputFilter(new InputFilter());

        $this->add(array(
            'type' => 'Blog\Form\Album',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));

//        $this->add(array(
//            'type' => 'Zend\Form\Element\Csrf',
//            'name' => 'csrf'
//        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Send'
            )
        ));
    }
}