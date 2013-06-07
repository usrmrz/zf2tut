<?php

namespace Blog\Form;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Blog\Model\Album as AlbumEntity;
use Zend\Filter\PregReplace;


class AlbumFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null)
    {
        parent::__construct('album');
        $this->setHydrator(new ClassMethodsHydrator(false))->setObject(new AlbumEntity());

        $this->add(array(
            'name' => 'title',
            'attributes' => array(
                'type' => 'text',
                'id' => 'album_title',
                'class' => 'span5',
                'placeholder' => 'Название',
//                'hint' => 'Поле обязательно для заполнения',
            ),
            'options' => array(
                'label' => 'Album',
//                'hint' => 'Hint',
//                'prependIcon' => 'icon-heart',
//                'appendIcon' => 'icon-glass',
            ),
        ));

        $this->add(array(
            'type' => 'Blog\Form\ArtistFieldset',
            'name' => 'artist',
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            'title' => array(
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
                                'stringLengthTooShort' => 'Название альбома должно быть не менее 2 символов!',
                                'stringLengthTooLong' => 'Название альбома должно быть не более 100 символов!'
                            ),
                        ),
                    ),
                ),
            ),
        );
    }
}