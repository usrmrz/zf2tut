<?php

namespace Blog\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;

use Zend\Db\Sql\Sql;
//use Zend\Db\ResultSet\ResultSet;
use Blog\Model\Album;


//use Zend\Db\Sql\Where;
//use Zend\Db\Sql\Select;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\ResultSet;


class AlbumMapper extends AbstractTableGateway
{
    protected $table = 'album';

//    protected $table = 'album';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;

        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Album());
//        $this->resultSetPrototype->setArrayObjectPrototype(new Artist());

        $this->initialize();
    }

    public function fetchAll()
    {
//        $sql = new Sql($this->adapter);
//        $select = $sql->select()
//            ->from($this->table)//->columns(array('id', 'title'))
//            ->join('artist', 'album.artist_id = artist.id', array('artist_id' => 'id', 'name'), 'left')->order('album.id ASC');
//        $statement = $sql->prepareStatementForSqlObject($select);
//        $result = $statement->execute();
//        $rows = array_values(iterator_to_array($result));
//        echo $select->getSqlString();
//        return $rows;

        $select = new Select();
        $select->from($this->table)
            ->join('artist', 'album.artist_id = artist.id', array('artist_id' => 'id', 'name'), 'left')
            ->order('album.id ASC');

        $statement = $this->adapter->createStatement();
        $select->prepareStatement($this->adapter, $statement);

        $result = $statement->execute();
        $rows = array_values(iterator_to_array($result));
//        $resultset = new ResultSet();
//        $resultset->selectWith($select);
//        $this->selectWith($result);//$resultset->setDataSource($result);
//        echo var_dump($resultset);exit;


       return $rows;
    }

    public function findByIdAndJoinName($artist_id)
    {

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
        echo $select->getSqlString();
        if (!$row) {
            throw new \Exception('Could not find row $id');
        }
        return $row;

    }
}