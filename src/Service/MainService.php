<?php

namespace Src\Service;

use App\Service;
use App\Db;

class MainService extends Service {
    
    public function getRandomNumber(){
        return random_int(1,20);
    }

    public function getSelect(){
        $db = Db::getConnection();

        return $db->select()
            ->from('article')
            ->execute()
            ->fetchAll();
    }
}