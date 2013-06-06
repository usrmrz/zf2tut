<?php

namespace Blog\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql;


class AbstractMapper extends AbstractTableGateway
{
    protected $table;

    public function __construct(Adapter $adapter, $table = null)
    {
        $this->adapter = $adapter;
        $this->initialize();
    }

    protected function SelectTable()
    {
        return $select = new Sql\Select($this->table);
    }

    protected function joinArtistName()
    {
        return $this->SelectTable()
            ->join('artist', 'album.artist_id = artist.id', array('artist_id' => 'id', 'name'), 'left');
    }

    public function fetchAll($order)
    {
        return $rows = $this->executeSelect($this->joinArtistName()->order($order));
    }

    public function getColumnCount($column)
    {
        $count = iterator_to_array($this->executeSelect($this->SelectTable()
            ->columns(array($column => new Sql\Expression('COUNT(' . $column . ')')))));
        return $count[0][$column];
    }

    public function deleteEntity($column, $row)
    {
        $this->delete(array($column => $row));
    }

}

