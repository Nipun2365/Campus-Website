<?php

session_start();
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

    <!-- Libraries  -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!--  Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <?php include('includes/header.php'); ?>

        <div class="container-xxl py-5" style="height: 100vh;">
            <div class="container-xxl">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex flex-column align-items-center justify-content-center text-center mb-5 wow slideInLeft" data-wow-delay="0.1s" style="background: aliceblue; padding: 1rem;">
                            <h1 class="mb-3">About Us</h1>
                            <p><h6>Discover the perfect place for your Stay!</h6></p>
                        </div>
                    </div>
                </div>
                <div class="row g-5 align-items-center" style="margin-top: 1px;">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="position-relative overflow-hidden p-5 pe-0" style="margin-top: -6rem;">
                            <img class="img-fluid w-100" src="img/ab.jpg">
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" style="margin-top: 0;" data-wow-delay="0.5s">
                        <h1 class="mb-4">Welcome to Dorm Spot!</h1>
                        <p class="mb-4">Dorm Spot is your dedicated platform for finding the ideal accommodation tailored specifically for NSBM students. With a focus on convenience and comfort, we strive to simplify the process of locating the perfect dormitory or property to suit your needs. Our user-friendly interface provides comprehensive listings, complete with essential details and images, ensuring you make informed decisions. Whether you're seeking a cozy dorm close to campus or a modern apartment with all the amenities, Dorm Spot has you covered.</p>
                        <p class="mb-4"> Our commitment is to offer a seamless and hassle-free experience, guiding you towards your ideal living space during your academic journey at NSBM University. Let Dorm Spot be your trusted partner in finding the perfect spot to call home during your time at NSBM. Start your search today and discover the perfect living space with Dorm Spot!</p>
                        <a class="btn btn-primary py-3 px-5 mt-3 mb-5" href="property-list.php">Find you Stay</a>
                    </div>
                </div>
            </div>

            <?php include('includes/footer.php'); ?>

        </div>

    </div>

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