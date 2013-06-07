<?php

namespace Blog\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;


class AlbumForm extends Form
{
    public function __construct()
    {
        parent::__construct();

        $this->setAttribute('method', 'post')
        ->setHydrator(new ClassMethodsHydrator(false))
        ->setInputFilter(new InputFilter());

        $this->add(array(
            'type' => 'Blog\Form\AlbumFieldset',
            'options' => array(
                'use_as_base_fieldset' => true,
            )
        ));

        $this->add(array(
            'name'       => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'class' => 'btn btn-success',
            )
        ));
    }
}