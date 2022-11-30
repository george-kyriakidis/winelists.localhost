<?php

    require __DIR__ . '/../boot/boot.php';
        
    use Winelists\User;
    use Winelists\Wine;

    // Check for logged in user
    $userId = User::getCurrentUserId();
    if (empty($userId)) {
        header('Location: http://winelists.localhost/public/login.php');
        return;
    }

    // Get parameters
    $wineId = $_REQUEST['wine_id'];

    // Get current customer id
    $currentCustomer = $_REQUEST['customer'];

    // Get current wine
    $wine = new Wine();
    $wineById = $wine->getWineById($wineId);
?>
<!-- Header -->
<?php require __DIR__ . '/../includes/header.php';?>
<!-- Main section -->
<main class="container-lg">
    <button onclick="history.back()" class="btn p-0 fs-4"><i class="bi bi-arrow-left"></i></button>
    <div class="row p-3">
        <div class="col-xs-12 col-sm-6">
            <img id="main-wine-image" class="mx-auto d-block" src="/public/assets/images/paragkawhite.jpg" alt="wine-photo">
        </div>
        <div class="col-xs-12 col-sm-6">
            <h4><?php echo $wineById['wine_name']; ?> <?php echo $wineById['color_name']; ?> <?php echo $wineById['bottle_name']; ?></h4>
            <h5><?php echo $wineById['winery_name']; ?></h5>
            <p class="m-0"><?php echo $wineById['country_name']; ?> | <?php echo $wineById['area_name']; ?></p>
            <div class="d-flex align-items-center fst-italic">
                <p class="m-0"><?php echo $wineById['variety_name_one']; ?></p>
                <p class="m-0"><?php echo $wineById['variety_name_two']; ?></p>
                <p class="m-0"><?php echo $wineById['variety_name_three']; ?></p>
            </div>
            <h4><span id="price"><?php echo $wineById['price']; ?></span>€</h4>
            <p><?php echo $wineById['short_desc'] == !"" ? $wineById['short_desc'] : 'Add a short description!'; ?></p>
            <?php 
                if(!empty($currentCustomer)){
            ?>
            <div class="row">

                <div class="col">Total Price:<span id="totalPrice"></span>€</div>
            </div>
            <form action="/public/actions/addCart.php" method="post">
                <input type="hidden" id="customer" name="customer" value="<?php echo $currentCustomer; ?>">
                <input type="hidden" id="wine_id" name="wine_id" value="<?php echo $wineById['wine_id']; ?>">
                <input type="hidden" name="wine_name" id="wine_name" value="<?php echo $wineById['wine_name']; ?>">
                <input type="hidden" name="wine_price" id="wine_price" value="<?php echo $wineById['price']; ?>">
                <div class="col">
                    <input type="text" name="discount" class="form-control discount-input" placeholder="Discount" aria-label="discount" aria-describedby="discount">
                    <p class="alert m-0 p-0 text-danger d-none">Discount must be number <span id="validDiscount">and max 100!</span></p>
                </div> 
                <input type="hidden" name="winery_name" id="winery_name" value="<?php echo $wineById['winery_name']; ?>">
                <input type="hidden" name="wine_color" id="wine_color" value="<?php echo $wineById['color_name']; ?>">
                <button class="btn btn-dark" type="submit">Add To Winelist</button>
            </form>
            <?php
                }
            ?>
        </div>
    </div>
    <div class="row p-3">
        <div class="col-xs-12 col-sm-6">
            <h5 class="pb-2 border-bottom">Food Pearing</h5>
            <p>
                <?php echo $wineById['foodpearing_desc'] == !"" ? $wineById['foodpearing_desc'] : 'Add a food pearing description!'; ?>
            </p>
        </div>
        <div class="col-xs-12 col-sm-6">
            <h5 class="pb-2 border-bottom">Details</h5>
            <p>
                <?php echo $wineById['details'] == !"" ? $wineById['details'] : 'Add details for wine!'; ?>
            </p>
        </div>
    </div>
</main>
<!-- Footer -->
<?php require __DIR__ . '/../includes/footer.php';?>