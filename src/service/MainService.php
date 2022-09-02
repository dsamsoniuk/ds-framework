<?php

namespace Src\Service;

use App\Service;
use FaaPz\PDO\Clause\Conditional;
use App\Db;

class MainService extends Service {
    
    public function getRandomNumber(){
        return random_int(1,20);
    }

    public function getSelect(){
        $db = Db::getDatabase();
        $query = [];
        // $query = $db->select()->from('account')
        // ->where(new Conditional("acct_num", ">", 1))
        // ->execute()->fetchAll();
        return $query;
    }
}