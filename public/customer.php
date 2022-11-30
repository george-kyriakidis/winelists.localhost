<?php

    require __DIR__ . '/../boot/boot.php';
        
    use Winelists\User;
    use Winelists\Customer;
    use Winelists\PrActivity;

    // Check for logged in user
    $userId = User::getCurrentUserId();
    if (empty($userId)) {
        header('Location: http://winelists.localhost/public/login.php');
        return;
    }

    // Get parameters
    $customerId = $_REQUEST['customer_id'];

    // Get customer's info
    $customer = new Customer();
    $customerById = $customer->getCustomerById($customerId);
    
    // Get activities for customers
    $activity = new PrActivity();
    $allActivities = $activity->getActivity();
?>
<!-- Header -->
<?php require __DIR__ . '/../includes/header.php';?>
<!-- Main section -->
<main class="container">
    <button onclick="history.back()" class="btn p-0 fs-4"><i class="bi bi-arrow-left"></i></button>
    <div class="col pt-4">
        <input type="hidden" name="customer_id" id="customer_id" value=<?php echo $customerId;?>>
        <?php
            if($customerId !=""){
        ?>
        <div class="form-row">
            <div class="col-8 mx-auto d-flex justify-content-between mb-2">
                <h3><?php echo $customerById['customer_name']; ?></h3>
                <form action="/public/actions/customer.php" method="post">
                    <input type="hidden" name="customer_id" id="customer_id" value=<?php echo $customerId;?>>
                    <button class="btn btn-dark" name="delete" style="border-radius:0;"><i class="bi bi-trash"></i></button>
                </form>
            </div>
        </div>
        <?php
            }
        ?>
        <form action="/public/actions/customer.php" method="post">
            <div class="form-row">
                <div class="col-8 mx-auto">
                    <input id="fullName" name="name" type="text" placeholder="Full Name" class="form-control p-2 mb-2" value="<?php echo $customerById['customer_name']; ?>">
                    <p class="alert-fullName text-danger p-0">*Must be only characters with one space between!!</p>
                </div>
            </div>
            <div class="form-row">
                <div class="col-8 mx-auto">
                    <input id="phone" name="phone" type="tel" placeholder="Phone Number" class="form-control p-2 mb-2" value="<?php echo $customerById['customer_phone']; ?>">
                    <p class="alert-phone text-danger p-0">*Must be a valid Phone Number!!</p>
                </div>
            </div>
            <div class="form-row">
                <div class="col-8 mx-auto">
                        <input id="email" name="email" type="email" placeholder="Email Address" class="form-control p-2 mb-2" value="<?php echo $customerById['customer_email']; ?>">
                    <p class="alert-email text-danger p-0">*Must be a valid email address!!</p>
                </div>
            </div>
            <div class="form-row">
                <div class="col-8 mx-auto">
                    <input id="vatNumber" name="vat" type="tel" placeholder="VAT Number" class="form-control p-2 mb-2" value="<?php echo $customerById['customer_vat']; ?>">
                    <p class="alert-vat text-danger p-0">*Must be a valid VAT Number!!</p>
                </div>
            </div>
            <div class="form-row">
                <div class="col-8 mx-auto">
                <select id="activity" name="activity" class="form-select mb-2 p-2" aria-label="Default select example">
                        <option value="0"selected>Δραστηριότητα</option>
                        <?php
                            foreach ($allActivities as $eachActivity) {
                        ?>
                        <option value="<?php echo $eachActivity['pr_activity_id'];?>" 
                                        <?php echo $customerById['pr_activity_id'] == $eachActivity['pr_activity_id']? "selected" : "" ?>>
                                        <?php echo $eachActivity['pr_activity_name'];?>
                                        
                        </option>
                        <?php
                            }
                        ?>
                    </select>
                    <p class="alert-activity text-danger p-0">*Must choose activity!!</p>
                </div>
            </div>
            <?php
                if($customerId !=""){
            ?>
            <div class="form-row">
                <div class="col-8 mx-auto">
                    <input type="hidden" name="customer_id" id="customer_id" value=<?php echo $customerId;?>>
                    <button type="submit" name="update" id="customerSubmit" style="border-radius:0;" class="btn btn-dark col-4 p-2 disabled">Update</button>
                </div>
            </div>
            <?php
                }else{
            ?>
            <div class="form-row">
                <div class="col-8 mx-auto">
                    <button type="submit" name="submit" id="customerSubmit" style="border-radius:0;" class="btn btn-dark col-4 p-2 disabled">Submit</button>
                </div>
            </div>
            <?php
                }
            ?>
        </form>
    </div>
</main>
<!-- Footer -->
<?php require __DIR__ . '/../includes/footer.php';?>