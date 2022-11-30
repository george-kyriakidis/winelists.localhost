<?php
    require __DIR__ . '/../boot/boot.php';

    use Winelists\User;
    use Winelists\Customer;
    use Winelists\Winelist;

    // Check for logged in user
	$userId = User::getCurrentUserId();
	if (empty($userId)) {
		header('Location: http://winelists.localhost/public/login.php');
		return;
	}

    // Get Parameters
    $selectedCustomerId = $_REQUEST['customer'];
    $selectedWinelistName = $_REQUEST['winelist_name'];
    $selectedWinelistId = $_REQUEST['winelist_id'];

    // Get customer
    $customer = new Customer();
    $allCustomers = $customer->getCustomers();
    
    $winelist = new Winelist();
    $currentWinelistItems = $winelist->getWinelistById($selectedWinelistId);
    $winelistItemsTemp = $winelist->getTempWinelistById($selectedWinelistId);
?>
<!-- Header -->
<?php require __DIR__ . '/../includes/header.php';?>
<!-- Main section -->
<main class="container-lg">
    <div class="border-bottom mt-2 d-flex justify-content-between align-items-center">
        <div class="col-8">
            <h3>Winelist</h3>
        </div>
    </div>
    <div class="row">
        <form action="/public/actions/addWinelistItems.php" method="post">  
            <div class="form-row">
                <input type="hidden" id="winelist_id" name="winelist_id" value="<?php echo $currentWinelistId['wine_orders_id'] ?>">
                <select name="customer" id="customer" class="form-select mb-2 mt-3 p-2" aria-label="Default select example">
                        <?php 
                            foreach ($allCustomers as $eachCustomer) {
                        ?>
                            <option value="<?php echo $eachCustomer['customer_id'];?>" 
                                            <?php echo $selectedCustomerId['customer_id'] == $eachCustomer['customer_id']? "selected" : "" ?>>
                                            <?php echo $eachCustomer['customer_name'];?>
                            </option>
                        <?php
                            }
                        ?>
                </select>
            </div>
            <div class="form-row">
                <input type="text" placeholder="Winelist Name" class="form-control mb-2" id="winelistName" name="winelistName"value="<?php echo $selectedWinelistName; ?>">
            </div>     
            <!-- Display all wine for current winelist -->
            <?php
                foreach ($winelistItemsTemp as $ItemTemp) {
            ?>
            <div class="d-flex mb-3 align-items-center justify-content-between">
                <input type="hidden" id="wine_id" name="wine_id[]" value="<?php echo $ItemTemp['wine_id']; ?>">
                <input type="hidden" id="price" name="price[]" value="<?php echo number_format($ItemTemp['price'],2); ?>">
                <button name="deleteCart" value="<?php echo $ItemTemp['wine_id']; ?>" class="btn btn-dark m-3" style="border-radius:0;"><i class="bi bi-trash"></i></button>
                <button name="updateCart" class="btn btn-dark m-3" style="border-radius:0;"><i class="bi bi-pen"></i></button>
                <div class="flex-fill">
                    <p class="mb-0 pe-2"><?php echo $ItemTemp['winery_name']; ?></p>
                    <h6><?php echo $ItemTemp['wine_name']; ?> | <?php echo $ItemTemp['color_name']; ?></h6>
                    <div class="d-flex align-items-center">
                        <p class="mb-0 pe-2"><span id="price"><?php echo number_format($ItemTemp['price'],2); ?></span>€</p>
                        <input type="text" name="discount[]" style="width:60px;" class="form-control discount-input me-2" placeholder="%" aria-label="discount" aria-describedby="discount"
                        value="<?php echo $ItemTemp['discount']; ?>"> 
                        <div class=""><span id="totalPrice"><?php echo $ItemTemp['total_price']; ?></span>€</div>  
                    </div>
                </div>
                <input type="hidden" id="total_price" name="total_price[]" value="<?php echo number_format($ItemTemp['total_price'],2); ?>">
            </div>
            <?php
                }
            ?>
            <!-- If there are not wine in temporary table, display the main winelist -->
            <?php
                if (count($ItemTemp) == 0) {
                    foreach($currentWinelistItems as $eachWinelistItems){
            ?>
            <div class="d-flex mb-3 align-items-center justify-content-between">
                <input type="hidden" id="wine_id" name="wine_id[]" value="<?php echo $eachWinelistItems['wine_id']; ?>">
                <input type="hidden" id="price" name="price[]" value="<?php echo number_format($eachWinelistItems['price'],2); ?>">
                <button name="deleteCart" value="<?php echo $eachWinelistItems['wine_id']; ?>" class="btn btn-dark m-3" style="border-radius:0;"><i class="bi bi-trash"></i></button>
                <button name="updateCart" class="btn btn-dark m-3" style="border-radius:0;"><i class="bi bi-pen"></i></button>
                <div class="flex-fill">
                    <p class="mb-0 pe-2"><?php echo $ItemTemp['winery_name']; ?></p>
                    <h6><?php echo $eachWinelistItems['wine_name']; ?> | <?php echo $eachWinelistItems['color_name']; ?></h6>
                    <div class="d-flex align-items-center">
                        <p class="mb-0 pe-2"><span id="price"><?php echo number_format($eachWinelistItems['price'],2); ?></span>€</p>
                        <input type="text" name="discount[]" style="width:60px;" class="form-control discount-input me-2" placeholder="%" aria-label="discount" aria-describedby="discount"
                        value="<?php echo $eachWinelistItems['discount']; ?>"> 
                        <div class=""><span id="totalPrice"><?php echo $ItemTemp['total_price']; ?></span>€</div>  
                    </div>
                </div>
                <input type="hidden" id="total_price" name="total_price[]" value="<?php echo number_format($eachWinelistItems['total_price'],2); ?>">
            </div>
            <?php
                    }
                }
            ?>
            <button style="border-radius:0;" type="submit" class="btn btn-dark p-2">Add Winelist</button>
        </form>
    </div>

</main>
<!-- Footer -->
<?php require __DIR__ . '/../includes/footer.php';?>