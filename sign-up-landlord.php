<?php

session_start();
unset($_SESSION['uid']);
include('includes/config/dbconn.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Property Listing</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <!-- Header -->
    <?php include('includes/header.php'); ?>
    <br>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>

    <div class="container-xxl bg-white p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex flex-column align-items-center justify-content-center text-center mb-5 wow slideInLeft" data-wow-delay="0.1s" style="background: aliceblue; padding: 1rem;">
                        <h1 class="mb-3">Register</h1>
                        <p>Sign up with Dorm Spot!</p>
                    </div>
                </div>
            </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-9 mx-auto">
                    <div class="overflow-hidden">
                        <div class="card-img-left d-none d-md-flex">
                        </div>
                        <div class="card-body p-4 p-sm-5">
                            <?php                    
          
          if(isset($_SESSION['error'])){

            ?>

                            <br>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Notice: </strong> <?php echo $_SESSION['error']; ?>
                                </button>
                            </div>

                            <?php
            unset($_SESSION['success']);

        }
        ?>
                            <form action="includes/landlordRegisterHandler.php" method="post" autocomplete="off">

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="uname" placeholder="Enter Username"
                                        name="uname"  autocomplete="off" required> <label
                                        for="floatingInputUsername">Username</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="name" id="floatingInputUsername"
                                        placeholder="full name" required>
                                    <label for="floatingInputUsername">Full Name</label>
                                </div>



                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" name="contact" pattern="[0-9]+"
                                        id="floatingInputEmail" placeholder="contact no" required>
                                    <label for="floatingInputEmail">Contact No</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" name="email"
                                        pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Invalid email address"
                                        id="floatingInputEmail" placeholder="name@example.com" required>
                                    <label for="floatingInputEmail">Email address</label>
                                </div>

                                <hr>

                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" name="password" id="floatingPassword"
                                        placeholder="Password" required>
                                    <label for="floatingPassword">Create a Password</label>
                                </div>


                                <div class="d-grid mb-2">
                                    <button class="btn btn-primary btn-login fw-bold text-uppercase"
                                        name="register" id="register" type="submit">Register</button>
                                </div>

                                <a class="d-block text-center mt-2 small" href="admin/signin.php">Already have an landlord account? Sign
                                    In</a>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <?php include('includes/footer.php'); ?>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>