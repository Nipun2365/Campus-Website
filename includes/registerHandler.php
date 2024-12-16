<?php
    session_start();

    include('config/dbconn.php');
    if(isset($_POST['register']))
    {

      $name=$_POST['name'];
      $username=$_POST['uname'];
      $contact=$_POST['contact'];
      $email=$_POST['email'];

      $password=$_POST['password'];

      //BCRYPT Password
      $bpassword = password_hash($password,PASSWORD_BCRYPT);


      $sql = "INSERT INTO users(name,username,contact,email,password) VALUES
      ('$name', '$username', '$contact', '$email', '$bpassword')";
      $query = $dbh->prepare($sql);
      $query->execute();

      $lastInsertId = $dbh->lastInsertId();

      if($lastInsertId)
      {
        $_SESSION['success']="Registered Successfully. Please Log In";
        header("Location: ../sign-in.php");
      }  
      
      else{
          
        $_SESSION['error']="Registration Failed. Please Try Again";
        header("Location: ../sign-up.php");
        
      }

    }
    else{
        header("Location: ../sign-up.php");
    }

?>