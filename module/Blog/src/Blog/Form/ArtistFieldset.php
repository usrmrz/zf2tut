<?php

namespace Blog\Form;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Blog\Model\Artist as ArtistEntity;

class ArtistFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('artist');
        $this->setHydrator(new ClassMethodsHydrator(false))->setObject(new ArtistEntity());

        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type' => 'text',
                'id' => 'artist_name',
                'class' => 'span4',
                'placeholder' => 'Артист',
            ),
            'options' => array(
                'label' => 'Artist',
            ),
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            'name' => array(
                'required' => true,
                'filters' => array(
                    array('name' => 'PregReplace',
                        'options' => array(
                            'pattern' => '/ {2,}/',
                            'replacement' => ' ',
                        )),
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim')),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                'isEmpty' => 'Поле должно быть заполнено',
                            ),
                        ),
                    ),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 2,
                            'max' => 100,
                            'messages' => array(
                                'stringLengthTooShort' => 'Имя автора должно быть не менее 2 символов!',
                                'stringLengthTooLong' => 'Имя автора должно быть не более 100 символов!'
                            ),
                        ),
                    ),
                ),
            ),
        );
    }
}