<?php

namespace Blog\Model;

use Zend\Db\Adapter\Adapter;

//use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql;
use Blog\Model\Album;

class AlbumMapper extends AbstractMapper
{
    protected $table = 'album';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->initialize();
    }

    public function fetchAllBy($order = null)
    {
        switch ($order) {
            case 'DESC':
                return $result = $this->fetchAll('album.id DESC');
                break;
            default:
                return $result = $this->fetchAll('album.id ASC');
                break;
        }
//        return $result = $this->fetchAll('album.id ASC');
    }

    public function findAlbumByTitle($title)
    {
        $select = $this->SelectTable()->columns(array('title' => 'title'));
        $select->where->like('title', $title);
        $result = iterator_to_array($this->executeSelect($select));
        return $result;
    }

    public function findArtistId($artist_id)
    {
        $select = $this->SelectTable()->columns(array('artist_id' => 'artist_id'));
        $select->where->like('artist_id', $artist_id);
        $result = iterator_to_array($this->executeSelect($select));
        return $result;
    }

    public function findArtistIdByTitle($title)
    {
        $result = iterator_to_array($this->executeSelect($this->SelectTable()
            ->columns(array('artist_id'))
            ->where(array('title' => $title))));

        $values = array();
        foreach ($result as $value) {
            $values[] = $value['artist_id'];
        }
        return $values;
    }

    public function saveAlbum($album)
    {
        $data = array(
            'title' => $album->getTitle(),
            'artist_id' => $album->getArtistId(),
        );
        $result = $this->findAlbumByTitle($data['title']);
        if (!$result) {
            $this->insert($data);
        } else {
            $result = $this->findArtistIdByTitle($data['title']);
            if ($result) {
                $artist_id = $album->getArtistId();
                $isFind = (in_array($artist_id, $result));
                if (!$isFind) {
                    $this->insert($data);
                }
            }
        }
    }

    public function updateAlbum($album)
    {
        $data = array(
            'id' => $album->getId(),
            'title' => $album->getTitle(),
            'artist_id' => $album->getArtistId(),
        );
        $update = $this->updateTable();
        $update->set($data);
        $update->where(array('id' => $data['id']));
        $this->executeUpdate($update);

//        $upd = $this->updateTable()->where(array('id' => $data['id']));
//        $this->executeUpdate($upd);
//            $this->update($data);
    }

    public function getAlbum($id)
    {
        $id = (int)$id;
//        $select = $this->joinArtistName()
//            ->where(array('album.id' => $id));
        $row = iterator_to_array($this->executeSelect($this->joinArtistName()
            ->where(array('album.id' => $id))));
        if (!$row) {
            throw new \Exception('Could not find row $id');
        }
//        var_dump($row[0]);
        return $row[0];

    }

    public function getArtistId($id)
    {
        $id = (int)$id;
//        $select = $this->SelectTable()
//            ->where(array('album.id' => $id));
        $result = iterator_to_array($this->executeSelect($this->SelectTable()
            ->where(array('album.id' => $id))));
//        var_dump($result);
        return $result[0]['artist_id'];
    }

    public function getArtistCount($artist_id)
    {
        $select = $this->SelectTable()->columns(array('album.artist_id' => new Sql\Expression('COUNT(artist_id)')));
        $select->where(array('artist_id' => $artist_id));
        $result = iterator_to_array($this->executeSelect($select));
        return $result[0]['album.artist_id'];
    }
}