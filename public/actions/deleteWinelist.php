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
$winelistId = $_REQUEST['winelist_id'];

//Create new Winelist
$winelist = new Winelist();
$winelist->deleteWinelistsItems($winelistId);
$winelist->deleteWinelist($winelistId);

//Return to Dashboard page
header('Location: http://winelists.localhost/public/dashboard.php');

?>