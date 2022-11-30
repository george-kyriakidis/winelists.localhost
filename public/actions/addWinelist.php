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
$customerId = $_REQUEST['customer'];
$winelistName = $_REQUEST['winelist_name'];

//Create new Winelist
$winelist = new Winelist();
$newWinelist = $winelist->addWinelist($winelistName, User::getCurrentUserId(), $customerId);

header(sprintf('Location: http://winelists.localhost/public/winelist.php?winelist_name=%s&&customer=%s', $winelistName, $customerId));

?>