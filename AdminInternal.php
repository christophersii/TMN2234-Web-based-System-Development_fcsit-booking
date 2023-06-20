<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Internal User</title>
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
        <a href="AdminLogin.php" id="LogOutAdmin">Log Out <img class="sidebaricon" src="image/exit.svg" ></a>
      </div>
      <div class="form_wrapper4">
        <h4 class="dashboardh4">FCSIT Meeting Room Booking and Management System</h4>
      </div>
    </div>
    <div class="form_wrapper2">
        <h3 class="indexH3">List of Internal User</h3>
        <a  href="AdminAddInternal.php?add"><button>Add</button></a>
          <table>
              <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>E-mail</th>
                <th>Password</th>
                <th>Contact No</th>
                <th>Action</th>
                <?php  
                  include("db_conection.php");  
                  $view_users_query="select * from internaluser";//select query for viewing users.  
                  $run=mysqli_query($dbcon,$view_users_query);//here run the sql query.  
                    while ($row=mysqli_fetch_array($run)){
                      $UserID=$row[0];
                      $UserName=$row[1];
                      $UserEmail=$row[2];
                      $Password=$row[3];  
                      $ContactNo=$row[4];
                ?>
                <tr>
                  <td><?php echo $UserID;  ?></td>
                  <td><?php echo $UserName;  ?></td>
                  <td><?php echo $UserEmail;  ?></td>
                  <td><?php echo $Password;  ?></td>
                  <td><?php echo $ContactNo;  ?></td>
                  <td><a href="deleteinternal.php?del=<?php echo $UserID ?>"><button>Delete</button></a>
                  <a href="AdminUpdateInternal.php?upd=<?php echo $UserID ?>"><button>Update</button></a></td>
                </tr>
              </tr> 
              <?php } ?> 
          </table>
      </div>
      <div class="footer">
          <h4>Created by:<sup>G4_ </sup>SWEC_ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/view.php?id=5547" target="_blank">69860</a></sub> _ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/profile.php?id=5567">69385</a></sub> _ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/view.php?id=5548" target="_blank">69847</a></sub> _ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/profile.php?id=5560">71680</a> </sub></h4>
      </div>
    </div>
  </body>
</html>

