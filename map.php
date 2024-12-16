<?php

session_start();
include('includes/config/dbconn.php');

$sql = "SELECT * FROM properties WHERE status='Approved';";
$stmt = $dbh->query($sql);

$properties = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Echo the properties in JSON format
echo '<script>';
echo 'var properties = ' . json_encode($properties) . ';';
echo '</script>';

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
        <!-- Header -->
        <?php include('includes/header.php'); ?>

        <div class="container-xxl py-5" style="height: 100vh;">
            <div class="container-xxl">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex flex-column align-items-center justify-content-center text-center mb-5 wow slideInLeft" data-wow-delay="0.1s" style="background: aliceblue; padding: 1rem;">
                        <h1 class="mb-3">Property Finder</h1>
                        <p><h6>Discover the perfect place for your Stay!</h6></p>
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