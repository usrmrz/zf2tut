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
            'name'       => 'name',
            'attributes' => array(
                'type'    => 'text',
                'id'      => 'artist_name',
            ),
            'options'    => array(
                'label' => 'Artist',
            ),
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            'name' => array(
                'required'   => true,
                'filters'    => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                'isEmpty' => 'Поле должно быть заполнено',
                            ),
                        ),
                    ),
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 2,
                            'max'      => 100,
                            'messages' => array(
                                'stringLengthTooShort' => 'Введите имя автора от 2 до 100 символов!',
                                'stringLengthTooLong'  => 'Введите имя автора от 2 до 100 символов!'
                            ),
                        ),
                    ),
                ),
            ),
        );
    }
}