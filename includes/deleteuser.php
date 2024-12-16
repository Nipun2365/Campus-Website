<?php
session_start();
include('../../includes/config/dbconn.php');


$uid=intval($_GET['uid']);

        $sql="DELETE FROM `users` where `id` = $uid";

       //$sql="DELETE FROM employees WHERE empid=:empid";

        if ($dbh->query($sql) === TRUE) {
            $_SESSION['success']="User removed successfully!";
            header('location:../manage-users.php');
        } else {
            header('location:../manage-users.php');
        }

?>