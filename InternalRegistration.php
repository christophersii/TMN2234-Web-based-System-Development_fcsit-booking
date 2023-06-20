<?php
include("db_conection.php");
$username = $email  = $password = $cpassword = $ContactNo = "";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username= ($_POST['userName']);
    $email= ($_POST['email']);
    $Password= ($_POST['password']);
    $cpassword= ($_POST['cpassword']);
    $ContactNo= ($_POST['mobile']);

    //username
    if (empty($username)){
        $username = false;
        echo "<script>alert('Username cannot be empty. Form not submitted, please try again.')</script>";
        echo "<script>window.open('InternalRegistration.php','_self')</script>";
        exit();
    }else{
        if (!preg_match("/^[a-zA-Z\s]+$/", $username)){
            $username = false;
            echo "<script>alert('Invalid username. Form not submitted, please try again.')</script>";
            echo "<script>window.open('InternalRegistration.php','_self')</script>";
            exit();
        }
        $username = true;
    }

    //email
    if (empty($_POST["email"])){
        $email = false;
        echo "<script>alert('Email cannot be empty. Form not submitted, please try again.')</script>";
        echo "<script>window.open('InternalRegistration.php','_self')</script>";
        exit();
    }else{
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $email = false;
            echo "<script>alert('Invalid email format. Form not submitted, please try again.')</script>";
            echo "<script>window.open('InternalRegistration.php','_self')</script>";
            exit();
        }
        $email = true;
    }

    //password
    if (empty($_POST["password"])){
        $Password = false;
        echo "<script>alert('Password cannot be empty. Form not submitted, please try again.')</script>";
        echo "<script>window.open('InternalRegistration.php','_self')</script>";
        exit();
    }else{
        if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{6}$/", $Password)){
        $Password = false;
        echo "<script>alert('Invalid password. Required 6 digits length, contain ONE upppercase, ONE lowercase, ONE special character, numbers and no space. Form not submitted, please try again.')</script>";
        echo "<script>window.open('InternalRegistration.php','_self')</script>";
        exit();
        }
        $Password = true;
    }

    //confirm password
    if (empty($_POST["cpassword"])){
        $cpassword = false;
        echo "<script>alert('Confirm password cannot be empty. Form not submitted, please try again.')</script>";
        echo "<script>window.open('InternalRegistration.php','_self')</script>";
        exit();
    }else{
        if ($cpassword != $Password){
        $cpassword = false;
        echo "<script>alert('Passwords does not match. Form not submitted, please try again.')</script>";
        echo "<script>window.open('InternalRegistration.php','_self')</script>";
        exit();
        }
        $cpassword = true;
    }

    //mobile
    if (empty($_POST["mobile"])){
        $ContactNo = false;
        echo "<script>alert('Mobile number cannot be empty. Form not submitted, please try again.')</script>";
        echo "<script>window.open('InternalRegistration.php','_self')</script>";
        exit();
    }else{
        if (!preg_match("/^(\+?6?01)[0|1|2|3|4|6|7|8|9]\-*[0-9]{7,8}$/", $ContactNo)){
            $ContactNo = false;
            echo "<script>alert('Invalid Malaysian mobile number. Form not submitted, please try again.')</script>";
            echo "<script>window.open('InternalRegistration.php','_self')</script>";
            exit();
        }
        $ContactNo = true;
    }
    
    if ($username == true && $email == true && $Password == true && $cpassword == true && $ContactNo == true){
      $username= ($_POST['userName']);
      $email= ($_POST['email']);
      $Password= ($_POST['password']);
      $cpassword= ($_POST['cpassword']);
      $ContactNo= ($_POST['mobile']);
      if ($dbcon->connect_error){
        die('Connection Failed : ' .$dbcon->connect_error);
      }
      $sql = "select * from internaluser where UserName = '".$username."'or UserEmail = '".$email."'or Password = '".$Password."' or ContactNo = '".$ContactNo."'";
      $count = $dbcon->query($sql);
      if($count->num_rows == 0)
      {
          $stmt = $dbcon->prepare("INSERT INTO internaluser(UserName, UserEmail, Password, ContactNo)
              VALUES (?, ?, ?, ?)");
          $stmt->bind_param('sssi', $username,  $email, $Password, $ContactNo);
          $stmt->execute();
          echo "<script>alert('Registration successfully. Please Log in.')</script>";
          echo "<script>window.open('InternalLogin.php','_self')</script>";
      }
      else{
        echo "<script>alert('The data (either username, email, password or mobile) already exist. Please Try Another Data.')</script>" ;
      }
    }
  else{
      echo"<script>alert('Form not submitted, please try again.')</script>";
      echo "<script>window.open('InternalRegistration.php','_self')</script>";
  }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internal Registration Form</title>
    <link rel="icon" href="image/icon.png" type="image/x-icon">
    <script src='https://use.fontawesome.com/4ecc3dbb0b.js'></script>
    
    <!-- External CSS-->
    <link rel="stylesheet" type="text/css" href="CSS/registyle.css">
</head>
<body>
  <div class="form_wrapper">
    <div class="form_container">
      <div class="title_container">
        <h2>Internal Registration Form</h2>
      </div>
      <div class="row clearfix">
        <form name="reg_form" id="reg_form" method="post";>
          <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
            <input type="text" name="userName" placeholder="Username" />
          </div>
          <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
            <input type="email" name="email" placeholder="Email"  />
          </div>
          <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
            <input type="password" name="password" placeholder="Password"  />
          </div>
          <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
            <input type="password" name="cpassword" placeholder="Confirm Password"  />
          </div>
          <div class="input_field"> <span><i aria-hidden="true" class="fa fa-mobile"></i></span>
            <input type="mobile" name="mobile" placeholder="Mobile (+60)"  />
          </div>
          
          
            <input type="submit" Value="Register"><a>
          <a class="button1" href="InternalLogin.php">Back</a>
        </form>
      </div>
    </div>
  </div>
  <div class="footer">
      <h4>Created by:<sup>G4_ </sup>SWEC_ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/view.php?id=5547" target="_blank">69860</a></sub> _ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/profile.php?id=5567">69385</a></sub> _ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/view.php?id=5548" target="_blank">69847</a></sub> _ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/profile.php?id=5560">71680</a> </sub></h4>
  </div>
</body>
</html>

