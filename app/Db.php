<?php


namespace App;

use FaaPz\PDO\Database;

class Db {
    public static function getDatabase(){
        $dsn = 'mysql:host=localhost;dbname=jan;charset=utf8';
        $usr = 'damian';
        $pwd = 'damian';
        $db = new Database($dsn, $usr, $pwd);
    }
}

// SELECT
// $db = $this->getDatabase();
// $selectStatement = $db->select()->from('account')
// ->where(new Conditional("acct_num", ">", 1))->execute()->fetchAll();

// $stmt = $selectStatement->execute();
// $data = $stmt->fetch();

// // INSERT INTO users ( id , usr , pwd ) VALUES ( ? , ? , ? )
// $insertStatement = $pdo->insert(array(
//                            "id" =>1234,
//                            "usr" => "your_username",
//                            "pwd" => "your_password"
//                        ))
//                        ->into("users");

// $insertId = $insertStatement->execute();

// // UPDATE users SET pwd = ? WHERE id = ?
// $updateStatement = $pdo->update(array("pwd" => "your_new_password"))
//                        ->table("users")
//                        ->where(new Clause\Conditional("id", "=", 1234));

// $affectedRows = $updateStatement->execute();

// // DELETE FROM users WHERE id = ?
// $deleteStatement = $pdo->delete()
//                        ->from("users")
//                        ->where(new Clause\Conditional("id", "=", 1234));

// $affectedRows = $deleteStatement->execute();