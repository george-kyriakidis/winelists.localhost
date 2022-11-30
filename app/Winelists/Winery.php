<?php

namespace Winelists;

use PDO;
use Winelists\BaseService;

class Winery extends BaseService{

    public function getWineries() {
        
        // Get all wineries
        return $this->fetchAll('SELECT * FROM winery_tbl');
    }

    public function getWineryById($wineryId) {

        $parameters = [
            ':winery_id' => $wineryId,
        ];

        return $this->fetch('SELECT winery_tbl.*, area_tbl.area_name AS area_name
         FROM winery_tbl 
         INNER JOIN area_tbl ON winery_tbl.winery_area_id = area_tbl.area_id        
         WHERE winery_id = :winery_id', $parameters);
    }
}
