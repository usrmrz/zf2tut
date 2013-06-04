<?php

namespace Blog\Model;

//use Zend\InputFilter\Factory as InputFactory;
//use Zend\InputFilter\InputFilter;
//use Zend\InputFilter\InputFilterAwareInterface;
//use Zend\InputFilter\InputFilterInterface;

class Album
{
    protected $id;
    protected $title;
    protected $artist_id;
    protected $artist;
//    protected $inputFilter;

    public function __construct(){
        $this->artist = new Artist();
    }

    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->title = (isset($data['title'])) ? $data['title'] : null;
        $this->artist_id = (isset($data['artist_id'])) ? $data['artist_id'] : null;
    }

    public function getArrayCopy(){
        return get_object_vars($this);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = (int)$id;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getArtistId()
    {
        return $this->artist_id;
    }

    public function setArtistId($artist_id)
    {
        $this->artist_id = $artist_id;
        return $this;
    }

    public function getArtist()
    {
        return $this->artist;
    }

    public function setArtist(Artist $artist){
        $this->artist = $artist;
//        $this->artist->setName($name);
        return $this;
    }
}