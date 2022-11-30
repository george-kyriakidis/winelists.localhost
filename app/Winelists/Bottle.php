<?php

namespace Winelists;

use PDO;
use Winelists\BaseService;

class Bottle extends BaseService{

    public function getBottleCategory() {
        
        // Get all bottles categories
        return $this->fetchAll('SELECT * FROM bottle_tbl');
    }
}