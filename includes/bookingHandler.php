<?php
session_start();
include('../../includes/config/dbconn.php');
    if(isset($_POST['update']))
    {

      $bid=intval($_GET['bid']);
        $date=$_POST['date'];
        $time=$_POST['time'];
        $status=$_POST['status'];

      $sql="UPDATE booking set date=:date,time=:time,status=:status where id=$bid";
      $query = $dbh->prepare($sql);
      $query->bindParam(':date',$date,PDO::PARAM_STR);
      $query->bindParam(':time',$time,PDO::PARAM_STR);
      $query->bindParam(':status',$status,PDO::PARAM_STR);

      $query->execute();

      if($query->execute())
      {
        $_SESSION['success']="Booking details updated successfully!";
        header("Location: ../manage-bookings.php");
      }  
      
      else{
          
        $_SESSION['error']="Unable to update. Please check the details and try again";
        header("Location: ../manage-bookings.php");
        
      }

    }
    else{
        header("Location: ../manage-bookings.php");
    }

?>