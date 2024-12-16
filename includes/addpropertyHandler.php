<?php
session_start();
    include('../../includes/config/dbconn.php');
    if(isset($_POST['add']))
    {

      if(isset($_SESSION['aid'])){
        $userID=$_SESSION['aid'];
      } 

      $fileName = $_FILES['file']['name'];
      $fileTmpName = $_FILES['file']['tmp_name'];
      $path = "uploads/".$fileName;

      $name=$_POST['name'];
      $address=$_POST['address'];
      $squarefeet=$_POST['squarefeet'];
      $nobeds=$_POST['nobeds'];
      $nobathrooms=$_POST['nobathrooms'];
      $price=$_POST['price'];
      $latitude=$_POST['latitude'];
      $longitude=$_POST['longitude'];

    $sql = "INSERT INTO properties(name,address,squarefeet,nobeds,nobathrooms,price,image,latitude,longitude,status,ownerID) VALUES
    ('$name', '$address', '$squarefeet', '$nobeds', '$nobathrooms', '$price', '$fileName', '$latitude', '$longitude','Pending','$userID')";
    $query = $dbh->prepare($sql);
    $query->execute();

    $lastInsertId = $dbh->lastInsertId();

    if($lastInsertId)
      {
        move_uploaded_file($fileTmpName,$path);
        $_SESSION['success']="Property added successfully!";
        header("Location: ../manage-properties.php");
      }  
      
      else{
          
        $_SESSION['error']="Unable to submit. Please check the details and try again";
        header("Location: ../add-property.php");
        
      }

    }
    else{
        header("Location: ../manage-properties.php");
    }

?>