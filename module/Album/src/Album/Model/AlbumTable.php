<?php

namespace Album\Model;

use Zend\Db\Adapter\Adapter;
//use Zend\Db\Sql\Select;
//use Zend\Db\ResultSet\ResultSet;
//use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Sql;
use Album\Model\Album;
//use Zend\ServiceManager\ServiceManager;



//use Zend\Db\Sql\Where;
//use Zend\Db\Sql\Select;

class AlbumTable
    extends AbstractTableGateway
{
    protected $table = 'album';

//    protected $table = 'album';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;

//        $this->resultSetPrototype = new ResultSet();
//        $this->resultSetPrototype->setArrayObjectPrototype(new Album());
//        $this->resultSetPrototype->setArrayObjectPrototype(new Artist());

        $this->initialize();
    }

    public function fetchAll()
    {
        $sql = new Sql($this->adapter);
        $select = $sql->select()
            ->from($this->table)//->columns(array('id', 'title'))
            ->join('artist', 'album.artist_id = artist.id', array('artist_id' => 'id', 'name'), 'left')->order('album.id ASC');
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
        $rows = array_values(iterator_to_array($result));
//        echo $select->getSqlString();
//        echo var_dump($rows);
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
//        echo $select->getSqlString();
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        $row = array_values(iterator_to_array($result));

//        echo $select->getSqlString();
//        $result->current($result);
//        $result = $result->current();
//        if (!$result) {
//            throw new \Exception('Could not find row $id');
//        }
//        $row = array_values($result);
//        echo var_dump($row);
//        \Zend\Debug\Debug::dump($row);
        return  $row[0];
    }

    public function saveAlbum(Album $album)
    {

    }

    public function deleteAlbum($id)
    {
        $this->delete(array('id' => $id,));
    }
}