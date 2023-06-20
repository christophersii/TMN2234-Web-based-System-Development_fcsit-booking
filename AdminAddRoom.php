<?php
  // Starting the session, to use and
  // store data in session variable
  session_start();
  include("db_conection.php");
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

$username = $email  = $password = $cpassword = $ContactNo = "";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $roomName= ($_POST['roomName']);
    $date= ($_POST['date']);
    $time= ($_POST['time']);
    $capacity= ($_POST['capacity']);
    $price= ($_POST['price']);
    $availability= ($_POST['availability']);
    

    //roomName
    if (empty($roomName)){
        $roomName = false;
        echo "<script>alert('Room Name cannot be empty. Form not submitted, please try again.')</script>";
        echo "<script>window.open('AdminAddRoom.php','_self')</script>";
        exit();
    }else{
        $roomName = true;
    }

    //date
    if (empty($_POST["date"])){
        $date = false;
        echo "<script>alert('Date cannot be empty. Form not submitted, please try again.')</script>";
        echo "<script>window.open('AdminAddRoom.php','_self')</script>";
        exit();
    }else{
        $date = true;
    }

    //time
    if (empty($_POST["time"])){
        $time = false;
        echo "<script>alert('Time cannot be empty. Form not submitted, please try again.')</script>";
        echo "<script>window.open('AdminAddRoom.php','_self')</script>";
        exit();
    }else{
        $time = true;
    }

    //capacity
    if (empty($_POST["capacity"])){
        $capacity = false;
        echo "<script>alert('Capacity cannot be empty. Form not submitted, please try again.')</script>";
        echo "<script>window.open('AdminAddRoom.php','_self')</script>";
        exit();
    }else{
        $capacity = true;
    }

    //availability
    if (empty($_POST["availability"])){
      $availability = false;
      echo "<script>alert('Availability cannot be empty. Form not submitted, please try again.')</script>";
      echo "<script>window.open('AdminAddRoom.php','_self')</script>";
      exit();
    }else{
      $availability = true;
    }
    //confirm password
    if (empty($_POST["price"])){
        $price = false;
        echo "<script>alert('Price cannot be empty. Form not submitted, please try again.')</script>";
        echo "<script>window.open('AdminAddRoom.php','_self')</script>";
        exit();
    }else{
        $price = true;
    }
    
    if ($roomName == true && $date == true && $time == true && $capacity == true && $availability = true && $price == true){
      $roomName= ($_POST['roomName']);
      $date= ($_POST['date']);
      $time= ($_POST['time']);
      $capacity= ($_POST['capacity']);
      $price= ($_POST['price']);
      $availability= ($_POST['availability']);
      
      //Database connection

      $username =$_SESSION['UserName'];
      $AdminID = "Select AdminID FROM admin WHERE UserName= ".$_SESSION['UserName'].";";
      $result = $dbcon->query("SELECT AdminID FROM admin WHERE UserName = '$username'");
      if(mysqli_num_rows($result) > 0 ){
        $row = mysqli_fetch_assoc($result);
        $admin_id = $row["AdminID"];
        $_SESSION["AdminID"] = $admin_id;
      }
      $stmt = $dbcon->prepare("INSERT INTO room(RoomName, AdminID, Date, Time, Capacity, Price, Availability)
          VALUES (?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param('sissiis', $roomName, $admin_id, $date, $time, $capacity, $price, $availability);
      $stmt->execute();
      echo "<script>alert('Room added successfully!')</script>";
      echo "<script>window.open('AdminRoom.php','_self')</script>";
    }
    else{
      echo"<script>alert('Form not submitted, please try again.')</script>";
      echo "<script>window.open('AdminAddRoom.php','_self')</script>";
  }
}
  

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new room</title>
    <link rel="icon" href="image/icon.png" type="image/x-icon">
    <script src='https://use.fontawesome.com/4ecc3dbb0b.js'></script>
    <!-- External CSS-->
    <link rel="stylesheet" type="text/css" href="CSS/registyle.css">
</head>
<body>
    <div id="mySidenav" class="sidenav">
        <a href="AdminDashboard.php" id="Dashboard">Dashboard <img class="sidebaricon" src="image/dashboard.svg" alt="Dashboard" ></a>
        <a href="AdminRoom.php" id="Room">Room <img class="sidebaricon" src="image/meeting-room.svg" alt="Dashboard" ></a>
        <a href="AdminInternal.php" id="InternalProfile">Internal <img class="sidebaricon" src="image/user.svg" alt="Dashboard" ></a>
        <a href="AdminGuest.php" id="GuestProfile">Guest <img class="sidebaricon" src="image/user.svg" alt="Dashboard" ></a>
        <a href="AdminLogin.php" id="LogOutAdmin">Log Out <img class="sidebaricon" src="image/exit.svg" alt="Dashboard" ></a>
      </div>
    </div>
    <div class="form_wrapper">
        <div class="form_container">
          <div class="title_container">
            <h2>Add new Room</h2>
          </div>
          <div class="row clearfix">
            <form name="reg_form" id="reg_form" method="post";>
              <div class="input_field"> 
                <input  type="text" name="roomName" placeholder="Room Name" />
              </div>
              <div class="input_field"> 
                <input type="date" name="date" placeholder="Date"  />
              </div>
              <div class="input_field"> 
                <input type="time" name="time" placeholder="Time"  />
              </div>
              <div class="input_field">
                <input type="number" name="capacity" placeholder="Capacity"  />
              </div>
              <div class="input_field"> 
                <select name= "availability">
                  <option value="available">Available</option>
                  <option value="unavailable">Unavailable</option>
                </select>
              </div>
              <div class="input_field"> 
                <input type="number" name="price" placeholder="RM"  />
              </div>
              
              <input type="submit" Value="Add"><a>
              <a class="button1" href="AdminRoom.php">Back</a>
            </form>
          </div>
        </div>
      </div>
      <div class="footer">
          <h4>Created by:<sup>G4_ </sup>SWEC_ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/view.php?id=5547" target="_blank">69860</a></sub> _ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/profile.php?id=5567">69385</a></sub> _ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/view.php?id=5548" target="_blank">69847</a></sub> _ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/profile.php?id=5560">71680</a> </sub></h4>
      </div>
</body>
</html>