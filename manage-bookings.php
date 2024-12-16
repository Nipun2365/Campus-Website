<?php
session_start();
include('../includes/config/dbconn.php');


if(strlen($_SESSION['aid'])==NULL){
    header('location:signin.php');
}

if(isset($_SESSION['aid'])){
    $userID=$_SESSION['aid'];

    $sql ="SELECT userType FROM users WHERE id=$userID";
    $query= $dbh -> prepare($sql);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);

    $_SESSION['AdminUserType'] = 'Admin';

    if($query->rowCount() > 0)
    {
        foreach ($results as $result) {
            $userType = $result->userType;
            $_SESSION['AdminUserType'] = $userType;
        }
    }
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
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Sidebar -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">

                <img class="navbar-brand mx-4 mb-3" src="includes/logo/ps.png" alt="DriveNow"
                    style="width: 180px; height: 50px;">

                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Dashboard</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="dashboard.php" class="nav-item nav-link"><i
                            class="fa fa-cubes me-2"></i>Dashboard</a>
                            <?php if(isset($_SESSION['AdminUserType']) && $_SESSION['AdminUserType'] != 'Landlord') { ?>
                                <a href="manage-users.php" class="nav-item nav-link"><i class="fa fa-user me-2"></i>Manage
                                Users</a>
                            <?php } ?>
                        <a href="manage-properties.php" class="nav-item nav-link"><i class="fa fa-home me-2"></i>Manage Property</a>
                    <a href="manage-bookings.php" class="nav-item nav-link active"><i class="fa fa-book me-2"></i>Manage
                        Bookings</a>
                </div>
            </nav>
        </div>

        <div class="content">
            <!-- Navbar -->
            <nav class="navbar navbar-expand bg-light sticky-top px-4 py-0">
                <img class="navbar-brand d-flex d-lg-none me-4" src="includes/logo/ps.png" alt="DriveNow"
                    style="width: 180px; height: 50px;">
                <div class="navbar-nav align-items-center ms-auto">

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt=""
                                style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">My Profile</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        <a href="dashboard.php" class="dropdown-item">Dashboard</a>
                        <?php if(isset($_SESSION['AdminUserType']) && $_SESSION['AdminUserType'] != 'Landlord') { ?>
                                <a href="manage-users.php" class="dropdown-item">Manage
                                Users</a>
                            <?php } ?>
                            <a href="manage-properties.php" class="dropdown-item">Manage Properties</a>
                            <a href="manage-bookings.php" class="dropdown-item">Manage Rent Requests</a>
                            <a href="signin.php" class="dropdown-item">Sign Out</a>
                        </div>
                    </div>
                </div>
            </nav>



            <!-- Recent property tour booking -->
            <div class="container-fluid pt-4 px-4">
                <?php                    
          
                if(isset($_SESSION['success'])){

                ?>

                <br>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Notice: </strong> <?php echo $_SESSION['success']; ?>
                    </button>
                </div>

                <?php
                    unset($_SESSION['success']);

                }

                if(isset($_SESSION['error'])){

                ?>

                <br>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Notice: </strong> <?php echo $_SESSION['error']; ?>
                    </button>
                </div>

                <?php
                unset($_SESSION['error']);

                }
                ?>

                <!-- Table -->
                <div class="container mt-5">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Client Name</th>
                                            <th>Property Name</th>
                                            <th>Rent Price</th>
                                            <th>Booking Date</th>
                                            <th>Time</th>
                                            <th>Message</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    
                                    if(isset($_SESSION['AdminUserType']) && $_SESSION['AdminUserType'] == 'Landlord') { 
                                        //$userID=$_SESSION['aid'];
                                        $userID=28;
                                        $sql = "SELECT p.*, u.name as uname, b.id as bid, b.date, b.time, b.message, b.status from properties p, booking b, users u where b.uid=u.id and b.pid=p.id and p.ownerID=28 group by b.id order by b.id DESC";
                                    } else {
                                        $sql = "SELECT p.*, u.name as uname, b.id as bid, b.date, b.time, b.message, b.status from properties p, booking b, users u where b.uid=u.id and b.pid=p.id group by b.id order by b.id DESC";
                                    }

                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                    foreach($results as $result)
                                    {               ?>
                                        <tr>
                                            <td> <?php echo htmlentities($cnt);?></td>

                                            <td><?php echo htmlentities($result->uname);?></td>

                                            <td><?php echo htmlentities($result->name);?></td>

                                            <td><?php echo htmlentities($result->price);?></td>

                                            <td><?php echo htmlentities($result->date);?></td>

                                            <td><?php echo htmlentities($result->time);?></td>

                                            <td><?php echo htmlentities($result->message);?></td>

                                            <td><?php echo htmlentities($result->status);?></td>

                                            <td>
                                                <a href="editbooking.php?bid=<?php echo htmlentities($result->bid);?>"
                                                    class="edit" title="Edit" data-toggle="tooltip"><i
                                                        class="fa fa-pen"></i></a>
                                                <a href="includes/deletebooking.php?bid=<?php echo htmlentities($result->bid);?>"
                                                    class="delete" title="Delete" data-toggle="tooltip"
                                                    onclick="return confirm('Are you sure you want to delete this booking?');"><i
                                                        class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>

                                        <?php $cnt++;} }?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Javascript -->
    <script src="js/main.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>
</body>

</html>