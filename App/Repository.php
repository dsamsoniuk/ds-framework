<?php


namespace App;

use FaaPz\PDO\Clause\Conditional;
use LogicException;

abstract class Repository {

    public function __get($key)
    {
        if ($key === "table" )  {
            throw new LogicException("Child class ".get_called_class().', failed to get property table.');
        }
        return '';
    }

    public function find(int $id) : array {
        $db = Db::getConnection();
        return $db
        ->select()
        ->from($this->table)
        ->where(new Conditional("id", "=", $id))
        ->execute()
        ->fetch();
    }

    public function findAll() : array {
        $db = Db::getConnection();
        return $db
        ->select()
        ->from($this->table)
        ->execute()
        ->fetchAll();
    }
}