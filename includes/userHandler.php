<?php

session_start();
include('../../includes/config/dbconn.php');
    if(isset($_POST['update']))
    {

      $uid=intval($_GET['uid']);
        $name=$_POST['name'];
        $username=$_POST['username'];
        $contact=$_POST['contact'];
      $email=$_POST['email'];

      $sql="UPDATE users set name=:name,username=:username,contact=:contact,email=:email where id=$uid";
      $query = $dbh->prepare($sql);
      $query->bindParam(':name',$name,PDO::PARAM_STR);
      $query->bindParam(':username',$username,PDO::PARAM_STR);
      $query->bindParam(':contact',$contact,PDO::PARAM_STR);
      $query->bindParam(':email',$email,PDO::PARAM_STR);

      $query->execute();

      if($query->execute())
      {
        $_SESSION['success']="User details updated successfully!";
        header("Location: ../manage-users.php");
      }  
      
      else{
          
        $_SESSION['error']="Unable to update. Please check the details and try again";
        header("Location: ../manage-users.php");
        
      }

    }
    else{
        header("Location: ../manage-users.php");
    }

?>