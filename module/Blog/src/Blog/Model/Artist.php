<?php

namespace Blog\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Artist
{
    public $id;
    public $name;
//    protected $inputFilter;

//    public function exchangeArray($data)
//    {
//        $this->id = (isset($data['id'])) ? $data['id'] : null;
//        $this->name = (isset($data['name'])) ? $data['name'] : null;
//    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = (int)$id;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}