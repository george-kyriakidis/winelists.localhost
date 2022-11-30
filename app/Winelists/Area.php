<?php

namespace Winelists;

use PDO;
use Winelists\BaseService;

class Area extends BaseService{

    public function getAreas() {
        
        // Get areas
        return $this->fetchAll('SELECT * FROM area_tbl');
    }
}