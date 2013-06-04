<?php

namespace Blog\Form;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Blog\Model\Album as AlbumEntity;


class AlbumFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null)
    {
        parent::__construct('album');
        $this->setHydrator(new ClassMethodsHydrator(false))->setObject(new AlbumEntity());

        $this->add(array(
            'name'       => 'title',
            'attributes' => array(
                'type'    => 'text',
                'id'      => 'album_title',
            ),
            'options'    => array(
                'label' => 'Album',
            ),
        ));

        $this->add(array(
            'type'    => 'Blog\Form\ArtistFieldset',
            'name'    => 'artist',
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            'title' => array(
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
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 2,
                            'max' => 100,
                            'messages' => array(
                                'stringLengthTooShort' => 'Введите название альбома от 2 до 100 символов!',
                                'stringLengthTooLong' => 'Введите название альбома от 2 до 100 символов!'
                            ),
                        ),
                    ),
                ),
            ),
        );
    }
}