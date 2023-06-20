<?php  
    include("db_conection.php");  
    $delete_id=$_GET['del'];  
    $delete_query="delete from internaluser WHERE UserID='$delete_id'";//delete query  
    $run=mysqli_query($dbcon,$delete_query);  
    if($run)  
    {
    //javascript function to open in the same window   
        echo "<script>alert('User has been deleted.')</script>";
        echo "<script>window.open('AdminInternal.php?deleted=user has been deleted','_self')</script>";  
    }  
?> 