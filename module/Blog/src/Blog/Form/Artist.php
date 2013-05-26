<?php

namespace Blog\Form;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods;
use Blog\Model\Artist as ArtistEntity;

class Artist extends Fieldset
{
    public function __construct()
    {
        parent::__construct('artist');
        $this->setHydrator(new ClassMethods(false))->setObject(new ArtistEntity());

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));

        $this->add(array(
            'name' => 'name',
            'options' => array(
                'label' => 'Artist Name'
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));
    }
    public function getInputFilterSpecification()
    {
        return array(
            'name' => array(
                'required' => true,
            )
        );
    }
}