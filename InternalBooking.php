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
    header('location: intenallogin.php');
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
    <title>Internal Booking</title>
    <link rel="icon" href="image/icon.png" type="image/x-icon">
    <script src='https://use.fontawesome.com/4ecc3dbb0b.js'></script>
    <!-- External CSS-->
    <link rel="stylesheet" type="text/css" href="CSS/registyle.css">
</head>
<body>
    <div id="mySidenav" class="sidenav">
        <a href="InternalDashboard.php" id="Dashboard">Dashboard <img class="sidebaricon" src="image/dashboard.svg" ></a>
        <a href="InternalProfile.php" id="Profile">Profile <img class="sidebaricon" src="image/user.svg" ></a>
        <a href="InternalBooking.php" id="Book">Book <img class="sidebaricon" src="image/booking.svg" ></a>
        <a href="Logout.php" id="LogOut">Log Out <img class="sidebaricon" src="image/exit.svg" ></a>
    </div>
      <div class="form_wrapper4">
        <h4 class="dashboardh4">FCSIT Meeting Room Booking and Management System</h4>
      </div>
    </div>
    <div class="form_wrapper2">
    <h3>
        <!-- information of the user logged in -->
          <!-- welcome message for the logged in user -->
          
          <?php if (isset($_SESSION['UserEmail'])) : ?>
            <strong>
            <?php echo $_SESSION['UserEmail']; ?>
          <?php endif ?>
      </h3>
      <?php
        include("db_conection.php");
        // Check connection
        if ($dbcon->connect_error) {
          die("Connection failed: " . $dbcon->connect_error);
        }

        $sql = "SELECT UserID FROM internaluser WHERE useremail= '".$_SESSION['UserEmail']."'";
        $result = $dbcon->query($sql);

        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            echo "<span>". "UserID: " . $row["UserID"] . "</span>";
          }
        } 
        $dbcon->close();
      ?>
      </h3>
        <h3 class="indexH3">Book</h3>
        <table>
            <tr>
              <th>Room No</th>
              <th>Room Name</th>
              <th>Date</th>
              <th>Time</th>
              <th>Capacity</th>
              <th>Availability</th>
              <th>Action</th>
              <?php  
                include("db_conection.php");  
                $view_room_query="select * from room where Availability= 'available' AND Date >= CURRENT_DATE";//select query for viewing users.  
                $run=mysqli_query($dbcon,$view_room_query);//here run the sql query.  
                while ($row=mysqli_fetch_array($run)){
                  $RoomNo=$row[0];  
                  $AdminID=$row[1];
                  $RoomName=$row[2];  
                  $Date=$row[3];  
                  $Time=$row[4];
                  $Capacity=$row[5];
                  $Availability=$row[7];
              ?>
                <tr>
                  <td><?php echo $RoomNo;  ?></td>
                  <td><?php echo $AdminID;  ?></td>
                  <td><?php echo $Date;  ?></td>
                  <td><?php echo $Time;  ?></td>
                  <td><?php echo $Capacity;  ?></td>
                  <td><?php echo $Availability;  ?></td>
                  <td><a href="InternalBookingFunction.php?book=<?php echo $RoomNo ?>"><button>Book</button></a></td>
                </tr>
              </tr>
              <?php } ?>
        </table>
    </div>
    <div class="footer">
        <h4>Created by:<sup>G4_ </sup>SWEC_ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/view.php?id=5547" target="_blank">69860</a></sub> _ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/profile.php?id=5567">69385</a></sub> _ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/view.php?id=5548" target="_blank">69847</a></sub> _ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/profile.php?id=5560">71680</a> </sub></h4>
    </div>

</body>
</html>