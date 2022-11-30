<?php

namespace Winelists;

use PDO;
use Winelists\BaseService;

class Blended extends BaseService{

    public function getBlended() {
        
        // Get blended
        return $this->fetchAll('SELECT * FROM blended_tbl');
    }
}