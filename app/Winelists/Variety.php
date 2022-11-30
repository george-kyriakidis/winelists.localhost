<?php

namespace Winelists;

use PDO;
use Winelists\BaseService;

class Variety extends BaseService{

    public function getVarieties() {
        
        // Get all varieties
        return $this->fetchAll('SELECT * FROM variety_tbl');
    }

}