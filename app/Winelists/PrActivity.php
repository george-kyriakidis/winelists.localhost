<?php

namespace Winelists;

use PDO;
use Winelists\BaseService;

class PrActivity extends BaseService{

    public function getActivity() {
        
        // Get all pro. activities
        return $this->fetchAll('SELECT * FROM pr_activity_tbl');
    }
}