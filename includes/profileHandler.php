<?php
    session_start();
    include('config/dbconn.php');
    if(isset($_POST['update']))
    {

      $uid=intval($_GET['uid']);
        $name=$_POST['name'];
        $username=$_POST['username'];
        $contact=$_POST['contact'];
      $email=$_POST['email'];

      $pword=$_POST['password'];

      //BCRYPT Password
      $password = password_hash($pword,PASSWORD_BCRYPT);

      $sql="UPDATE users set name=:name,username=:username,contact=:contact,email=:email,password=:password where id=$uid";
      $query = $dbh->prepare($sql);
      $query->bindParam(':name',$name,PDO::PARAM_STR);
      $query->bindParam(':username',$username,PDO::PARAM_STR);
      $query->bindParam(':contact',$contact,PDO::PARAM_STR);
      $query->bindParam(':email',$email,PDO::PARAM_STR);
      $query->bindParam(':password',$password,PDO::PARAM_STR);

      $query->execute();

      if($query->execute())
      {
        $_SESSION['success']="Profile Updated Successfully!";
        header("Location: ../profile.php");
      }  
      
      else{
          
        $_SESSION['success']="Update failed. Please try again";
        header("Location: ../profile.php");
        
      }

    }
    else{
       header("Location: ../profile.php");
    }

?>