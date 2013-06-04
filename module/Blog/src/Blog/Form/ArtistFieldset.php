<?php

namespace Blog\Form;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

//use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\ObjectProperty as ObjectPropertyHydrator;
use Blog\Model\Artist as ArtistEntity;

class ArtistFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('artist');
//        $this->setHydrator(new ClassMethods(false))->setObject(new ArtistEntity());
        $this->setHydrator(new ObjectPropertyHydrator())->setObject(new ArtistEntity());

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
//                'allow_empty' => true,
            ),
        ));

        $this->add(array(
            'name' => 'name',
            'options' => array(
                'label' => 'Artist Name'
            ),
//            'attributes' => array(
//                'required' => 'required',
//            )
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            'id' => array('required' => false,),
            'name' => array('required' => true,));
    }
}