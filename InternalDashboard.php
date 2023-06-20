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
    <title>Internal Dashboard</title>
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
    <div class = "form_wrapper4">
      <h4 class="dashboardh4">FCSIT Meeting Room Booking and Management System</h4>
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
        <h3 class="indexH3">
          Dashboard
        </h3>
        <table>
            <tr>
              <th>BookingNo</th>
              <th>UserID</th>
              <th>UserName</th>
              <th>RoomNo</th>
              <th>RoomName</th>
              <th>Date</th>
              <th>Time</th>
              <th>Action</th>
              <?php  
                include("db_conection.php");  
                $view_users_query="select internalbookinginvoice.BookingNo, internalbookinginvoice.UserID, internaluser.Username, internalbookinginvoice.RoomNo, room.RoomName, room.Date, room.Time from internalbookinginvoice inner join room on internalbookinginvoice.RoomNo = room.RoomNo inner join internaluser on internalbookinginvoice.UserID = internaluser.UserID where internaluser.UserEmail= '".$_SESSION['UserEmail']."'";//select query for viewing users.  
                $run=mysqli_query($dbcon,$view_users_query);//here run the sql query.  
                  while ($row=mysqli_fetch_array($run)){
                    $BookingNo=$row[0];
                    $UserID=$row[1];
                    $username=$row[2];
                    $roomno=$row[3];
                    $roomname=$row[4];  
                    $date=$row[5];
                    $time=$row[6];
              ?>
              <tr>
                <td><?php echo $BookingNo;  ?></td>
                <td><?php echo $UserID;  ?></td>
                <td><?php echo $username;  ?></td>
                <td><?php echo $roomno;  ?></td>
                <td><?php echo $roomname;  ?></td>
                <td><?php echo $date;  ?></td>
                <td><?php echo $time;  ?></td>
                <td><a href="pdfInternal.php?print=<?php echo $BookingNo ?>"><button>Print</button></a>
                <a href="InternalEmailFunction.php?email=<?php echo $BookingNo ?>"><button>Email</button></a>
                <a href="InternalCancelFunction.php?cancel=<?php echo $BookingNo?>&cancelroom=<?php echo $roomno?>"><button>Cancel</button></a>
                </td>
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