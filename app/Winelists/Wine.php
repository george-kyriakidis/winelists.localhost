<?php

namespace Winelists;

use PDO;
use Winelists\BaseService;

class Wine extends BaseService{

    public function getAllWines(){

        // Get all wines
        return $this->fetchAll('SELECT * FROM wine_tbl');
    }

    public function getWinesByWinery($wineryId, $varietyIdOne='', $varietyIdTwo='', $varietyIdThree='', $blended='', $colorId='', $bottleId='') {

        $parameters = [
            ':winery_id' => $wineryId,
        ];

        if ($varietyIdOne > 0) {
            $parameters[':variety_id_one'] = $varietyIdOne;
        }

        if ($varietyIdTwo > 0) {
            $parameters[':variety_id_two'] = $varietyIdTwo;
        }

        if ($varietyIdThree > 0) {
            $parameters[':variety_id_three'] = $varietyIdThree;
        }

        if ($blendedId > 0) {
            $parameters[':blended_id'] = $blendedId;
        }

        if ($colorId > 0) {
            $parameters[':color_id'] = $colorId;
        }

        if ($bottleId > 0) {
            $parameters[':bottle_id'] = $bottleId;
        }

        $sql = 'SELECT wine_tbl.*, 
            (SELECT variety_tbl.variety_name FROM variety_tbl WHERE variety_tbl.variety_id=wine_tbl.variety_id_one) as variety_name_one,
            (SELECT variety_tbl.variety_name FROM variety_tbl WHERE variety_tbl.variety_id=wine_tbl.variety_id_two) as variety_name_two,
            (SELECT variety_tbl.variety_name FROM variety_tbl WHERE variety_tbl.variety_id=wine_tbl.variety_id_three) as variety_name_three,
            (SELECT blended_tbl.blended_name FROM blended_tbl WHERE blended_tbl.blended_id=wine_tbl.blended_id) as blended_name,
            (SELECT color_tbl.color_name FROM color_tbl WHERE color_tbl.color_id=wine_tbl.color_id) as color_name,
            (SELECT bottle_tbl.bottle_name FROM bottle_tbl WHERE bottle_tbl.bottle_id=wine_tbl.bottle_id) as bottle_name
        FROM wine_tbl 
        WHERE winery_id ='. $wineryId;

        if ($varietyIdOne > 0) {
            $sql .= ' AND wine_tbl.variety_id_one ='. $varietyIdOne ;
        }
        if ($varietyIdTwo > 0) {
            $sql .= ' AND wine_tbl.variety_id_two ='. $varietyIdTwo ;
        }
        if ($varietyIdThree > 0) {
            $sql .= ' AND wine_tbl.variety_id_three ='. $varietyIdThree ;
        }
        if ($blendedId > 0) {
            $sql .= ' AND wine_tbl.blended_id ='. $blendedId ;
        }
        if ($colorId > 0) {
            $sql .= ' AND wine_tbl.color_id ='. $colorId ;
        }
        if ($bottleId > 0) {
            $sql .= ' AND wine_tbl.bottle_id ='. $bottleId ;
        }
        
        return $this->fetchAll($sql, $parameters);
    }

