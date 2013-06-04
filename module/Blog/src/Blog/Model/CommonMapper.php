<?php

namespace Blog\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;

//use Blog\Model\Album;
use Blog\Model\Artist;
use Zend\Db\Sql;

//use Zend\Db\ResultSet\ResultSet;


class ArtistMapper extends AbstractTableGateway
{
    protected $table = 'artist';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;

//        $this->resultSetPrototype = new ResultSet();
//        $this->resultSetPrototype->setArrayObjectPrototype(new Album());
//        $this->resultSetPrototype->setArrayObjectPrototype(new Artist());

        $this->initialize();
    }

    public function SelectTable()
    {
        $select = new Sql\Select();
        return $select->from($this->table);
    }

//    public function statementExecute($select)
//    {
//        $statement = $this->adapter->createStatement();
//        $select->prepareStatement($this->adapter, $statement);
//        return $result = $statement->execute();
//    }

    public function getLastId()
    {
        $LastId = $this->executeSelect($this->SelectTable()->columns(array('id' => new Sql\Expression('COUNT(id)'))));
        return $LastId;
    }

    public function getColumnCount($column)
    {
        $count = iterator_to_array($this->executeSelect($this->SelectTable()
            ->columns(array($column => new Sql\Expression('COUNT(' . $column . ')')))));
//        $LastId = iterator_to_array($LastId);
//        var_dump($LastId[0]);
        return $count[0];
    }

// TODO: check Artist name in table

    public function saveArtist(Artist $artist)
    {
//       var_dump($artist);
        $data = array(
            'name' => $artist->getName(),
        );
//        var_dump($data);
        $this->insert($data);

    }
}

