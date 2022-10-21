<?php
declare(strict_types = 1);

namespace App;

use Exception;
use FaaPz\PDO\Clause\Conditional;
use FaaPz\PDO\Database;

abstract class Repository {

    public $table = '';

    /** @var Database $db */
    public $db = '';

    public function __construct()
    {
        $this->db = Db::getConnection();
    }

    public function find(int $id) : array {
        return $this->db
        ->select()
        ->from($this->table)
        ->where(new Conditional("id", "=", $id))
        ->execute()
        ->fetch() ?: [];
    }

    public function findAll() : array {
        return $this->db
        ->select()
        ->from($this->table)
        ->execute()
        ->fetchAll() ?: [];
    }

    public function add(array $data = []) : void {
        unset($data['id']);
        unset($data['submit']);

        $insert = $this->db->insert(array_keys($data))
            ->into($this->table)
            ->values(...array_values($data));
        $insert->execute();
    }
    
    public function update(array $data = []) : void {
        if (!isset($data['id'])) {
            throw new Exception("Can't update, required id.");
        }

        $id = intval($data['id']);
        unset($data['id']);
        unset($data['submit']);

        $update = $this->db->update($data)
            ->table($this->table)
            ->where(new Conditional("id", "=", $id));
        $update->execute();
    }
    public function delete(int $id) : void {

        $delete = $this->db->delete()
        ->from($this->table)
        ->where(new \FaaPz\PDO\Clause\Conditional("id", "=", $id));

        $delete->execute();
    }
}