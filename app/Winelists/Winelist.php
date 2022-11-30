<?php

namespace Winelists;

use PDO;
use Winelists\BaseService;

class Winelist extends BaseService{

    public function getWinelistByUserId($userId){

        $parameters = [
            ':user_id' => $userId,
        ];

        return $this->fetchAll('SELECT * FROM wine_orders_tbl WHERE user_id = :user_id', $parameters);
        
    }

    public function getCurrentWinelistByUserId($userId){

        $parameters = [
            ':user_id' => $userId,
        ];

        return $this->fetch('SELECT * FROM wine_orders_tbl WHERE user_id = :user_id ORDER BY wine_orders_id DESC LIMIT 1', $parameters);
        
    }

    public function getWinelistById($winelistId){
        $parameters = [
            ':wine_orders_id' => $winelistId,
        ];

        return $this->fetchAll(
        'SELECT wine_orders_tbl_items.*, wine_tbl.*,
            (SELECT customer_tbl.customer_name FROM customer_tbl WHERE customer_tbl.customer_id=wine_orders_tbl_items.customer_id) as customer_name,
            (SELECT wine_orders_tbl.wine_orders_name FROM wine_orders_tbl WHERE wine_orders_tbl.wine_orders_id=wine_orders_tbl_items.wine_orders_id) as winelist_name,
            (SELECT variety_tbl.variety_name FROM variety_tbl WHERE variety_tbl.variety_id=wine_tbl.variety_id_one) as variety_name_one,
            (SELECT variety_tbl.variety_name FROM variety_tbl WHERE variety_tbl.variety_id=wine_tbl.variety_id_two) as variety_name_two,
            (SELECT variety_tbl.variety_name FROM variety_tbl WHERE variety_tbl.variety_id=wine_tbl.variety_id_three) as variety_name_three,
            (SELECT winery_tbl.winery_name FROM winery_tbl WHERE winery_tbl.winery_id=wine_tbl.winery_id) as winery_name,
            (SELECT color_tbl.color_name FROM color_tbl WHERE color_tbl.color_id=wine_tbl.color_id) as color_name,
            (SELECT bottle_tbl.bottle_name FROM bottle_tbl WHERE bottle_tbl.bottle_id=wine_tbl.bottle_id) as bottle_name
        FROM wine_orders_tbl_items, wine_tbl
        WHERE wine_orders_id = :wine_orders_id AND wine_orders_tbl_items.wine_id=wine_tbl.wine_id', $parameters);
    }

    public function getTempWinelistById($winelistId){
        $parameters = [
            ':wine_orders_id' => $winelistId,
        ];

        return $this->fetchAll(
        'SELECT wine_orders_tbl_items_temp.*, wine_tbl.*,
            (SELECT customer_tbl.customer_name FROM customer_tbl WHERE customer_tbl.customer_id=wine_orders_tbl_items_temp.customer_id) as customer_name,
            (SELECT wine_orders_tbl.wine_orders_name FROM wine_orders_tbl WHERE wine_orders_tbl.wine_orders_id=wine_orders_tbl_items_temp.wine_orders_id) as winelist_name,
            (SELECT variety_tbl.variety_name FROM variety_tbl WHERE variety_tbl.variety_id=wine_tbl.variety_id_one) as variety_name_one,
            (SELECT variety_tbl.variety_name FROM variety_tbl WHERE variety_tbl.variety_id=wine_tbl.variety_id_two) as variety_name_two,
            (SELECT variety_tbl.variety_name FROM variety_tbl WHERE variety_tbl.variety_id=wine_tbl.variety_id_three) as variety_name_three,
            (SELECT winery_tbl.winery_name FROM winery_tbl WHERE winery_tbl.winery_id=wine_tbl.winery_id) as winery_name,
            (SELECT color_tbl.color_name FROM color_tbl WHERE color_tbl.color_id=wine_tbl.color_id) as color_name,
            (SELECT bottle_tbl.bottle_name FROM bottle_tbl WHERE bottle_tbl.bottle_id=wine_tbl.bottle_id) as bottle_name
        FROM wine_orders_tbl_items_temp, wine_tbl
        WHERE wine_orders_id = :wine_orders_id AND wine_orders_tbl_items_temp.wine_id=wine_tbl.wine_id', $parameters);
    }

    public function addWinelist($winelistName, $userId, $customerId){

        $parameters = [
            ':wine_orders_name' => $winelistName,
            ':user_id' => $userId,
            ':customer_id' => $customerId,
        ];
        
        $rows = $this->execute('INSERT INTO wine_orders_tbl (wine_orders_name, user_id, customer_id) VALUES(:wine_orders_name, :user_id, :customer_id)', $parameters);
                
        return $rows == 1;
    }

    public function addItemsToWinelist($wineOrdersId, $userId, $customerId, $wineId, $price, $discount, $totalPrice){

        $parameters = [
            ':wine_orders_id' => $wineOrdersId,
            ':user_id' => $userId,
            ':customer_id' => $customerId,
            ':wine_id' => $wineId,
            ':price' => $price,
            ':discount' => $discount,
            ':total_price' => $totalPrice
        ];
        
        $rows = $this->execute('INSERT INTO wine_orders_tbl_items (wine_orders_id, user_id, customer_id, wine_id, price, discount, total_price) 
        VALUES(:wine_orders_id, :user_id, :customer_id, :wine_id, :price, :discount, :total_price)'
        , $parameters);
                
        return $rows == 1;

    }

    public function addItemsToWinelistTemp($wineOrdersId, $userId, $customerId, $wineId, $price, $discount, $totalPrice){

        $parameters = [
            ':wine_orders_id' => $wineOrdersId,
            ':user_id' => $userId,
            ':customer_id' => $customerId,
            ':wine_id' => $wineId,
            ':price' => $price,
            ':discount' => $discount,
            ':total_price' => $totalPrice
        ];
        
        $rows = $this->execute('INSERT INTO wine_orders_tbl_items_temp (wine_orders_id, user_id, customer_id, wine_id, price, discount, total_price) 
        VALUES(:wine_orders_id, :user_id, :customer_id, :wine_id, :price, :discount, :total_price)'
        , $parameters);
                
        return $rows == 1;

    }

    public function deleteWinelistsItems($winelistId){
        $parameters = [
            ':wine_orders_id' => $winelistId,
        ];

        $rows = $this->execute('DELETE FROM wine_orders_tbl_items WHERE wine_orders_id = :wine_orders_id', $parameters);
        
        return $rows == 1;
    }

    public function deleteItemTemp($winelistId, $wineId){
        $parameters = [
            ':wine_orders_id' => $winelistId,
            ':wine_id'        => $wineId
        ];

        $rows = $this->execute('DELETE FROM wine_orders_tbl_items_temp WHERE wine_orders_id = :wine_orders_id AND wine_id = :wine_id', $parameters);
        
        return $rows == 1;
    }

    public function deleteWinelistsItemsTemp($winelistId){
        $parameters = [
            ':wine_orders_id' => $winelistId,
        ];

        $rows = $this->execute('DELETE FROM wine_orders_tbl_items_temp WHERE wine_orders_id = :wine_orders_id', $parameters);
        
        return $rows == 1;
    }

    public function deleteWinelist($winelistId){
        $parameters = [
            ':wine_orders_id' => $winelistId,
        ];

        $rows = $this->execute('DELETE FROM wine_orders_tbl WHERE wine_orders_id = :wine_orders_id', $parameters);
        
        return $rows == 1;
    }
}
