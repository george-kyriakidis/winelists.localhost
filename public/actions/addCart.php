<?php

use Winelists\User;
use Winelists\Winelist;

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
$winelistName = $_REQUEST['winelist_name'];
$wineId = $_REQUEST['wine_id'];
$winePrice = $_REQUEST['wine_price'];
$discount = $_REQUEST['discount'];
$totalPrice = $winePrice - ($winePrice*$discount)/100;

$winelist = new Winelist();
$addToWinesToTemp = $winelist->addItemsToWinelistTemp($wineOrdersId, User::getCurrentUserId(), $customerId, $wineId, $winePrice, $discount, $totalPrice);

header(sprintf('Location: http://winelists.localhost/public/winelist.php?winelist_name=%s&&customer=%s&&winelist_id=%s', $winelistName, $customerId, $wineOrdersId));

?>