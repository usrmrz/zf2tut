<?php

namespace Blog\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Blog\Model\Album;

//use Zend\Db\Sql\Expression;

//use Blog\Model\Artist;
use Zend\Db\Sql;

//use Zend\Db\ResultSet\ResultSet;


class AlbumMapper extends AbstractTableGateway
{
    protected $table = 'album';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;

//        $this->resultSetPrototype = new ResultSet();
//        $this->resultSetPrototype->setArrayObjectPrototype(new Album());
//        $this->resultSetPrototype->setArrayObjectPrototype(new Artist());

        $this->initialize();
    }

    private function SelectTable()
    {
        $select = new Sql\Select();
        return $select->from($this->table);
    }

    public function UpdateTable($table)
    {
        $update = new Sql\Update();
        return $select->from($table);
    }

    protected function joinArtistName()
    {
        return $this->SelectTable()->join('artist', 'album.artist_id = artist.id', array('artist_id' => 'id', 'name'), 'left');
    }


    public function getColumnCount($column)
    {
        $count = iterator_to_array($this->executeSelect($this->SelectTable()
            ->columns(array($column => new Sql\Expression('COUNT(' . $column . ')')))));
//        $LastId = iterator_to_array($LastId);
//        var_dump($LastId[0]);
        return $count[0];
    }

    public function fetchAll()
    {
//        $select = $this->getSql()->select();
//        $where  = $this->getWhere()
//            ->equalTo('author_id', $campaign->getId())
//            ->between(new DbExpression('NOW()'), 'start_date', 'end_date');
//
//        $select->from('funding_round')
//            ->columns(
//            array(
//                'funding_round_id',
//                'campaign_id',
//                'start_date',
//                'end_date',
//                'pledge_goal',
//                'created',
//            )
//        )
//            ->where($where);
//        $sql = new Sql($this->adapter);
//        $select = $sql->select()
//            ->from($this->table)//->columns(array('id', 'title'))
//            ->join('artist', 'album.artist_id = artist.id', array('artist_id' => 'id', 'name'), 'left')->order('album.id ASC');
//        $statement = $sql->prepareStatementForSqlObject($select);
//        $result = $statement->execute();
//        $rows = array_values(iterator_to_array($result));
//        echo $select->getSqlString();
//        return $rows;
//        $where =  array();
//        $select = new Select();
//        $select->from($this->table)
//            ->join('artist', 'album.artist_id = artist.id', array('artist_id' => 'id', 'name'), 'left')
//            ->where(array('artist.id' => $id));
//        $select = $this->getSelectFromTable()
//            ->join('artist', 'album.artist_id = artist.id', array('artist_id' => 'id', 'name'), 'left')
//            ->order('album.id ASC');
//        var_dump($select);
//        $rows = $this->statementExecute($select);
        return $rows = $this->executeSelect($this->joinArtistName() //SelectTable()->joinArtistName()
//            ->join('artist', 'album.artist_id = artist.id', array('artist_id' => 'id', 'name'), 'left')
            ->order('album.id ASC'));

//        $resultset = new ResultSet();
//        $resultset->getArrayObjectPrototype($rows);
//        echo var_dump($rows);
//        foreach ($resultset as $row) {
//
//        }

//        $statement = $this->adapter->createStatement();
//        $select->prepareStatement($this->adapter, $statement);
//        echo $select->getSqlString();
//        $result = $statement->execute();
//        $rows = array_values(iterator_to_array($result));
//        $resultset = new ResultSet();
//        $resultset->selectWith($select);
//        $this->selectWith($result);//$resultset->setDataSource($result);
//        echo var_dump($resultset);exit;

//        return $rows = $this->getArrayCopy($result);
//        var_dump($rows);
//        return $rows;
    }

    public function saveAlbum($data)
    {
//        $data = array(
//            'title' => $title->getTitle(),
//            'artist' => $artist->getName()
//        );
        var_dump($data);
    }

    public function findAllAlbumsOfArtist($artist_id)
    {
        $select = $this->getAlbumsWithArtists()->where(array('artist.id' => $artist_id));
        $rows = $this->statementExecute($select);

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