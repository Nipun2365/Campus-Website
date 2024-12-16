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

    <!--  Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">

        <?php include('includes/header.php'); ?>

        <div class="container-xxl py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex flex-column align-items-center justify-content-center text-center mb-5 wow slideInLeft" data-wow-delay="0.1s" style="background: aliceblue; padding: 1rem;">
                            <h1 class="mb-3">Property Details</h1>
                            <p>Need more information?.. Feel free to reach us for any enquiries.</p>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">

                            <?php 
                                    $propertyid=intval($_GET['propertyid']);

                                    $sql = "SELECT * from properties where id=$propertyid";
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;

                                    $stmt = $dbh->query($sql);

                                    $properties = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    // Echo the properties in JSON format
                                    echo '<script>';
                                    echo 'var properties = ' . json_encode($properties) . ';';
                                    echo '</script>';

                                    if($query->rowCount() > 0)
                                    {
                                    foreach($results as $result)
                                    {               ?>


                            <div class="col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a ><img
                                                style="height: 300px; width: 100%;" class="img-fluid"
                                                src="admin/includes/uploads/<?php echo htmlentities($result->image);?>"
                                                alt="Image"></a>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <a class="d-block h5 mb-2"
                                            >
                                            <?php echo htmlentities($result->name);?></a>
                                        <p><i class="fa fa-map-marker text-primary me-2"></i><?php echo htmlentities($result->address);?></p>
                                        <p><i class="fa fa-bath text-primary me-2"></i>No of Bathrooms: <?php echo htmlentities($result->nobathrooms);?></p>
                                        <p><i class="fa fa-bed text-primary me-2"></i>No of Bedrooms: <?php echo htmlentities($result->nobeds);?></p>
                                        <hr>
                                        <h5 class="text-primary mb-3">Rs. <?php echo htmlentities($result->price);?> Per Month</h5>
                                    </div>
                                </div>
                            </div>

                            <?php } }?>

                            <div class="col-md-6 wow fadeInUp" data-wow-delay="0.3s">

                                <div class="p-4 pb-0">
                                    <a style="color: #0E2E50; font-size: 22px; font-weight: bold;">Request to rent this property</a>
                                </div>
                                <hr class="my-4">

                                <form
                                    action="includes/bookingHandler.php?propertyid=<?php echo htmlentities(intval($_GET['propertyid']));?>"
                                    method="post">

                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control" name="bookingDate" placeholder="From date"
                                            required>
                                        <label for="floatingInputEmail">Request Date</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="time" placeholder="To date"
                                            required>
                                        <label for="floatingInputEmail">Arrival Time</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="message"
                                            placeholder="Description" required>
                                        <label for="floatingPassword">Message</label>
                                    </div>


                                    <div class="d-grid mb-2">
                                        <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase"
                                            name="book" type="submit">Book Now</button>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBI7hQ4AOd1FT3tr5MtUmfYFMty12BsR0s&callback=initMap&libraries=maps,marker&v=beta"></script>

        <div id="map" style="width: 100%; height: 450px; padding-bottom: 20px;"></div>

        <script>
                function initMap() {
                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 14,
                        center: {lat: 6.821520805358887, lng: 80.04154968261719}
                    });

                    for (var i = 0; i < properties.length; i++) {
                        var property = properties[i];
                        var marker = new google.maps.Marker({
                            position: {lat: parseFloat(property.latitude), lng: parseFloat(property.longitude)},
                            map: map
                        });

                        (function (property) {
                            var contentString = '<div id="content">' +
                                '<div id="siteNotice">' +
                                '</div>' +
                                '<h6 id="firstHeading" class="firstHeading">' + property.name + '</h6>' +
                                '<div id="bodyContent">' +
                                '<p><b>Rent:</b> LKR ' + property.price + ' Per Month</p>' +
                                '<p><b>Address:</b> ' + property.address + '</p>' +
                                '</div>' +
                                '</div>';

                            var infoWindow = new google.maps.InfoWindow({
                                content: contentString
                            });

                            marker.addListener('click', function () {
                                infoWindow.open(map, this);
                            });
                        })(property);
                            }
                        }
            </script>


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