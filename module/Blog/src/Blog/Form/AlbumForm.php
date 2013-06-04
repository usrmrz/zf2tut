<?php

namespace Blog\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
//use Zend\InputFilter\Factory as InputFactory;

use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
//use Zend\Stdlib\Hydrator\ObjectProperty as ObjectPropertyHydrator;
//use Blog\Form\ArtistFieldset;

class AlbumForm extends Form
{
    public function __construct()
    {
        parent::__construct();

//        $this->setAttribute('id', 'album_form');
        $this->setAttribute('method', 'post')
        ->setHydrator(new ClassMethodsHydrator(false))
        ->setInputFilter(new InputFilter());
//        $hydrator = new ObjectPropertyHydrator();
//        $this->setHydrator($hydrator);

//        $this->add(array(
//            'name'       => 'title',
//            'attributes' => array(
//                'type'  => 'text',
//                'label' => 'Album Title',
//            ),
////            'attributes' => array(
////                'required' => 'required'
////            )
//        ));
        $this->add(array(
            'type' => 'Blog\Form\AlbumFieldset',
            'options' => array(
                'use_as_base_fieldset' => true,
            )
        ));

//        $artist = new ArtistFieldset('artist');
//        $this->add($artist->get('name'));

        $this->add(array(
            'name'       => 'submit',
            'attributes' => array(
                'type'  => 'submit',
//                'value' => 'Send',
                'class' => 'btn btn-success',
            )
        ));

//        $inputFilter = new InputFilter();
//        $factory = new InputFactory();

//        $inputFilter->add($factory->createInput(array(
//            'name'     => 'title',
//            'required' => true,
//            'filters'  => array(
//                array('name' => 'StripTags'),
//                array('name' => 'StringTrim'),
//            ),
//        )));

//        foreach($this->getFieldsets() as $fieldset){
//            $fieldsetInputFilter = $factory->createInputFilter($fieldset->getInputFilterSpecification());
//            $inputFilter->add($fieldsetInputFilter,$fieldset->getName());
//        }

        //Set InputFilter
//        $this->setInputFilter($inputFilter);

//        $this->add(array(
//            'type' => 'Blog\Form\ArtistFieldset',
//            'options' => array(
//                'use_as_base_fieldset' => true
//            )
//        ));

//        $this->add(array(
//            'type' => 'Zend\Form\Element\Csrf',
//            'name' => 'csrf'
//        ));


    }
}