<?php

namespace Winelists;

use PDO;
use Winelists\BaseService;

class FoodPearing extends BaseService{

    public function getFoodPearing() {
        
        // Get all food pearings
        return $this->fetchAll('SELECT * FROM foodpearing_tbl');
    }
}