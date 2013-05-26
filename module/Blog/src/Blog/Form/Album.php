<?php

namespace Blog\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods;
use Blog\Model\Album as AlbumEntity;
use Zend\Form\View\Helper\Form as HelperForm;

//use Blog\Form\Artist;

class Album extends Fieldset implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('album');
        $this->setHydrator(new ClassMethods(false))->setObject(new AlbumEntity());
//        echo var_dump($a);exit;

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
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
            'type' => 'Blog\Form\Artist',
            'name' => 'artist',
            'options' => array(
                'label' => 'Name of Artist'
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