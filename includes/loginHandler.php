<?php

    include('../../includes/config/dbconn.php');
    if(isset($_POST['signin']))
    {
      $email=$_POST['email'];

      $sql ="SELECT email,password,id FROM admin WHERE email=:email";
      $query= $dbh -> prepare($sql);
      $query-> bindParam(':email', $email, PDO::PARAM_STR);
      $query-> execute();
      $results=$query->fetchAll(PDO::FETCH_OBJ);

      if($query->rowCount() > 0)
      {
        foreach ($results as $result) {
          //verify bcrypt hash password
          if(password_verify($_POST['password'], $result->password)){
          session_start();
          $_SESSION['aid']=$result->id;
          header("Location: ../dashboard.php");
          } else{
            header("Location: ../signin.php");
          }
        }
      }
      else {

        $email=$_POST['email'];

        $sql ="SELECT email,password,id FROM users WHERE email=:email AND userType='Landlord'";
        $query= $dbh -> prepare($sql);
        $query-> bindParam(':email', $email, PDO::PARAM_STR);
        $query-> execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
  
  
        if($query->rowCount() > 0)
        {
          foreach ($results as $result) {
            //verify bcrypt hash password
            if(password_verify($_POST['password'], $result->password)){
            session_start();
            $_SESSION['aid']=$result->id;
            header("Location: ../dashboard.php");
            } else{
              header("Location: ../signin.php");
            }
          }
        }else{
          echo "<script>alert('Invalid email or password, Please try again!');</script>";
          header("Location: ../signin.php");
        }
      }

    }
    else{
        header("Location: ../signin.php");
    }

?>