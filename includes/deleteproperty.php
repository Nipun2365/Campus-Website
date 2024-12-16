<?php
session_start();
include('../../includes/config/dbconn.php');


$pid=intval($_GET['pid']);

        $sql="DELETE FROM `properties` where `id` = $pid";

        if ($dbh->query($sql) === TRUE) {
            $_SESSION['success']="Property details removed successfully!";
            header('location:../manage-properties.php');
        } else {
            header('location:../manage-properties.php');
        }

?>