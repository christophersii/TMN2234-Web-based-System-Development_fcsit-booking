<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="icon" href="image/icon.png" type="image/x-icon">
    <script src='https://use.fontawesome.com/4ecc3dbb0b.js'></script>
    
    <!-- External CSS-->
    <link rel="stylesheet" type="text/css" href="CSS/registyle.css">
</head>
<body>
  <div class="form_wrapper">
    <div class="form_container">
      <div class="title_container">
        <h2>Payment</h2>
        <?php
        include("db_conection.php");
        // Check connection
        if ($dbcon->connect_error) {
          die("Connection failed: " . $dbcon->connect_error);
        }

        $sql = "SELECT GuestID FROM publicuser WHERE UserEmail= '".$_SESSION['UserEmail']."'";
        $result = $dbcon->query($sql);

        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            echo "<span>". "GuestID: " . $row["GuestID"] . "</span>";
          }
        } 
      ?>
      </div>
      <div class="row clearfix">
        <form name="reg_form" id="reg_form" method="POST";>
          <h4 style='text-align: center; color:red'>Please choose your payment method 😊</h4>
          <div class="input_field radio_option">
            <input type="radio" name="paymentmethod" id="rd1" value="Credit">
            <label class="Credit" for="rd1"><img src="image/visa.svg" height=48em></label>
            <input type="radio" name="paymentmethod" id="rd2" value="Paypal">
            <label class="Paypal" for="rd2"><img src="image/paypal.svg" height=50em></label><br><br><br><br>
          </div>
          <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
            <input type="text" name="fullname" placeholder="Fullname" />
          </div>
          <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
            <input type="text" name="address" placeholder="Address"  />
          </div>
          <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
            <input type="text" name="paymentinfo" placeholder="Card No or Paypal info"  />
          </div>
          <input class="button" type="submit" name="book" value="Proceed" />
          <a class="button1" href="GuestBooking.php">Back</a>
        </form>
      </div>
    </div>
  </div>
  <div class="footer">
      <h4>Created by:<sup>G4_ </sup>SWEC_ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/view.php?id=5547" target="_blank">69860</a></sub> _ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/profile.php?id=5567">69385</a></sub> _ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/view.php?id=5548" target="_blank">69847</a></sub> _ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/profile.php?id=5560">71680</a> </sub></h4>
  </div>
</body>
</html>

<?php
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $PaymentMethod= ($_POST['paymentmethod']);
      $radio1= false;
      $stmt = $dbcon->prepare("SELECT PaymentMethod from paymentinvoice");
    //payment method
    if(!isset($_POST['paymentmethod'])){
      $radio1= false;
      echo "<script>alert('Please select your payment method. Form not submitted, please try again.')</script>";
      echo "<script>window.open('GuestBookingFunction.php','_self')</script>";
      exit();
    }else {
      $radio1= true;
    }
  //fullname
  if (empty($_POST['fullname'])){
    $fullname = false;
    echo "<script>alert('Name cannot be empty. Form not submitted, please try again.')</script>";
    echo "<script>window.open('GuestBooking.php','_self')</script>";
    exit();
  }else{
    $fullname = true;
  }

  //payment email
  if (empty($_POST["address"])){
    $paddress = false;
    echo "<script>alert('Address cannot be empty. Form not submitted, please try again.')</script>";
    echo "<script>window.open('GuestBooking.php','_self')</script>";
    exit();
  }else{
      $paddress = true;
  }

  //card or paypal info
  if (empty($_POST["paymentinfo"])){
    $paymentinfo = false;
    echo "<script>alert('Payment info cannot be empty. Form not submitted, please try again.')</script>";
    echo "<script>window.open('GuestBooking.php','_self')</script>";
    exit();
  }else{
    $paymentinfo = true;
  }

  if ($radio1 == true && $fullname == true && $paddress == true &&  $paymentinfo = true){
      $PaymentMethod= ($_POST['paymentmethod']);
      $book_id=$_GET['book'];
      $result = $dbcon->query("SELECT Price FROM room WHERE RoomNo = '$book_id'");
      if(mysqli_num_rows($result) > 0 ){
        $row = mysqli_fetch_assoc($result);
        $niampayment_price = $row["Price"];

        $_SESSION["Price"] = $niampayment_price;
      }
      
      if ($dbcon->connect_error){
        die('Connection Failed : ' .$dbcon->connect_error);
      }
      else{
        $stmt = $dbcon->prepare("INSERT INTO paymentinvoice(PaymentMethod, PaidPrice)
          VALUES (?, ?)");   
        $stmt->bind_param('si', $PaymentMethod, $niampayment_price);
        $stmt->execute();
        $last_id= $dbcon->insert_id;
        echo "<script>alert('Payment successfully.Room has been booked successfully.')</script>";
        $useremail =$_SESSION['UserEmail'];
        $GuestID = "Select GuestID FROM pulicuser WHERE UserEmail= ".$_SESSION['UserEmail'].";";
        $result = $dbcon->query("SELECT GuestID FROM publicuser WHERE UserEmail = '$useremail'");
        if(mysqli_num_rows($result) > 0 ){

          $row = mysqli_fetch_assoc($result);
          $GuestID = $row["GuestID"];

          $_SESSION["GuestID"] = $GuestID;
        }

        $stmt=$dbcon->prepare("INSERT INTO publicbookinginvoice(GuestID, RoomNo, PaymentID) VALUES (?, ?,?)");
        $stmt->bind_param('iii', $GuestID , $book_id, $last_id);
        $stmt->execute();

        $stmt=$dbcon->prepare("UPDATE room SET Availability= 'unavailable' WHERE RoomNo= '$book_id';");
        $stmt->execute();
        echo "<script>window.open('GuestDashboard.php?book=room has been booked successfully','_self')</script>";  
      }
    }
    else{
      echo"<script>alert('Form not submitted, please try again.')</script>";
      echo "<script>window.open('GuestBookingFunction.php','_self')</script>";
    }
  }
?>