    public function getWineById($wineId){
        $parameters = [
            ':wine_id' => $wineId,
        ];

        return $this->fetch(
        'SELECT wine_tbl.*, 
            (SELECT variety_tbl.variety_name FROM variety_tbl WHERE variety_tbl.variety_id=wine_tbl.variety_id_one) as variety_name_one,
            (SELECT variety_tbl.variety_name FROM variety_tbl WHERE variety_tbl.variety_id=wine_tbl.variety_id_two) as variety_name_two,
            (SELECT variety_tbl.variety_name FROM variety_tbl WHERE variety_tbl.variety_id=wine_tbl.variety_id_three) as variety_name_three,
            (SELECT winery_tbl.winery_name FROM winery_tbl WHERE winery_tbl.winery_id=wine_tbl.winery_id) as winery_name,
            (SELECT country_tbl.country_name FROM country_tbl WHERE country_tbl.country_id=wine_tbl.country_id) as country_name,
            (SELECT area_tbl.area_name FROM area_tbl WHERE area_tbl.area_id=wine_tbl.area_id) as area_name,
            (SELECT blended_tbl.blended_name FROM blended_tbl WHERE blended_tbl.blended_id=wine_tbl.blended_id) as blended_name,
            (SELECT color_tbl.color_name FROM color_tbl WHERE color_tbl.color_id=wine_tbl.color_id) as color_name,
            (SELECT bottle_tbl.bottle_name FROM bottle_tbl WHERE bottle_tbl.bottle_id=wine_tbl.bottle_id) as bottle_name,
            (SELECT foodpearing_tbl.foodpearing_desc FROM foodpearing_tbl WHERE foodpearing_tbl.foodpearing_id=wine_tbl.foodpearing_id) as foodpearing_name
         FROM wine_tbl 
         WHERE wine_id = :wine_id', $parameters);
    }

    public function searchWine($wineName='', $wineryId='', $countryId='', $areaId='', $varietyIdOne='', $varietyIdTwo='', $varietyIdThree='', $blendedId='', $colorId='', $bottleId='', $foodPearingId=''){

        if (!empty($wineName)) {
            $parameters[':wine_name'] = $wineName;
        }
        
        if ($wineryId > 0) {
            $parameters[':winery_id'] = $wineryId;
        }

        if ($countryId > 0) {
            $parameters[':country_id'] = $countryId;
        }

        if ($areaId > 0) {
            $parameters[':area_id'] = $areaId;
        }

        if ($varietyIdOne > 0) {
            $parameters[':variety_id_one'] = $varietyIdOne;
        }

        if ($varietyIdTwo > 0) {
            $parameters[':variety_id_two'] = $varietyIdTwo;
        }

        if ($varietyIdThree > 0) {
            $parameters[':variety_id_three'] = $varietyIdThree;
        }

        if ($blendedId > 0) {
            $parameters[':blended_id'] = $blendedId;
        }

        if ($colorId > 0) {
            $parameters[':color_id'] = $colorId;
        }

        if ($bottleId > 0) {
            $parameters[':bottle_id'] = $bottleId;
        }

        if ($foodPearingId > 0) {
            $parameters[':foodpearing_id'] = $foodPearingId;
        }
        
        $sql = 'SELECT wine_tbl.*, 
            (SELECT variety_tbl.variety_name FROM variety_tbl WHERE variety_tbl.variety_id=wine_tbl.variety_id_one) as variety_name_one,
            (SELECT variety_tbl.variety_name FROM variety_tbl WHERE variety_tbl.variety_id=wine_tbl.variety_id_two) as variety_name_two,
            (SELECT variety_tbl.variety_name FROM variety_tbl WHERE variety_tbl.variety_id=wine_tbl.variety_id_three) as variety_name_three,
            (SELECT winery_tbl.winery_name FROM winery_tbl WHERE winery_tbl.winery_id=wine_tbl.winery_id) as winery_name,
            (SELECT country_tbl.country_name FROM country_tbl WHERE country_tbl.country_id=wine_tbl.country_id) as country_name,
            (SELECT area_tbl.area_name FROM area_tbl WHERE area_tbl.area_id=wine_tbl.area_id) as area_name,
            (SELECT blended_tbl.blended_name FROM blended_tbl WHERE blended_tbl.blended_id=wine_tbl.blended_id) as blended_name,
            (SELECT color_tbl.color_name FROM color_tbl WHERE color_tbl.color_id=wine_tbl.color_id) as color_name,
            (SELECT bottle_tbl.bottle_name FROM bottle_tbl WHERE bottle_tbl.bottle_id=wine_tbl.bottle_id) as bottle_name,
            (SELECT foodpearing_tbl.foodpearing_desc FROM foodpearing_tbl WHERE foodpearing_tbl.foodpearing_id=wine_tbl.foodpearing_id) as foodpearing_name
        FROM wine_tbl 
        WHERE 1=1 ';
        if (!empty($wineName)) {
            $sql .= ' AND wine_tbl.wine_name LIKE '. '"%' .''. $wineName .'%"';
        }
        if ($wineryId > 0) {
            $sql .= ' AND wine_tbl.winery_id ='. $wineryId ;
        }
        if ($countryId > 0) {
            $sql .= ' AND wine_tbl.country_id ='. $countryId ;
        }
        if ($areaId > 0) {
            $sql .= ' AND wine_tbl.area_id ='. $areaId ;
        }
        if ($varietyIdOne > 0) {
            $sql .= ' AND wine_tbl.variety_id_one ='. $varietyIdOne ;
        }
        if ($varietyIdTwo > 0) {
            $sql .= ' AND wine_tbl.variety_id_two ='. $varietyIdTwo ;
        }
        if ($varietyIdThree > 0) {
            $sql .= ' AND wine_tbl.variety_id_three ='. $varietyIdThree ;
        }
        if ($blendedId > 0) {
            $sql .= ' AND wine_tbl.blended_id ='. $blendedId ;
        }
        if ($colorId > 0) {
            $sql .= ' AND wine_tbl.color_id ='. $colorId ;
        }
        if ($bottleId > 0) {
            $sql .= ' AND wine_tbl.bottle_id ='. $bottleId ;
        }
        if ($foodPearingId > 0) {
            $sql .= ' AND wine_tbl.foodpearing_id ='. $foodPearingId ;
        }

        return $this->fetchAll($sql, $parameters);
    }
}