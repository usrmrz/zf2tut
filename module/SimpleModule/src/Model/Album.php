<?php

namespace SimpleModule\Model;

//use Zend\Db\TableGateway\AbstractTableGateway,
//Zend\Db\Adapter\Adapter;

class Album
{
    protected $id;
    protected $title;
    protected $artist_id;

    public function  __construct($data = array())
    {
        $this->populate($data);
    }

    public function populate($data){
        if(array_key_exists('id', $data)){
            $this->setId($data['id']);
        }
        if(array_key_exists('title', $data)){
            $this->setName($data['title']);
        }
        if(array_key_exists('artist_id', $data)){
            $this->setName($data['artist_id']);
        }
    }

    public function getArrayCopy(){
        return array(
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'artist_id' => $this->getArtistId()
        );
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title){
        $this->title = $title;
        return $this;
    }

    public function getArtistId()
    {
        return $this->artist_id;
    }

    public function setArtistId($artist_id){
        $this->artist_id = $artist_id;
        return $this;
    }
}