<?php

    require __DIR__ . '/../boot/boot.php';
    
    use Winelists\User;
    use Winelists\Winelist;
    use Winelists\Winery;
    use Winelists\Customer;

    // Check for logged in user
	$userId = User::getCurrentUserId();
	if (empty($userId)) {
		header('Location: http://winelists.localhost/public/login.php');
		return;
	}

    // Get winelists
    $winelist = new Winelist();
    $allWinelistsByUser = $winelist->getWinelistByUserId($userId);

    // Get wineries
    $winery = new Winery();
    $allWineries = $winery->getWineries();

    // Get Customers
    $customer = new Customer();
    $allCustomers = $customer->getCustomers();

?>
<!-- Header -->
<?php require __DIR__ . '/../includes/header.php';?>
<!-- Main section -->
<main class="container-lg">
    <div class="row g-2">
        <!-- Winelists section -->
        <div class="col-sm-4 col-md-4 col-lg-4">
            <div id="winelists-section">
                <div id="winelists-header" class="d-flex align-items-center justify-content-between rounded-top p-2">
                    <h3 class="text-light m-0">Winelists</h3>
                    <button type="button" class="btn p-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="text-light bi bi-plus-lg fs-4"></i>
                    </button>
                    <!-- Modal for insert customer and winelist's name to new winelist -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Winelist</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/public/actions/addWinelist.php" method="post">
                                        <div class="form-row">
                                            <select name="customer" id="customer" class="form-select mb-2 p-2" aria-label="Default select example">
                                                <option value="0"selected>Customer Name</option>
                                                <?php 
                                                    foreach ($allCustomers as $eachCustomer) {
                                                ?>
                                                <option value="<?php echo $eachCustomer['customer_id']; ?>"><?php echo $eachCustomer['customer_name']; ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                            <p class="alert-datalist text-danger p-0">*Must select on customer!</p>
                                            <div class="form-row">
                                                <input name="winelist_name" type="text" placeholder="Winelist Name" class="form-control mb-2" id="winelistName">
                                            </div>
                                            <p class="alert-winelistName text-danger p-0">*Must be only characters!</p>
                                        </div>
                                        <div class="form-row">
                                            <div class="mb-3">
                                                <button type="submit" id="formToWinelist" style="width:100%;border-radius:0;" class="btn btn-dark p-2 disabled" >Go to Winelist</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    foreach ($allWinelistsByUser as $eachWinelistByUser) {
                ?>
                <div id="winelists-body" class="d-flex align-items-center p-2 m-2">
                    <a class="text-decoration-none text-dark flex-fill text-start" href="/public/winelistItems.php?winelist_id=<?php echo $eachWinelistByUser['wine_orders_id'];?>"><?php echo $eachWinelistByUser['wine_orders_name']; ?></a>
                    <i class="bi bi-arrow-right-circle-fill fs-5"></i>
                    <a class="text-decoration-none ms-2" href="/public/currentWinelistItems.php?customer=<?php echo $eachWinelistByUser['customer_id']; ?>&&winelist_name=<?php echo $eachWinelistByUser['wine_orders_name']; ?>&&winelist_id=<?php echo $eachWinelistByUser['wine_orders_id']; ?>"><i class="bi bi-pencil-square fs-5"></i></a>

                </div>
                <?php
                    }
                ?>
                <!-- Message for no winelists -->
                <?php
                    if (count($allWinelistsByUser) == 0) {
                ?>
                <h5 class="p-2 m-0">There are no winelists</h5>
                <?php
                    }
                ?>
            </div>
        </div>
        <!-- Wineries section -->
        <div class="col-sm-4 col-md-4 col-lg-4" id=winery-section>
            <div id="winelists-section"">
                <div id="winelists-header" class="d-flex align-items-center justify-content-between rounded-top p-2">
                    <h3 class="text-light m-0">Wineries</h3>
                </div>
                <?php
                    foreach ($allWineries as $eachWinery) {
                ?>
                <div id="winelists-body" class="d-flex align-items-center p-2 m-2">
                    <a class="text-decoration-none text-dark flex-fill text-start" href="/public/winery.php?winery_id=<?php echo $eachWinery['winery_id']; ?>"><?php echo $eachWinery['winery_name']; ?></a>
                    <i class="bi bi-arrow-right-circle-fill fs-5"></i>
                    
                </div>
                <?php
                    }
                ?>
                <!-- Message for no wineries -->
                <?php
                    if (count($allWineries) == 0) {
                ?>
                <h5 class="p-2 m-0">There are no wineries</h5>
                <?php
                    }
                ?>
            </div>
        </div>
        <!-- Customers section -->
        <div class="col-sm-4 col-md-4 col-lg-4">
            <div id="winelists-section">
                <div id="winelists-header" class="d-flex align-items-center justify-content-between rounded-top p-2">
                    <h3 class="text-light m-0">Customers</h3>
                    <a class="text-decoration-none text-dark" href="/public/customer.php"><i class="btn p-0 text-light bi bi-plus-lg fs-4"></i></a>
                </div>
                <?php
                    foreach ($allCustomers as $eachCustomer) {
                ?>
                <div id="winelists-body" class="d-flex align-items-center p-2 m-2">
                    <a class="text-decoration-none text-dark flex-fill text-start" href="/public/customer.php?customer_id=<?php echo $eachCustomer['customer_id']; ?>"><?php echo $eachCustomer['customer_name']; ?></a>
                    <i class="bi bi-arrow-right-circle-fill fs-5"></i>
                </div>
                <?php
                    }
                ?>
                <!-- Message for no customers -->
                <?php
                    if (count($allCustomers) == 0) {
                ?>
                <h5 class="p-2 m-0">There are no customers</h5>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</main>
<!-- Footer -->
<?php require __DIR__ . '/../includes/footer.php';?>