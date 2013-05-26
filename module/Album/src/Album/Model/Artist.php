<?php

namespace Album\Model;

//use Zend\Db\TableGateway\AbstractTableGateway,
//Zend\Db\Adapter\Adapter;

class Artist
{
    protected $id;
    protected $name;

    public function  __construct($data = array())
    {
        $this->populate($data);
    }

    public function populate($data)
    {
        if (array_key_exists('id', $data)) {
            $this->setId($data['id']);
        }
        if (array_key_exists('name', $data)) {
            $this->setName($data['name']);
        }
    }

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName()
        );
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
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