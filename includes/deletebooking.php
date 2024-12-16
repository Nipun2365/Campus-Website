<?php
session_start();
include('../../includes/config/dbconn.php');


$uid=intval($_GET['uid']);

        $sql="DELETE FROM `users` where `id` = $uid";


        if ($dbh->query($sql) === TRUE) {
            $_SESSION['success']="Booking deleted successfully!";
            header('location:../manage-users.php');
        } else {
            header('location:../manage-users.php');
        }

?>