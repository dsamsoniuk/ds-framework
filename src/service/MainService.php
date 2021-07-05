<?php

namespace Source\Service;

use App\Core\Service;
use FaaPz\PDO\Clause\Conditional;

class MainService extends Service {
    
    public function getRandomNumber(){
        return random_int(1,20);
    }

    public function getSelect(){
        $db = $this->getDatabase();
        $sel = $db->select()->from('account')
        ->where(new Conditional("acct_num", ">", 1))
        ->execute()->fetchAll();
        return $sel;
    }
}