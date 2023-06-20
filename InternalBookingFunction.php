<?php
  session_start();
  include("db_conection.php");
  $useremail =$_SESSION['UserEmail'];
  //Database connection
  $UserID = "Select UserID FROM internaluser WHERE UserEmail= ".$_SESSION['UserEmail'].";";
  $result = $dbcon->query("SELECT UserID FROM internaluser WHERE UserEmail = '$useremail'");
  if(mysqli_num_rows($result) > 0 ){
    $row = mysqli_fetch_assoc($result);
    $user_id = $row["UserID"];

    $_SESSION["UserID"] = $user_id;
  }

  $book_id=$_GET['book'];  
  $stmt=$dbcon->prepare("INSERT INTO internalbookinginvoice(UserID, RoomNo) VALUES (?,?)");
  $stmt->bind_param('ii', $user_id , $book_id);
  $stmt->execute();
  
  $stmt=$dbcon->prepare("UPDATE room SET Availability= 'unavailable' WHERE RoomNo= '$book_id';");
  $stmt->execute();
  echo"<script>alert('Room has been booked successfully.')</script>";
  echo "<script>window.open('InternalDashboard.php?book=room has been booked successfully','_self')</script>";  
?> 