<?php
session_start();
include('includes/config/dbconn.php');


if(strlen($_SESSION['uid'])==NULL){
    $_SESSION['error']="Please sign in to access this page.";
    header('location:sign-in.php');
}

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
</head>

<body>
    <div class="container-xxl bg-white p-0">

        <?php include('includes/header.php'); ?>

        <div class="container-xxl py-5">
            <div class="container-xxl">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex flex-column align-items-center justify-content-center text-center mb-5 wow slideInLeft" data-wow-delay="0.1s" style="background: aliceblue; padding: 1rem;">
                            <h1 class="mb-3">Booking Requests</h1>
                            <p>My Booking Requests</p>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">

                            <?php 
                                    $uid=$_SESSION['uid'];
                                    $sql = "SELECT p.*, b.date, b.time, b.message, b.status from properties p, booking b where p.id=b.pid AND b.uid=$uid";
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                    foreach($results as $result)
                                    {               ?>

                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a><img style="height: 300px; width: 100%;" class="img-fluid"
                                                src="admin/includes/uploads/<?php echo htmlentities($result->image);?>"
                                                alt="Image"></a>
                                        <?php 

                                        if($result->status == "Approved"){ ?>

                                        <div
                                            class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                            Approved</div>

                                        <?php }else if($result->status == "Declined"){ ?>

                                        <div
                                            class="bg-secondary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                            Declined</div>

                                        <?php }else{ ?>

                                        <div
                                            class="bg-dark rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                            Approval Pending</div>

                                        <?php }?>

                                    </div>
                                    <div class="p-4 pb-0">
                                        <a style="color: #0E2E50; font-size: 22px; font-weight: bold;">
                                            <?php echo htmlentities($result->name);?></a>
                                        <p><i class="fa fa-info-circle text-primary me-2"></i>Request Description:
                                            <?php echo htmlentities($result->message);?></p>
                                        <p><i class="fa fa-calendar text-primary me-2"></i>Request Date:
                                            <?php echo htmlentities($result->date);?></p>
                                        <p><i class="fa fa-clock text-primary me-2"></i>Time:
                                            <?php echo htmlentities($result->time);?></p>
                                        <hr>
                                        <h5 class="text-primary mb-3">Rs. <?php echo htmlentities($result->price);?> Per Month</h5>
                                    </div>
                                </div>
                            </div>

                            <?php } }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php include('includes/footer.php'); ?>

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