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
      header('location: IntenalLogin.php');
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
    <div id="mySidenav" class="sidenav">
        <a href="InternalDashboard.php" id="Dashboard">Dashboard <img class="sidebaricon" src="image/dashboard.svg"  ></a>
        <a href="InternalProfile.php" id="Profile">Profile <img class="sidebaricon" src="image/user.svg"  ></a>
        <a href="InternalBooking.php" id="Book">Book <img class="sidebaricon" src="image/booking.svg"  ></a>
        <a href="Logout.php" name= "logout" id="LogOut">Log Out <img class="sidebaricon" src="image/exit.svg"  ></a>
        </div>
        
    </div>
  <div class="form_wrapper">
    <div class="form_container">
      <div class="title_container">
        <h2>User Profile</h2>
      </div>
      
      <div class="row clearfix">
        <form name="reg_form" id="reg_form" method="post";>
          <?php
            include("db_conection.php");
            // Check connection
            if ($dbcon->connect_error) {
              die("Connection failed: " . $dbcon->connect_error);
            }

            $sql = "SELECT UserName, Password, ContactNo FROM internaluser  WHERE useremail= '".$_SESSION['UserEmail']."'";
            $result = $dbcon->query($sql);

            if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                echo "<span style='color: rgb(6, 100, 223); display:grid; place-items: center; font-size:18px'>". "UserName: " . $row["UserName"]. "<br><br>Password: " . $row["Password"]. "<br><br>ContactNo: " . $row["ContactNo"]. "<br><br>" . "</span>";
              }
            } else {
              echo "0 results";
            }
            $dbcon->close();
          ?>
          <a class="button1"  href="InternalProfileUpdate.php">Edit<a>
          <a class="button1" href="InternalDashboard.php">Back</a>
        </form>
      </div>
    </div>
  </div>
  <div class="footer">
      <h4>Created by:<sup>G4_ </sup>SWEC_ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/view.php?id=5547" target="_blank">69860</a></sub> _ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/profile.php?id=5567">69385</a></sub> _ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/view.php?id=5548" target="_blank">69847</a></sub> _ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/profile.php?id=5560">71680</a> </sub></h4>
  </div>
</body>
</html>