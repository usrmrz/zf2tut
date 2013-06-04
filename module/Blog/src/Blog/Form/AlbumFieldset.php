<?php

namespace Blog\Form;

//use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
//use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\ObjectProperty as ObjectPropertyHydrator;
use Blog\Model\Album as AlbumEntity;


class AlbumFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('album');
//        $this->setHydrator(new ClassMethods(false))->setObject(new AlbumEntity());
        $this->setHydrator(new ObjectPropertyHydrator())->setObject(new AlbumEntity());

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
//                'allow_empty' => true,
            ),
        ));
//        $this->setLabel('Album');
        $this->add(array(
            'name' => 'title',
            'options' => array(
                'type' => 'text',
                'label' => 'Album Title',
            ),
//            'attributes' => array(
//                'required' => 'required'
//            )
        ));

        $this->add(array(
            'name' => 'artist_id',
            'attributes' => array(
                'type' => 'hidden',
//                'allow_empty' => true,
            ),
        ));

        $this->add(array(
            'type' => 'Blog\Form\Artist',
            'name' => 'artist',
            'options' => array(
                'label' => 'Name of Artist'
            ),

        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            'id' => array('required' => false,),
            'name' => array('required' => true,),
            'artist_id' => array('required' => false,),);
    }
}