<?php
 
 // Starting the session, to use and
 // store data in session variable
 session_start();
   
 // If the session variable is empty, this
 // means the user is yet to login
 // User will be sent to 'login.php' page
 // to allow the user to login
 if (!isset($_SESSION['UserEmail'])) {
     $_SESSION['msg'] = "You have to log in first";
     header('location: GuestLogin.php');
 }
   
 // Logout button will destroy the session, and
 // will unset the session variables
 // User will be headed to 'login.php'
 // after loggin out
 if (isset($_GET['logout'])) {
     session_destroy();
     unset($_SESSION['UserEmail']);
     header("location: index.html");
 }
 
 ?>

<?php
include("db_conection.php");
$username= $ContactNo = "";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username= ($_POST['userName']);
    $Password= ($_POST['password']);
    $ContactNo= ($_POST['mobile']);

    //username
    if (empty($username)){
        $username = false;
        echo "<script>alert('Username cannot be empty. Form not submitted, please try again.')</script>";
        echo "<script>window.open('GuestProfileUpdate.php','_self')</script>";
        exit();
    }else{
        if (!preg_match("/^[a-zA-Z\s]+$/", $username)){
            $username = false;
            echo "<script>alert('Invalid username. Form not submitted, please try again.')</script>";
            echo "<script>window.open('GuestProfileUpdate.php','_self')</script>";
            exit();
        }
        $username = true;
    }

    //password
    if (empty($_POST["password"])){
        $Password = false;
        echo "<script>alert('Password cannot be empty. Form not submitted, please try again.')</script>";
        echo "<script>window.open('GuestRegistration.php','_self')</script>";
        exit();
    }else{
        if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{6}$/", $Password)){
        $Password = false;
        echo "<script>alert('Invalid password. Required 6 digits length, contain ONE upppercase, ONE lowercase, ONE special character, numbers and no space. Form not submitted, please try again.')</script>";
        echo "<script>window.open('GuestProfileUpdate.php','_self')</script>";
        exit();
        }
        $Password = true;
    }

    //mobile
    if (empty($_POST["mobile"])){
        $ContactNo = false;
        echo "<script>alert('Mobile number cannot be empty. Form not submitted, please try again.')</script>";
        echo "<script>window.open('GuestProfileUpdate.php','_self')</script>";
        exit();
    }else{
        if (!preg_match("/^(\+?6?01)[0|1|2|3|4|6|7|8|9]\-*[0-9]{7,8}$/", $ContactNo)){
            $ContactNo = false;
            echo "<script>alert('Invalid Malaysian mobile number. Form not submitted, please try again.')</script>";
            echo "<script>window.open('GuestProfileUpdate.php','_self')</script>";
            exit();
        }
        $ContactNo = true;
    }
    
    if ($username == true && $Password == true && $ContactNo == true){
      $username= ($_POST['userName']);
      $password= ($_POST['password']);
      $ContactNo= ($_POST['mobile']);
  
      if ($dbcon->connect_error){
          die('Connection Failed : ' .$dbcon->connect_error);
      }
      else{
          $stmt = $dbcon->prepare("UPDATE publicuser SET UserName=?, ContactNo=?, Password=? WHERE UserEmail= '".$_SESSION['UserEmail']."'");
          $stmt->bind_param('sis', $username, $ContactNo, $password);
          $stmt->execute();
          echo "<script>alert('Update successful.')</script>";
          echo "<script>window.open('GuestProfile.php','_self')</script>";
      }
  }
  else{
      echo"<script>alert('Form not submitted, please try again.')</script>";
      echo "<script>window.open('GuestProfileUpdate.php','_self')</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Registration Form</title>
    <link rel="icon" href="image/icon.png" type="image/x-icon">
    <script src='https://use.fontawesome.com/4ecc3dbb0b.js'></script>
    
    <!-- External CSS-->
    <link rel="stylesheet" type="text/css" href="CSS/registyle.css">
</head>
<body>
    <div id="mySidenav" class="sidenav">
        <a href="GuestDashboard.php" id="Dashboard">Dashboard <img class="sidebaricon" src="image/dashboard.svg" ></a>
        <a href="GuestProfile.php" id="Profile">Profile <img class="sidebaricon" src="image/user.svg"  ></a>
        <a href="GuestBooking.php" id="Book">Book <img class="sidebaricon" src="image/booking.svg"  ></a>
        <a href="Logout.php" id="LogOut">Log Out <img class="sidebaricon" src="image/exit.svg" ></a>
    </div>
        
    </div>
  <div class="form_wrapper">
    <div class="form_container">
      <div class="title_container">
        <h2>Update Profile</h2>
      </div>
      
      <div class="row clearfix">
        <form name="reg_form" id="reg_form" method="post";>
            <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                <input type="text" name="userName" placeholder="Username" />
            </div>
            <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                <input type="password" name="password" placeholder="Password"  />
            </div>
            <div class="input_field"> <span><i aria-hidden="true" class="fa fa-mobile"></i></span>
                <input type="mobile" name="mobile" placeholder="Mobile (+60)"  />
            </div>
                <input type="submit" name="update" Value="Update">
            <a class="button1" href="GuestDashboard.php">Back</a>
      </div>
    </div>
  </div>
    <div class="footer">
        <h4>Created by:<sup>G4_ </sup>SWEC_ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/view.php?id=5547" target="_blank">69860</a></sub> _ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/profile.php?id=5567">69385</a></sub> _ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/view.php?id=5548" target="_blank">69847</a></sub> _ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/profile.php?id=5560">71680</a> </sub></h4>
    </div>
</body>
</html>