<?php

namespace Winelists;

use PDO;
use Winelists\BaseService;

class Country extends BaseService{

    public function getCountries() {
        
        // Get wineries country
        return $this->fetchAll('SELECT * FROM country_tbl');
    }
}