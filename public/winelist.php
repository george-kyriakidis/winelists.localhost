<?php

    require __DIR__ . '/../boot/boot.php';

    use Winelists\User;
    use Winelists\Customer;
    use Winelists\Winery;
    use Winelists\Wine;
    use Winelists\Country;
    use Winelists\Area;
    use Winelists\Variety;
    use Winelists\Blended;
    use Winelists\Color;
    use Winelists\Bottle;
    use Winelists\FoodPearing;
    use Winelists\Winelist;

    // Check for logged in user
	$userId = User::getCurrentUserId();
	if (empty($userId)) {
		header('Location: http://winelists.localhost/public/login.php');
		return;
	}
    
    // Get parameters
    $selectedCustomerId = $_REQUEST['customer'];
    $selectedWinelistName = $_REQUEST['winelist_name'];
    $selectedWinelistId = $_REQUEST['winelist_id'];
    $selectedWineryId = $_REQUEST['winery_id'];
    $selectedCountryId = $_REQUEST['country_id'];
    $selectedAreaId = $_REQUEST['area_id'];
    $selectedVarietyOne = $_REQUEST['varietyOne'];
    $selectedVarietyTwo = $_REQUEST['varietyTwo'];
    $selectedVarietyThree = $_REQUEST['varietyThree'];
    $selectedBlended = $_REQUEST['blended'];
    $selectedColorId = $_REQUEST['color'];
    $selectedBottleId = $_REQUEST['bottle'];
    $selectedFoodPearing = $_REQUEST['foodPearing'];
    $selectedWineName = $_REQUEST['searchByName'];

    // Get customer
    $customer = new Customer();
    $allCustomers = $customer->getCustomers();
    
    // Get winery
    $winery = new Winery();
    $wineries = $winery->getWineries();
    
    // Get country 
    $country = new Country();
    $allCountries = $country->getCountries();

    // Get area
    $area = new Area();
    $allAreas = $area->getAreas();

    // Get varieties
    $variety = new Variety();
    $allVarieties = $variety->getVarieties();

    // Get blended for wines
    $blended = new Blended();
    $allBlended = $blended->getBlended();
    
    // Get color of wine
    $color = new Color();
    $winesColor = $color->getColor();
    
    // Get bottle for wine
    $bottle = new Bottle();
    $winesBottle = $bottle->getBottleCategory();

    // Get food pearing for wine
    $foodPearing = new FoodPearing();
    $wineFoodPearing = $foodPearing->getFoodPearing();
    
    // Get wines
    $wine = new Wine();
    $availableWines = $wine->searchWine($selectedWineName, $selectedWineryId, $selectedCountryId, $selectedAreaId, 
                                        $selectedVarietyOne, $selectedVarietyTwo, $selectedVarietyThree,
                                        $selectedBlended, $selectedColorId, $selectedBottleId, $selectedFoodPearing);

    $winelist = new Winelist();
    $currentWinelistId = $winelist->getCurrentWinelistByUserId($userId);
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
    <div class="d-flex justify-content-between">
        <!-- For Search Form -->
        <button class="btn fs-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
            <i class="bi bi-list"></i>
        </button>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Αναζήτηση</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <form action="">
                    <div class="input-group mb-2">
                        <input name="searchByName" id="searchByName" type="text" class="form-control" placeholder="Search by label...">
                        <button class="btn btn-outline-secondary" type="submit" id="searchBtn"><i class="bi bi-search"></i></button>
                    </div>
                    <select name="winery_id" class="form-select mb-2 p-2" aria-label="Default select example">
                        <option value="0"selected>Οινοποιείο</option>
                        <?php
                            foreach ($wineries as $eachWinery) {
                        ?>
                            <option value="<?php echo $eachWinery['winery_id']; ?>"><?php echo $eachWinery['winery_name']; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <select name="country_id" class="form-select mb-2 p-2" aria-label="Default select example">
                        <option value="0"selected>Χώρα</option>
                        <?php
                            foreach ($allCountries as $eachCountry) {
                        ?>
                            <option value="<?php echo $eachCountry['country_id']; ?>"><?php echo $eachCountry['country_name']; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <select name="area_id" class="form-select mb-2 p-2" aria-label="Default select example">
                        <option value="0"selected>Περιοχή</option>
                        <?php
                            foreach ($allAreas as $eachArea) {
                        ?>
                            <option value="<?php echo $eachArea['area_id']; ?>"><?php echo $eachArea['area_name']; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <select name="varietyOne" id="varietyOne" class="form-select mb-2 p-2" aria-label="Default select example">
                        <option value="0"selected>Ποικιλία</option>
                        <?php
                            foreach ($allVarieties as $eachVariety) {
                        ?>
                            <option value="<?php echo $eachVariety['variety_id']; ?>"><?php echo $eachVariety['variety_name']; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <select name="varietyTwo" id="varietyTwo" class="form-select mb-2 p-2" aria-label="Default select example">
                        <option value="0"selected>Ποικιλία</option>
                        <?php
                            foreach ($allVarieties as $eachVariety) {
                        ?>
                            <option value="<?php echo $eachVariety['variety_id']; ?>"><?php echo $eachVariety['variety_name']; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <select name="varietyThree" id="varietyThree" class="form-select mb-2 p-2" aria-label="Default select example">
                        <option value="0"selected>Ποικιλία</option>
                        <?php
                            foreach ($allVarieties as $eachVariety) {
                        ?>
                            <option value="<?php echo $eachVariety['variety_id']; ?>"><?php echo $eachVariety['variety_name']; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <select name="blended" id="blended" class="form-select mb-2 p-2" aria-label="Default select example">
                        <option value="0"selected>Μονοποικιλιακό</option>
                        <?php
                            foreach ($allBlended as $eachBlended) {
                        ?>
                            <option value="<?php echo $eachBlended['blended_id']; ?>"><?php echo $eachBlended['blended_name']; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <select name="color" class="form-select mb-2 p-2" aria-label="Default select example">
                        <option value="0"selected>Χρώμα</option>
                        <?php
                            foreach ($winesColor as $eachColor) {
                        ?>
                            <option value="<?php echo $eachColor['color_id']; ?>"><?php echo $eachColor['color_name']; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <select name="bottle" class="form-select mb-2 p-2" aria-label="Default select example">
                        <option value="0"selected>Φιάλη</option>
                        <?php
                            foreach ($winesBottle as $eachBottle) {
                        ?>
                            <option value="<?php echo $eachBottle['bottle_id']; ?>"><?php echo $eachBottle['bottle_name']; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <select name="foodPearing" class="form-select mb-2 p-2" aria-label="Default select example">
                        <option value="0"selected>Food Pearing</option>
                        <?php
                            foreach ($wineFoodPearing as $eachFoodPearing) {
                        ?>
                            <option value="<?php echo $eachFoodPearing['foodpearing_id']; ?>"><?php echo $eachFoodPearing['foodpearing_desc']; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <button id="btn-custom-style" type="submit" class="btn btn-dark p-2">Search</button>
                </form>
            </div>
        </div>
        <!-- For display winelist -->
        <a class="btn fs-3" href="/public/currentWinelistItems.php?winelist_name=<?php echo $selectedWinelistName;?>
                                                &&customer=<?php echo $selectedCustomerId;?>
                                                &&winelist_id=<?php echo $selectedWinelistId;?>">
            <i class="bi bi-bag"></i>
        </a>
    </div>
    <!-- For display results of search-->
    <div class="row">
        <?php 
            foreach ($availableWines as $eachWine){
        ?>
        <div class="col-sm-4">
            <div class="card border-0">
            <div class="card-body">
                <a href="/public/wine.php?customer=<?php echo $selectedCustomerId; ?>&&wine_id=<?php echo $eachWine['wine_id']; ?>">
                    <h5 class="card-title"><?php echo $eachWine['wine_name']; ?>-<?php echo $eachWine['color_name']; ?></h5>
                </a>
                <p class="card-text"><?php echo $eachWine['variety_name_one']; ?> | <?php echo $eachWine['variety_name_two']; ?> | <?php echo $eachWine['variety_name_three']; ?></p>
                <form action="/public/actions/addCart.php" method="post">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <p class="card-text m-0" id="price"><?php echo $eachWine['price']; ?>€</p>
                        <input type="text" name="discount" class="form-control discount-input me-2" placeholder="%" aria-label="discount" aria-describedby="discount"> 
                        <div>Total Price: <span id="totalPrice"><?php echo $eachWine['price']; ?></span>€</div>
                    </div>
                    <input type="hidden" id="winelist_id" name="winelist_id" value="<?php echo $currentWinelistId['wine_orders_id'];?>">
                    <input type="hidden" id="winelistName" name="winelist_name" value="<?php echo $currentWinelistId['wine_orders_name']; ?>">
                    <input type="hidden" id="customer" name="customer" value="<?php echo $selectedCustomerId; ?>">
                    <input type="hidden" id="wine_id" name="wine_id" value="<?php echo $eachWine['wine_id']; ?>">
                    <input type="hidden" name="wine_name" id="wine_name" value="<?php echo $eachWine['wine_name']; ?>">
                    <input type="hidden" name="wine_price" id="wine_price" value="<?php echo $eachWine['price']; ?>">
                    <input type="hidden" name="winery_name" id="winery_name" value="<?php echo $eachWine['winery_name']; ?>">
                    <input type="hidden" name="wine_color" id="wine_color" value="<?php echo $eachWine['color_name']; ?>">
                    <button id="btn-custom-style" class="btn btn-dark" type="submit">Add To Winelist</button>  
                </form>
            </div>
            </div>
        </div>
        <?php
           }
        ?>
        <!-- Message for no wines in winelist -->
        <?php
            if (count($availableWines) == 0) {
        ?>
        <h4 class="p-2 m-2 text-center">There are no wines</h4>
        <?php
            }
        ?>
    </div>
</main>
<!-- Footer -->
<?php require __DIR__ . '/../includes/footer.php';?>