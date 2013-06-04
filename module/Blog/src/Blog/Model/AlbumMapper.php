<?php

namespace Blog\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql;
use Blog\Model\Album;

class AlbumMapper extends CommonMapper
{
    protected $table = 'album';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->initialize();
    }

//    public function UpdateTable($table)
//    {
//        $update = new Sql\Update();
//        return $select->from($table);
//    }

    protected function joinArtistName()
    {
        return $this->SelectTable()
            ->join('artist', 'album.artist_id = artist.id', array('artist_id' => 'id', 'name'), 'left');
    }

    public function fetchAll()
    {
        return $rows = $this->executeSelect($this->joinArtistName()->order('album.id ASC'));
    }

    public function findAlbumByTitle($title)
    {
        $select = new Sql\Select;
        $select->from($this->table)
            ->columns(array('title' => 'title'))
            ->where->like('title', $title);
        $statement = $this->adapter->createStatement();
        $select->prepareStatement($this->adapter, $statement);
        $result = iterator_to_array($statement->execute());

        return $result;
    }

    public function findArtistIdByTitle($title)
    {
        $select = $this->SelectTable()
            ->columns(array('artist_id' => 'artist_id'))
            ->where(array('title' => $title));
        $result = iterator_to_array($this->executeSelect($select));
        $values = array();
        foreach ($result as $value){
            $values[] = $value['artist_id'];
        }
        return $values;

    }

    public function saveAlbum($album)
    {
        $data = array(
            'title'     => $album->getTitle(),
            'artist_id' => $album->getArtistId(),
        );
//        var_dump($data);
        $result = $this->findAlbumByTitle($data['title']);

        if (!$result) {
            $this->insert($data);
        } else {
            $result = $this->findArtistIdByTitle($data['title']);
//            var_dump($data);
            if ($result) {
                $artist_id = $album->getArtistId();
//                var_dump($artist_id);
                $dif = (in_array($artist_id, $result));

//                var_dump($dif);

                if (!$dif) {
                    $this->insert($data);
                }

            }
        }

    }

    public function getAlbum($id)
    {
        $id = (int)$id;
        $sql = new Sql($this->adapter);
        $select = $sql->select()
            ->from($this->table)//->columns(array('id', 'title'))
            ->join('artist', 'album.artist_id = artist.id', array('artist_id' => 'id', 'name'), 'left')->where(array('album.id' => $id));
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
        $row = array_values(iterator_to_array($result));
//        $rows = new ResultSet($result);
//        $resultSet = $this->selectWith($select);
//        return $resultSet;
//        echo var_dump($row);exit;
//        echo $select->getSqlString();
        if (!$row) {
            throw new \Exception('Could not find row $id');
        }
        return $row;

    }
}