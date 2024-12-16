<?php
session_start();
include('../../includes/config/dbconn.php');
    if(isset($_POST['update']))
    {

      $pid=intval($_GET['pid']);
      $name=$_POST['name'];
      $address=$_POST['address'];
      $squarefeet=$_POST['squarefeet'];
      $nobeds=$_POST['nobeds'];
      $nobathrooms=$_POST['nobathrooms'];
      $price=$_POST['price'];
      $latitude=$_POST['latitude'];
      $longitude=$_POST['longitude'];
      $status=$_POST['status'];

      $files=$_FILES['file']['name'];

      if($files) {

        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $path = "uploads/".$fileName;
        move_uploaded_file($fileTmpName,$path);

        $image = $fileName;

        $sql="UPDATE properties set name=:name,address=:address,squarefeet=:squarefeet,nobeds=:nobeds,nobathrooms=:nobathrooms,price=:price,latitude=:latitude,longitude=:longitude,status=:status,image=:image where id=$pid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':name',$name,PDO::PARAM_STR);
        $query->bindParam(':address',$address,PDO::PARAM_STR);
        $query->bindParam(':squarefeet',$squarefeet,PDO::PARAM_STR);
        $query->bindParam(':nobeds',$nobeds,PDO::PARAM_STR);
        $query->bindParam(':nobathrooms',$nobathrooms,PDO::PARAM_STR);
        $query->bindParam(':price',$price,PDO::PARAM_STR);
        $query->bindParam(':latitude',$latitude,PDO::PARAM_STR);
        $query->bindParam(':longitude',$longitude,PDO::PARAM_STR);
        $query->bindParam(':image',$image,PDO::PARAM_STR);
        $query->bindParam(':status',$status,PDO::PARAM_STR);

      } else {

      $sql="UPDATE properties set name=:name,address=:address,squarefeet=:squarefeet,nobeds=:nobeds,nobathrooms=:nobathrooms,price=:price,latitude=:latitude,longitude=:longitude,status=:status where id=$pid";
      $query = $dbh->prepare($sql);
      $query->bindParam(':name',$name,PDO::PARAM_STR);
      $query->bindParam(':address',$address,PDO::PARAM_STR);
      $query->bindParam(':squarefeet',$squarefeet,PDO::PARAM_STR);
      $query->bindParam(':nobeds',$nobeds,PDO::PARAM_STR);
      $query->bindParam(':nobathrooms',$nobathrooms,PDO::PARAM_STR);
      $query->bindParam(':price',$price,PDO::PARAM_STR);
      $query->bindParam(':latitude',$latitude,PDO::PARAM_STR);
      $query->bindParam(':longitude',$longitude,PDO::PARAM_STR);
      $query->bindParam(':status',$status,PDO::PARAM_STR);

      }

      $query->execute();

      if($query->execute())
      {
        $_SESSION['success']="Property details updated successfully!";
        header("Location: ../manage-properties.php");
      }  
      
      else{
          
        $_SESSION['error']="Unable to update. Please check the details and try again";
        header("Location: ../manage-properties.php");
        
      }

    }
    else{
        header("Location: ../manage-properties.php");
    }

?>