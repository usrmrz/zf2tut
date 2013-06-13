<?php

namespace Album\Form;

use Zend\Form\Form;

class AlbumForm extends Form
{
    public function __construct()
    {
        parent::__construct();

        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));

        $this->add(array(
            'name' => 'title',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Album Title',
            )
        ));

        $this->add(array(
            'name' => 'artist',
            'attributes' => array(
                'type' => 'text',
                'options' => array(
                    'label' => 'Artist Name'
                )
            )
        ));

        $this->add(array(
            'name' => 'submit',
            'attribute' => array(
                'type' => 'submit',
            ),
        ));

    }
}