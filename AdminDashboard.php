<?php
  // Starting the session, to use and
  // store data in session variable
  session_start();
    
  // If the session variable is empty, this
  // means the user is yet to login
  // User will be sent to 'login.php' page
  // to allow the user to login
  if (!isset($_SESSION['UserName'])) {
      $_SESSION['msg'] = "You have to log in first";
      header('location: AdminLogin.php');
  }
    
  // Logout button will destroy the session, and
  // will unset the session variables
  // User will be headed to 'login.php'
  // after loggin out
  if (isset($_GET['logout'])) {
      session_destroy();
      unset($_SESSION['UserName']);
      header("location: index.html");
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="icon" href="image/icon.png" type="image/x-icon">
    <script src='https://use.fontawesome.com/4ecc3dbb0b.js'></script>
    <!-- External CSS-->
    <link rel="stylesheet" type="text/css" href="CSS/registyle.css">
</head>
<body>
    <div id="mySidenav" class="sidenav">
        <a href="AdminDashboard.php" id="Dashboard">Dashboard <img class="sidebaricon" src="image/dashboard.svg" ></a>
        <a href="AdminRoom.php" id="Room">Room <img class="sidebaricon" src="image/meeting-room.svg" ></a>
        <a href="AdminInternal.php" id="InternalProfile">Internal <img class="sidebaricon" src="image/user.svg" ></a>
        <a href="AdminGuest.php" id="GuestProfile">Guest <img class="sidebaricon" src="image/user.svg" ></a>
        <a href="Logout.php" id="LogOutAdmin">Log Out <img class="sidebaricon" src="image/exit.svg" ></a>
      </div>
      <div class="form_wrapper4">
        <h4 class="dashboardh4">FCSIT Meeting Room Booking and Management System</h4>
      </div>
    </div>
    <div class="form_wrapper2">
      <h3 class="indexH3">
        Internal booking
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
            $view_users_query="select internalbookinginvoice.BookingNo, internalbookinginvoice.UserID, internaluser.Username, internalbookinginvoice.RoomNo, room.RoomName, room.Date, room.Time from internalbookinginvoice inner join room on internalbookinginvoice.RoomNo = room.RoomNo inner join internaluser on internalbookinginvoice.UserID = internaluser.UserID";//select query for viewing users.  
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
            <td><a href="pdfInternal.php?print=<?php echo $BookingNo ?>"><button>Print</button></a></td>
          </tr>
        </tr>
        <?php } ?> 
      </table>
      <div>
        <h3>
          Print Internal report
        </h3>
          <a href="pdfAdminInternalReport.php"><input type="submit" name= "internalreport" Value="Report"></a>
      </div>
    </div>
    <div class="form_wrapper2">
      <h3 class="indexH3">
        Public booking
      </h3>
      <table>
        <tr>
          <th>Booking No</th>
          <th>Guest ID</th>
          <th>Guest Name</th>
          <th>Room No</th>
          <th>Room Name</th>
          <th>Date</th>
          <th>Time</th>
          <th>Action</th>
          <?php  
            include("db_conection.php");  
            $view_users_query="select publicbookinginvoice.GuestID, publicuser.username, publicbookinginvoice.BookingNo, publicbookinginvoice.RoomNo, room.RoomName, room.Date, room.Time from publicbookinginvoice inner join room on publicbookinginvoice.RoomNo = room.RoomNo inner join publicuser on publicbookinginvoice.GuestID = publicuser.GuestID";//select query for viewing users.  
            $run=mysqli_query($dbcon,$view_users_query);//here run the sql query.  
            while ($row=mysqli_fetch_array($run)){
              $BookingNo=$row[2];
              $GuestID=$row[0];
              $GuestName=$row[1];
              $roomno=$row[3];
              $roomname=$row[4];  
              $date=$row[5];
              $time=$row[6];
          ?>
          <tr>
            <td><?php echo $BookingNo;  ?></td>
            <td><?php echo $GuestID;  ?></td>
            <td><?php echo $GuestName;  ?></td>
            <td><?php echo $roomno;  ?></td>
            <td><?php echo $roomname;  ?></td>
            <td><?php echo $date;  ?></td>
            <td><?php echo $time;  ?></td>
            <td><a href="pdfGuest.php?print=<?php echo $BookingNo ?>"><button>Print</button></a></td>
          </tr>
        </tr>
        <?php } ?> 
      </table>
      <div>
        <h3>
          Print Guest report
        </h3>
          <a href="pdfAdminGuestReport.php"><input type="submit" name= "internalreport" Value="Report"></a>
      </div>
    </div>
    <div class="footer">
          <h4>Created by:<sup>G4_ </sup>SWEC_ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/view.php?id=5547" target="_blank">69860</a></sub> _ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/profile.php?id=5567">69385</a></sub> _ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/view.php?id=5548" target="_blank">69847</a></sub> _ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/profile.php?id=5560">71680</a> </sub></h4>
      </div>
  </body>
</html>