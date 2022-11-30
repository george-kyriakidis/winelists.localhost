<?php

use Winelists\Customer;

//Boot application
require_once __DIR__ . '/../../boot/boot.php';

//Return to home page if not a post request
if (strtolower($_SERVER['REQUEST_METHOD']) != 'post') {
    header('Location: /');

    return;
} 

//Get customer id
$customerId = $_REQUEST['customer_id'];

$customer = new Customer();

if(isset($_REQUEST['delete'])){
    $customer->deleteCustomer($customerId);
    header('Location: http://winelists.localhost/public/dashboard.php');
}

if($customerId){
    if(isset($_REQUEST['update'])){
        $customer->updateCustomer($_REQUEST['name'], $_REQUEST['phone'], $_REQUEST['email'], $_REQUEST['vat'], $_REQUEST['activity'], $customerId);
        header('Location: http://winelists.localhost/public/dashboard.php');
    }
}else {
    $customer->insertCustomer($_REQUEST['name'], $_REQUEST['phone'], $_REQUEST['email'], $_REQUEST['vat'], $_REQUEST['activity']);
    header('Location: http://winelists.localhost/public/dashboard.php');
}

?>