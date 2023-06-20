<?php  
include("db_conection.php");  
$cancel_id=$_GET['cancel'];
$cancelroom_id=$_GET['cancelroom'];
  
$stmt=$dbcon->prepare("UPDATE room SET Availability= 'available' WHERE RoomNo= '$cancelroom_id';");
$stmt->execute();
$delete_query="delete from internalbookinginvoice WHERE BookingNo='$cancel_id'";
$run=mysqli_query($dbcon,$delete_query);
if($run)  
{
//javascript function to open in the same window   
    echo "<script>alert('Booking has been canceled. Refund will be deposited into your account within 1 day.')</script>";
    echo "<script>window.open('InternalDashboard.php?canceled=booking has been canceled','_self')</script>";  
}  
?> 