<?php

namespace Album\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
//use Album\Model\Album;


class AlbumTable extends AbstractTableGateway
{
    protected $table = 'album';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->getArrayObjectPrototype(new Album());
    }

    public function fetchAll()
    {
        $resultSet = $this->select();
//        var_dump($resultSet);
        return $resultSet;
    }

    public function getAlbum($id)
    {
        $id = (int)$id;
        $rowset = $this->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Couldn\'t find row $id");
        }
        return $row;
    }

    public function saveAlbum(Album $album)
    {
        $data = array(
            'title' => $album->title,
            'artist' => $album->artist,
        );

        $id = (int)$album->id;
        if ($id == 0) {
            $this->insert($data);
        } else {
            if ($this->getAlbum($id)) {
                $this->update($data, array('id' => $id));
            } else {
                throw new \Exception("Form $id doesn\'t exist");
            }
        }
    }

    public function deleteAlbum($id)
    {
        $this->delete(array('id' => $id));
    }
}