<?php  
include("db_conection.php");  
$delete_id=$_GET['del'];  
$delete_query="delete  from room WHERE RoomNo='$delete_id'";//delete query  
$run=mysqli_query($dbcon,$delete_query);  
if($run)  
{
//javascript function to open in the same window  
    echo "<script>alert('Room has been deleted.')</script>";
    echo "<script>window.open('AdminRoom.php?deleted=room has been deleted','_self')</script>";  
}  
?> 