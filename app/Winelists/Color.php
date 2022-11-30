<?php

namespace Winelists;

use PDO;
use Winelists\BaseService;

class Color extends BaseService{

    public function getColor() {
        
        // Get wines color
        return $this->fetchAll('SELECT * FROM color_tbl');
    }
}