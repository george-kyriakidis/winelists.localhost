<?php

use Winelists\Winelist;
use Winelists\User;

//Boot application
require_once __DIR__ . '/../../boot/boot.php';

//Return to home page if not a post request
if (strtolower($_SERVER['REQUEST_METHOD']) != 'post') {
    header('Location: /');

    return;
} 

//If no user is logged in, return to main page
if (empty(User::getCurrentUserId())) {
    header('Location: /');
    return;
}

// Get parameters
$wineOrdersId = $_REQUEST['winelist_id'];
$customerId = $_REQUEST['customer'];
$winelistName = $_REQUEST['winelistName'];
$wineId = $_REQUEST['wine_id'];
$price = $_REQUEST['price'];
$discount = $_REQUEST['discount'];
$totalPrice = $_REQUEST['total_price'];

$winelist = new Winelist();

if(isset($_REQUEST['deleteCart'])){
    
    $wineItemId = $_REQUEST['deleteCart'];
    
    $deleteItemFromTemp = $winelist->deleteItemTemp($wineOrdersId, $wineItemId);
    
    header(sprintf('Location: http://winelists.localhost/public/currentWinelistItems.php?winelist_name=%s&&customer=%s&&winelist_id=%s', $winelistName, $currentCustomer, $wineOrdersId));
    die;
}

//Create new Winelist
for ($i=0; $i < count($wineId); $i++) { 
    $eachWineId = $wineId[$i];
    $eachPrice = $price[$i];
    $eachDiscount = $discount[$i];
    $eachTotalPrice = $totalPrice[$i];
    
    $winelistsItems = $winelist->addItemsToWinelist($wineOrdersId, User::getCurrentUserId(), $customerId, $eachWineId, $eachPrice, $eachDiscount, $eachTotalPrice);
}

$deleteItemsFromTemp = $winelist->deleteWinelistsItemsTemp($wineOrdersId);

//Return to Dashboard page
header('Location: http://winelists.localhost/public/dashboard.php');

?>