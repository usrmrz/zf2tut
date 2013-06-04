<?php

namespace Blog\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql;



class CommonMapper extends AbstractTableGateway
{
    protected $table;

    public function __construct(Adapter $adapter, $table = null)
    {
        $this->adapter = $adapter;
        $this->initialize();
    }

    protected function SelectTable()
    {
        $table = $this->table;
        return $select = new Sql\Select($table);
//        return $select->from($table);
    }

    public function getColumnCount($column)
    {
        $count = iterator_to_array($this->executeSelect($this->SelectTable()
            ->columns(array($column => new Sql\Expression('COUNT(' . $column . ')')))));
        return $count[0][$column];
    }


}

