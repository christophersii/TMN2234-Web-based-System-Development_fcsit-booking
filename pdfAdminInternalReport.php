<?php
  include("db_conection.php");
  $username= $ContactNo = "";
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $from= ($_POST['frominternalreport']);
      $until= ($_POST['untilinternalreport']);

      //username
      if (empty($from)){
          $from = false;
          echo "<script>alert('Date cannot be empty. Form not submitted, please try again.')</script>";
          echo "<script>window.open('AdminDashboard.php','_self')</script>";
          exit();
      }else{
          $from = true;
      }
      
      //mobile
      if (empty($until)){
          $until = false;
          echo "<script>alert('Date cannot be empty. Form not submitted, please try again.')</script>";
          echo "<script>window.open('AdminDashboard.php','_self')</script>";
          exit();
      }else{
          $until = true;
      }
      
    if ($from == true && $until == true){
      $from= ($_POST['frominternalreport']);
      $until= ($_POST['untilinternalreport']);

      //Database connection
      if ($dbcon->connect_error){
        die('Connection Failed : ' .$dbcon->connect_error);
      }
      else{
        ob_start(); // it starts buffering
        require('api/pdf/fpdf.php');
        include("db_conection.php");
        class PDF extends FPDF{
            // Page header
            function Header()
            {
                // Logo
                $this->Image('image/icon.png',16,6,20);
                // Arial bold 15
                $this->SetFont('Times','B',15);
                // Move to the right
                $this->Cell(80);
                // Title
                $this->Cell(45,10,'FCSIT Meeting Room Booking and Management System',0,0,'C');
                // Line break
                $this->Ln(14);
                $this->Cell(200,10,'Internal Booking Report',0,0,'C');
            }

            // Page footer
            function Footer()
            {
                $this->SetY(-15);
                $this->SetFont('Times','I',8);
                $this->Cell(0,10, $this->PageNo(),0,0,'C');
            }
        }

        // Instanciation of inherited class
        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times','',8);

        $sql = "select internalbookinginvoice.BookingNo, internalbookinginvoice.UserID, internalbookinginvoice.RoomNo, room.RoomName, room.Date, room.Time, room.Capacity, internaluser.username, internaluser.useremail from internalbookinginvoice inner join room on internalbookinginvoice.RoomNo = room.RoomNo inner join internaluser on internalbookinginvoice.UserID = internaluser.UserID WHERE room.Date BETWEEN '$from' AND '$until'";
        $result = mysqli_query($dbcon, $sql);

        $pdf->SetFont('Times', 'B', 8);
        $pdf->Ln();
        $pdf->SetFont('times', 'B', 8);
        $pdf->Cell(20, 10, 'Booking No', 1, 0, 'C');
        $pdf->Cell(15, 10, 'User ID', 1, 0, 'C');
        $pdf->Cell(30, 10, 'User Name', 1, 0, 'C');
        $pdf->Cell(30, 10, 'User Email', 1, 0, 'C');
        $pdf->Cell(15, 10, 'Room No', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Room Name', 1, 0, 'C');
        $pdf->Cell(15, 10, 'Capacity', 1, 0, 'C');
        $pdf->Cell(20, 10, 'Date', 1, 0, 'C');
        $pdf->Cell(15, 10, 'Time', 1, 0, 'C');



        while($rows = mysqli_fetch_array($result))
        {
            $pdf->Ln();
            $pdf->SetFont('times', 'B', 8);
            $pdf->Cell(20, 10, $rows['BookingNo'], 1, 0, 'C');
            $pdf->Cell(15, 10, $rows['UserID'], 1, 0, 'C');
            $pdf->Cell(30, 10, $rows['username'], 1, 0, 'C');
            $pdf->Cell(30, 10, $rows['useremail'], 1, 0, 'C');
            $pdf->Cell(15, 10, $rows['RoomNo'], 1, 0, 'C');
            $pdf->Cell(30, 10, $rows['RoomName'], 1, 0, 'C');
            $pdf->Cell(15, 10, $rows['Capacity'], 1, 0, 'C');
            $pdf->Cell(20, 10, $rows['Date'], 1, 0, 'C');
            $pdf->Cell(15, 10, $rows['Time'], 1, 0, 'C');
            

        }

        $pdf->Ln();
        $pdf->Ln();
        $pdf->Cell(200,10,'Thank you for using ',0,0,'C');
        $pdf->Ln();
        $pdf->Cell(200,10,'FCSIT Meeting Room Booking and Management System services',0,0,'C');
        $pdf->Ln();
        $pdf->Cell(200,10,'Created by: G4_SWEC_69860_69385_69847_71680',0,0,'C');
    
        $pdf->Output();
        ob_end_flush(); // It's printed here, because ob_end_flush "prints" what's in
                // the buffer, rather than returning it
                //     (unlike the ob_get_* functions)
      }
    }
    else{
      echo"<script>alert('Form not submitted, please try again.')</script>";
      echo "<script>window.open('AdminDashboard.php','_self')</script>";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Internal Report</title>
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
    <div class="form_wrapper">
        <div class="form_container">
        <div class="title_container">
            <h2>Print Internal Report</h2>
        </div>
            <div>
                <form method="post">
                    <div> 
                        <span>From</span>
                        <input type="date" name="frominternalreport" placeholder="Date"  />
                    </div>
                    <div > 
                        <span>Until </span>
                        <input type="date" name="untilinternalreport" placeholder="Date"  />
                    </div>
                    <input type="submit" name= "internalreport" Value="Print">
                    <a class="button1" href="AdminDashboard.php">Back</a>
                </form>
            </div>
        </div>
    </div>
    <div class="footer">
        <h4>Created by:<sup>G4_ </sup>SWEC_ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/view.php?id=5547" target="_blank">69860</a></sub> _ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/profile.php?id=5567">69385</a></sub> _ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/view.php?id=5548" target="_blank">69847</a></sub> _ <sub><a class= "subfooter" href="https://eleap.unimas.my/user/profile.php?id=5560">71680</a> </sub></h4>
    </div>
</body>
</html>








    

