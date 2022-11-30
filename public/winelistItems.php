<?php
    require __DIR__ . '/../boot/boot.php';

    use Winelists\User;
    use Winelists\Customer;
    use Winelists\Wine;
    use Winelists\Winelist;

    // Check for logged in user
	$userId = User::getCurrentUserId();
	if (empty($userId)) {
		header('Location: http://winelists.localhost/public/login.php');
		return;
	}

    // Get parameters
    $winelistId = $_REQUEST['winelist_id'];

    $winelist = new Winelist();
    $currentWinelistItems = $winelist->getWinelistById($winelistId);
?>

<!-- Header -->
<?php require __DIR__ . '/../includes/header.php';?>
<!-- Main section -->
<main class="container">
    <button onclick="history.back()" class="btn p-0 fs-4"><i class="bi bi-arrow-left"></i></button>
    <div class="row">
        <div class="col">
            <h3><?php echo $currentWinelistItems[0]['customer_name'];?></h3>
        </div>
        <div class="col d-flex justify-content-end">
            <form action="/public/actions/deleteWinelist.php" method="post" class="mb-0 me-3">
                <input type="hidden" name="winelist_id" id="winelist_id" value=<?php echo $winelistId;?>>
                <button class="btn btn-dark" name="delete" style="border-radius:0;"><i class="bi bi-trash"></i></button>
            </form>
            <form action="/public/actions/generatePdf.php" method="post" class="mb-0">
                <input type="hidden" name="winelist_id" id="winelist_id" value=<?php echo $winelistId;?>>
                <button class="btn btn-dark" name="delete" style="border-radius:0;"><i class="bi bi-file-pdf"></i></button>
            </form>
        </div>
    </div>
    <div class="row border-bottom">
        <h5><?php echo $currentWinelistItems[0]['winelist_name'];?></h5>
    </div>
    <?php
    foreach ($currentWinelistItems as $eachItem) {
    ?>
        <div class="row">
            <div class="col"><p><?php echo $eachItem['winery_name']; ?></p></div>
        </div>
        <div class="row">
            <div class="col"><p><?php echo $eachItem['wine_name']; ?> - <?php echo $eachItem['color_name']; ?> <?php echo $eachItem['bottle_name']; ?></p></div>
            <div class="col"><p><?php echo $eachItem['variety_name_one']; ?></p></div>
            <div class="col">
                <div class="row"><p>Αρχική: <?php echo $eachItem['price']; ?>€</p></div>
                <div class="row"><p>Έκπτωση: <?php echo $eachItem['discount']; ?>%</p></div>
                <div class="row"><p>Τελική: <?php echo $eachItem['total_price']; ?>€</p></div>
            </div>
        </div>
    <?php
        }
    ?>
    <!--  -->
    <?php
        if (count($eachItem) == 0) {
    ?>
    <h5 class="p-2 m-0">Your Winelist is not completed. Please follow the above link.</h5>
    <a class="btn text-decoration-none ms-2" href="/public/currentWinelistItems.php">Link</a>
    <?php
        }
    ?>

</main>
<!-- Footer -->
<?php require __DIR__ . '/../includes/footer.php';?>

