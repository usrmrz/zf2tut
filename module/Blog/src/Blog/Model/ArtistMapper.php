<?php

namespace Blog\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql;
use Blog\Model\Artist;

use Zend\Db\ResultSet\ResultSet;


class ArtistMapper extends AbstractMapper
{
    protected $table = 'artist';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->initialize();
    }

    public function getArtistIdByName($name)
    {
        $select = $this->SelectTable()->columns(array('id' => 'id', 'name' => 'name'));
        $result = iterator_to_array($this->executeSelect($select->where(array('name' => $name))));
        return $result[0]['id'];
    }

//    Old realisation |:-)
    public function saveArtist_old(Artist $artist)
    {
        $data = array(
            'name' => $artist->getName(),
        );
        $select = new Sql\Select;
        $select->from($this->table)
            ->columns(array('name' => 'name'))
            ->where->like('name', $artist->getName());
        $statement = $this->adapter->createStatement();
        $select->prepareStatement($this->adapter, $statement);
        $result = iterator_to_array($statement->execute());
        if (!$result) {
            $this->insert($data);
        }
    }

    public function findArtistByName($name)
    {
        $select = $this->SelectTable()->columns(array('id' => 'id', 'name'));
        $select->where->like('name', $name);
        $result = iterator_to_array($this->executeSelect($select));
        return $result[0];
    }

    public function saveArtist(Artist $artist)
    {
        $data = array(
            'name' => $artist->getName(),
        );
        $select = $this->SelectTable()->columns(array('name' => 'name'));
        $select->where->like('name', $artist->getName());
        $result = iterator_to_array($this->executeSelect($select));
        if (!$result) {
            $this->insert($data);
        }
    }

    public function updateArtist_old($artist){
//        var_dump($artist);
        $id = (int)$artist->getId();
        $name = $artist->getName();


        $this->updateTable()//->columns(array('name' => $name))
            ->where(array('id' => $id));
    }

    public function updateArtist($artist){
        $data = array(
            'id' => $artist->getId(),
            'name' => $artist->getName(),
//            'artist_id' => $artist->getArtistId(),
        );
        $update = $this->updateTable();
        $update->set($data);
        $update->where(array('id' => $data['id']));
        $this->executeUpdate($update);

//        $upd = $this->updateTable()->where(array('id' => $data['id']));
//        $this->executeUpdate($upd);
//            $this->update($data);
    }
}

