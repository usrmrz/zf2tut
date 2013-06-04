<?php

namespace Blog\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql;
use Blog\Model\Artist;

use Zend\Db\ResultSet\ResultSet;


class ArtistMapper extends CommonMapper
{
    protected $table = 'artist';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->initialize();
    }

    public function getArtistIdByName($name){
        $select = $this->SelectTable()
            ->columns(array('id' => 'id', 'name' => 'name'))
            ->where(array('name' => $name));
//        $result = iterator_to_array($this->executeSelect($select));
        $statement = $this->adapter->createStatement();
        $select->prepareStatement($this->adapter, $statement);
        $result = iterator_to_array($statement->execute());
//        var_dump(array_count_values($result[0]));
//        var_dump($result[0]);
        return $result[0]['id'];
    }

    public function saveArtist(Artist $artist)
    {
        $data = array(
            'name' => $artist->getName(),
        );
//        var_dump($data);
        $select = new Sql\Select;
        $select->from($this->table)
            ->columns(array('name' => 'name'))
            ->where->like('name', $artist->getName());
        $statement = $this->adapter->createStatement();
//        var_dump($select);
        $select->prepareStatement($this->adapter, $statement);
        $result = iterator_to_array($statement->execute());
//        var_dump($result);
        if (!$result){
            $this->insert($data);
//            var_dump($data);
        }
    }
}

