<?php  
session_start();//session starts here  
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="icon" href="image/icon.png" type="image/x-icon">
    <script src='https://use.fontawesome.com/4ecc3dbb0b.js'></script>
    <!-- External CSS-->
    <link rel="stylesheet" type="text/css" href="CSS/registyle.css">
</head>
<body>
    <div class="form_wrapper">
        <div class="form_container">
            <div class="title_container">
                <h2>Login As Admin</h2>
            </div>
            <div class="row clearfix">
                <form name="reg_form" id="reg_form"  method="post";>
                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                        <input type="text" name="UserName" placeholder="Username" />             
                    </div>
                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                        <input type="password" name="password" placeholder="Password"  />
                    </div>
                    <input class="button" type="submit" name="login" value="Log In" />               
                </form>
            </div>
        </div>
    </div>
    <div class="form_wrapper">
        <h3>Log in as:</h3>
        <a class="button2" href="InternalLogin.php">Internal</a>
        <a class="button2" href="GuestLogin.php">Guest</a>
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
if(isset($_POST['login']))//this will tell us what to do if some data has been post through form with button.  
{  
    $admin_name=$_POST['UserName'];  
    $admin_pass=$_POST['password'];  
  
    $admin_query="select * from admin WHERE UserName='$admin_name' AND Password='$admin_pass'";  
    $row= "select * from admin";
    $run_query=mysqli_query($dbcon,$admin_query);  
    
    if(mysqli_num_rows($run_query))  
    {  
        echo "<script>window.open('AdminDashboard.php','_self')</script>";  
        $_SESSION['UserName']=$admin_name;
    }  
    else {
        echo"<script>alert('Admin Details are incorrect..!')</script>";
    }  
}  
?>