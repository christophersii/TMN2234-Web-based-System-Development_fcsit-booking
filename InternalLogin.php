<?php  
session_start();//session starts here  
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internal Login</title>
    <link rel="icon" href="image/icon.png" type="image/x-icon">
    <script src='https://use.fontawesome.com/4ecc3dbb0b.js'></script>
    <!-- External CSS -->
    <link rel="stylesheet" type="text/css" href="CSS/registyle.css">
</head>
<body>
    <div class="form_wrapper">
        <div class="form_container">
            <div class="title_container">
                <h2>Login As Internal</h2>
            </div>
            <div class="row clearfix">
                <form name="reg_form" id="reg_form" method="post";>
                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                        <input type="email" name="UserEmail" placeholder="E-mail" />             
                    </div>
                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                        <input type="password" name="password" placeholder="Password"  />
                    </div>
                    <input class="button" type="submit" name="login" value="Log In" />               
                </form>
            </div>
            <div class="row clearfix">
                <h3>Don't have an internal account?</h3>
                <a class="button1" href="InternalRegistration.php">Sign Up</a>
            </div>
        </div>
    </div>
    <div class="form_wrapper">
        <h3>Log in as:</h3>
        <a class="button2" href="GuestLogin.php">Guest</a>
        <a class="button2" href="AdminLogin.php">Admin</a>
    </div>
    <div class="form_wrapper3">
        <a class="button4" href="index.html">Back</a>
    </div>
    <div class="footer">
        <h4>Created by:<sup>G4_ </sup>SWEC_ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/view.php?id=5547" target="_blank">69860</a></sub> _ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/profile.php?id=5567">69385</a></sub> _ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/view.php?id=5548" target="_blank">69847</a></sub> _ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/profile.php?id=5560">71680</a> </sub></h4>
    </div>

</body>
</html>

<?php
include("db_conection.php");  
if(isset($_POST['login']))
{
    $user_email=$_POST['UserEmail'];
    $user_pass=$_POST['password'];
  
    $check_user="select * from internaluser WHERE UserEmail='$user_email'AND Password='$user_pass'";  
    $row= "select * from internaluser";
    $run=mysqli_query($dbcon,$check_user);  
  
    if(mysqli_num_rows($run))  
    {  
        echo "<script>window.open('InternalDashboard.php','_self')</script>";  
        $_SESSION['UserEmail']=$user_email; //here session is used and value of $user_email store in $_SESSION.
    }
    else  
    {
      echo "<script>alert('Email or password is incorrect!')</script>"; 
      echo "<script>window.open('InternalLogin.php','_self')</script>"; 
    }
}
?> 