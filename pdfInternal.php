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
    $pdf->SetFont('Times','',12);
    $print_id= $_GET['print'];
    $sql = "select internalbookinginvoice.BookingNo, internalbookinginvoice.UserID, internalbookinginvoice.RoomNo, room.RoomName, room.Date, room.Time, room.Capacity, internaluser.username, internaluser.useremail from internalbookinginvoice inner join room on internalbookinginvoice.RoomNo = room.RoomNo inner join internaluser on internalbookinginvoice.UserID = internaluser.UserID where internalbookinginvoice.BookingNo= '$print_id'";
    $result = mysqli_query($dbcon, $sql);

    while($rows = mysqli_fetch_array($result))
    {
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Ln();
        $pdf->SetFont('times', 'B', 10);
        $pdf->Cell(65, 10, 'Booking No', 1, 0, 'C');
        $pdf->Cell(125, 10, $rows['BookingNo'], 1, 0, 'L');
        $pdf->Ln();
        $pdf->Cell(65, 10, 'User ID', 1, 0, 'C');
        $pdf->Cell(125, 10, $rows['UserID'], 1, 0, 'L');
        $pdf->Ln();
        $pdf->Cell(65, 10, 'Username', 1, 0, 'C');
        $pdf->Cell(125, 10, $rows['username'], 1, 0, 'L');
        $pdf->Ln();
        $pdf->Cell(65, 10, 'Useremail', 1, 0, 'C');
        $pdf->Cell(125, 10, $rows['useremail'], 1, 0, 'L');
        $pdf->Ln();
        $pdf->Cell(65, 10, 'Room No', 1, 0, 'C');
        $pdf->Cell(125, 10, $rows['RoomNo'], 1, 0, 'L');
        $pdf->Ln();
        $pdf->Cell(65, 10, 'Room Name', 1, 0, 'C');
        $pdf->Cell(125, 10, $rows['RoomName'], 1, 0, 'L');
        $pdf->Ln();
        $pdf->Cell(65, 10, 'Capacity', 1, 0, 'C');
        $pdf->Cell(125, 10, $rows['Capacity'], 1, 0, 'L');
        $pdf->Ln();
        $pdf->Cell(65, 10, 'Date', 1, 0, 'C');
        $pdf->Cell(125, 10, $rows['Date'], 1, 0, 'L');
        $pdf->Ln();
        $pdf->Cell(65, 10, 'Time', 1, 0, 'C');
        $pdf->Cell(125, 10, $rows['Time'], 1, 0, 'L');
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Cell(200,10,'Thank you for using ',0,0,'C');
        $pdf->Ln();
        $pdf->Cell(200,10,'FCSIT Meeting Room Booking and Management System services',0,0,'C');
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Cell(200,10,'Created by: G4_SWEC_69860_69385_69847_71680',0,0,'C');
    }
    $pdf->Output();
    ob_end_flush(); // It's printed here, because ob_end_flush "prints" what's in
              // the buffer, rather than returning it
              //     (unlike the ob_get_* functions)
?>