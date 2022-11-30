<?php

	require __DIR__ . '/../boot/boot.php';

    use Winelists\User;

    if(!empty(User::getCurrentUserId())) {
		header('Location: http://winelists.localhost/public/dashboard.php'); die;
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>Winelists - Log In</title>
</head>
<body>
    <div class="container-fluid ps-0 pe-0">
        <header class="bg-dark p-3 d-flex justify-content-between align-items-center mb-3">
            <a class="text-decoration-none text-light" href="/public/dashboard.php">WINELISTS</a>
            <div>
                <ul class="d-inline-flex align-items-center mb-0 ps-0">
                    <li class="list-unstyled"><a class="text-decoration-none me-2 text-light" href=""><i class="bi bi-person-circle"></i></a></li>
                    <li class="list-unstyled"><i class="bi bi-box-arrow-right text-light"></i></li>
                </ul>
            </div>
        </header>
        <main class="container">
            <div class="row">
                <div class="col-lg-6">
                    <img class="img-fluid" src="/public/assets/images/winelist-logo.jpg" alt="winelist-logo">
                </div>
                <div class="col-lg-6">
                    <h1 class="pt-5 mb-4">Sign into your account</h1>
                    <form action="/public/actions/login.php" method="post">
                        <div class="form-row">
                            <div class="col-lg-7 mb-3">
                                <input id="email" type="email" placeholder="Email Address" class="form-control p-2" name="email">
                                <p class="alert-email text-danger p-0">*Must be a valid email address!!</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-7 mb-3">
                                <input id="password" type="password" placeholder="Password" class="form-control p-2" name="password">
                                <p class="alert-password text-danger p-0">*Password must have at least 8 characters!!</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-7 mb-3">
                                <button id="login" style="width:100%;border-radius:0;"type="submit" class="btn btn-dark p-2 disabled">Log In</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </main>
    </div>
    <!-- Scripts -->
    <script src="/public/assets/js/login.js"></script>
    <!-- Bootstrap Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
    crossorigin="anonymous"></script>
</body>
</html>