<?php

    require __DIR__ . '/../boot/boot.php';
    
    use Winelists\User;
    use Winelists\Winery;
    use Winelists\Variety;
    use Winelists\Blended;
    use Winelists\Color;
    use Winelists\Bottle;
    use Winelists\Wine;

    // Check for logged in user
	$userId = User::getCurrentUserId();
	if (empty($userId)) {
		header('Location: http://winelists.localhost/public/login.php');
		return;
	}

    // Get parameters
    $wineryId = $_REQUEST['winery_id'];
    $selectedVarietyOne = $_REQUEST['varietyOne'];
    $selectedVarietyTwo = $_REQUEST['varietyTwo'];
    $selectedVarietyThree = $_REQUEST['varietyThree'];
    $selectedBlended = $_REQUEST['blended'];
    $selectedColorId = $_REQUEST['color'];
    $selectedBottleId = $_REQUEST['bottle'];

    // Get wineries
    $winery = new Winery();
    $currentWinery = $winery->getWineryById($wineryId);

    // Get varieties
    $variety = new Variety();
    $allVarieties = $variety->getVarieties();

    // Get blended
    $blended = new Blended();
    $allBlended = $blended->getBlended();

    // Get wine color
    $color = new Color();
    $winesColor = $color->getColor();

    // Get bottles category
    $bottle = new Bottle();
    $winesBottle = $bottle->getBottleCategory();

    // Get wines by winery
    $wine = new Wine();
    $wineByWineryId = $wine->getWinesByWinery($wineryId, $selectedVarietyOne, $selectedVarietyTwo, $selectedVarietyThree,
    $selectedBlended, $selectedColorId, $selectedBottleId);

?>
<!-- Header -->
<?php require __DIR__ . '/../includes/header.php';?>
<!-- Main section -->
<main class="container-lg">
    <button onclick="history.back()" class="btn p-0 fs-4"><i class="bi bi-arrow-left"></i></button>
    <!-- Winery's info -->
    <div class="d-flex align-items-center border-bottom">
        <img id="winery-logo" src="/public/assets/images/kir-gianni-logo.jpg" alt="winery-logo">
        <div class="flex-fill ms-3">
            <h5><?php echo $currentWinery['winery_name'];?></h5>
            <h6><?php echo $currentWinery['area_name'];?></h6>
        </div>
    </div>
    <!-- Search Form -->
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
                <input type="hidden" name="winery_id" id="winery_id" value="<?php echo $currentWinery['winery_id']; ?>">
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
                        foreach ($allBlended as $isBlended) {
                    ?>
                    <option value="<?php echo $isBlended['blended_id']; ?>"><?php echo $isBlended['blended_name']; ?></option>
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
                <button id="btn-custom-style" type="submit" class="btn btn-dark p-2">Search</button>
            </form>
        </div>
    </div>
    <!-- Wines by winery -->
    <div class="container">
        <div class="row">
            <?php 
            foreach ($wineByWineryId as $eachWineByWinery) {
            ?>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="card border-0">
                    <a href="/public/wine.php?wine_id=<?php echo $eachWineByWinery['wine_id']; ?>" 
                    class="text-decoration-none text-dark">
                        <div class="view overlay">
                            <img id="wine-image" class="card-img-top mx-auto d-block" src="/public/assets/images/paragkawhite.jpg" alt="wine-photo">
                        </div>
                        <div class="card-body text-center">
                            <h4 class="card-title"><?php echo $eachWineByWinery['wine_name']; ?> <?php echo $eachWineByWinery['color_name']; ?> <?php echo $eachWineByWinery['bottle_name']; ?></h4>
                            <div class="d-flex justify-content-center">
                                <p><?php echo $eachWineByWinery['variety_name_one']; ?></p>
                                <p><?php echo $eachWineByWinery['variety_name_two']; ?></p>
                                <p><?php echo $eachWineByWinery['variety_name_three']; ?></p>
                            </div>
                            <p class="card-text"><?php echo $eachWineByWinery['short_desc'] == !"" ? $eachWineByWinery['short_desc'] : 'Add a short description!'; ?></p>
                        </div>
                    </a>
                </div>
            </div>
            <?php
                }
            ?>
            <!-- Message for no wines available-->
            <?php
                if (count($wineByWineryId) == 0) {
            ?>
            <h4 class="p-2 m-2 text-center">There are no wines available</h4>
            <?php
                }
            ?>
        </div>
    </div>
</main>
<!-- Footer -->
<?php require __DIR__ . '/../includes/footer.php';?>