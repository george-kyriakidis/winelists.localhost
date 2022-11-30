<?php

namespace Winelists;

use PDO;
use Winelists\BaseService;

class Customer extends BaseService{

    public function getCustomers() {
        
        // Get all Customers
        return $this->fetchAll('SELECT * FROM customer_tbl');
    }

    public function getCustomerById($customerId) {
        $parameters = [
            ':customer_id' => $customerId,
        ];

        return $this->fetch('SELECT customer_tbl.*, 
                            pr_activity_tbl.pr_activity_name as pr_activity_name
        FROM customer_tbl
        INNER JOIN pr_activity_tbl ON customer_tbl.pr_activity_id = pr_activity_tbl.pr_activity_id
        WHERE customer_id = :customer_id', $parameters);
    }

    public function insertCustomer($name, $phone, $email, $vatNumber, $activity){

        $parameters = [
            ':name' => $name,
            ':phone' => $phone,
            ':email' => $email,
            ':vat_number' => $vatNumber,
            ':activity' => $activity   
        ];
        
        $rows = $this->execute('INSERT INTO customer_tbl
                                (customer_name, customer_phone, customer_email, customer_vat, pr_activity_id) 
                                VALUES(:name, :phone, :email, :vat_number, :activity)', $parameters);
                
        return $rows == 1;

    }

    public function deleteCustomer($customerId){

        $parameters = [
            ':customer_id' => $customerId,
            
        ];

        $rows = $this->execute('DELETE FROM customer_tbl WHERE customer_id = :customer_id', $parameters);
        
        return $rows == 1;
        
    }

    public function updateCustomer($name, $phone, $email, $vatNumber, $activity, $customerId){

        $parameters = [
            ':name' => $name,
            ':phone' => $phone,
            ':email' => $email,
            ':vat_number' => $vatNumber,
            ':activity' => $activity,  
            ':customer_id' => $customerId
        ];
        
        $rows = $this->execute('UPDATE customer_tbl SET
                                customer_name=:name, 
                                customer_phone=:phone, 
                                customer_email=:email, 
                                customer_vat=:vat_number,
                                pr_activity_id=:activity 
                                WHERE customer_id = :customer_id', $parameters);
                
        return $rows == 1;

    }
}