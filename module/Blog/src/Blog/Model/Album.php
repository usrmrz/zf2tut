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
    protected $artist;

//    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->title = (isset($data['title'])) ? $data['title'] : null;
        $this->artist = (isset($data['artist_id'])) ? $data['artist_id'] : null;
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

    public function getArtist()
    {
        return $this->artist;
    }

    public function setArtist($artist){
        $this->artist = $artist;
        return $this;
    }
}