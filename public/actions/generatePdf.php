<?php

use Winelists\Winelist;
use Winelists\User;

//Boot application
require_once __DIR__ . '/../../boot/boot.php';
require_once __DIR__ . '/../../tfpdf/tfpdf.php';

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

// Get Parameters
$winelistId = $_REQUEST['winelist_id'];

// Get winelist items
$winelist = new Winelist();
$currentWinelistItems = $winelist->getWinelistById($winelistId);

// Create new pdf
$pdf = new tFPDF('p','mm','A4');
$pdf->AddPage();
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
$pdf->SetFont('DejaVu','',14);

$pdf->SetTitle($currentWinelistItems[0]['winelist_name']);
// Header
$pdf->Cell(120, 10, $currentWinelistItems[0]['customer_name'],0, 1);
$pdf->Cell(69, 10, $currentWinelistItems[0]['winelist_name'], 0, 1);
$pdf->Ln(10);
// Titles
$pdf->Cell(56, 8, 'Οινοποιείο',0, 0);
$pdf->Cell(53, 8, 'Ετικέτα', 0, 0);
$pdf->Cell(20, 8, '', 0, 0);
$pdf->Cell(20, 8, 'Αρχική', 0, 0);
$pdf->Cell(20, 8, '%', 0, 0);
$pdf->Cell(20, 8, 'Τελική', 0, 1);
$pdf->Line(10,50,200,50);
$pdf->Ln(5);

// Display data
foreach ($currentWinelistItems as $winelistItems) {
    $pdf->Cell(56, 5, $winelistItems['winery_name'],0, 0);
    $pdf->Cell(53, 5, $winelistItems['wine_name'], 0, 0);
    $pdf->Cell(20, 5, $winelistItems['color_name'],0,0);
    $pdf->Cell(20, 5, $winelistItems['price'],0,0);
    $pdf->Cell(20, 5, $winelistItems['discount'],0,0);
    $pdf->Cell(20, 5, $winelistItems['total_price'], 0, 1);
    $pdf->Ln(3);
}


$pdf->Output();

?>