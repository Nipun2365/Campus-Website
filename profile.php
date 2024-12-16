<?php
session_start();
include('includes/config/dbconn.php');

if(strlen($_SESSION['uid']) == NULL) {
    $_SESSION['error'] = "Please sign in to access this page.";
    header('location: sign-in.php');
    exit(); // Adding exit to stop further execution
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>My Profile</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">

    <!-- Icon Font  -->
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
    <!-- Header -->
    <?php include('includes/header.php'); ?>
    <br>

    <div class="container-xxl bg-white p-0">
        <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex flex-column align-items-center justify-content-center text-center mb-5 wow slideInLeft" data-wow-delay="0.1s" style="background: aliceblue; padding: 1rem;">
                        <h1 class="mb-3">My Profile</h1>
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
                            if(isset($_SESSION['success'])) {
                            ?>

                            <br>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Notice: </strong> <?php echo $_SESSION['success']; ?>
                            </div>

                            <?php
                                unset($_SESSION['success']);
                            }

                            if(isset($_SESSION['error'])) {
                            ?>

                            <br>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Notice: </strong> <?php echo $_SESSION['error']; ?>
                            </div>

                            <?php
                                unset($_SESSION['error']);
                            }
                            ?>

                            <form action="includes/profileHandler.php?uid=<?php echo htmlentities($_SESSION['uid']); ?>"
                                method="post">

                                <?php 
                                $uid = $_SESSION['uid'];
                                $sql = "SELECT * FROM users WHERE id=:id";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':id', $uid, PDO::PARAM_INT);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if($query->rowCount() > 0) {
                                    foreach($results as $result) {
                                ?> 

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="name" id="floatingInputUsername"
                                        value="<?php echo htmlentities($result->name);?>" required>
                                    <label for="floatingInputUsername">Full Name</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="username" id="floatingInputUsername"
                                        value="<?php echo htmlentities($result->username);?>" required>
                                    <label for="floatingInputUsername">Create a Username</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" name="contact" id="floatingInputEmail"
                                        value="<?php echo htmlentities($result->contact);?>" required autofocus>
                                    <label for="floatingInputEmail">Contact No</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" name="email" id="floatingInputEmail"
                                        value="<?php echo htmlentities($result->email);?>" required autofocus>
                                    <label for="floatingInputEmail">Email address</label>
                                </div>

                                <hr>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="password" id="floatingPassword">
                                    <label for="floatingPassword">Change Password</label>
                                </div>

                                <div class="d-grid mb-2">
                                    <button class="btn btn-primary btn-login fw-bold text-uppercase"
                                        name="update" type="submit">Update Profile</button>
                                </div>

                                <hr class="my-4">

                                <?php 
                                    }
                                } 
                                ?>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


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

