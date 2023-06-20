<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
include("db_conection.php");
//Load Composer's autoloader
require 'api/vendor/autoload.php';
require 'api/vendor/phpmailer/phpmailer/src/Exception.php';
require 'api/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'api/vendor/phpmailer/phpmailer/src/SMTP.php';
//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
try {
    //Server settings

    $mail->IsSMTP();                                           //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'muemueciaos@gmail.com';                     //SMTP username
    $mail->Password   = '990401aa316';                               //SMTP password
    $mail->SMTPSecure = 'PHPMailer::ENCRYPTION_SMTPS';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    //Attachments
    //$mail->addAttachment('erd.pdf');         //Add attachments
    //Content
    $print_id= $_GET['email'];
    $sql = "SELECT internalbookinginvoice.BookingNo, internalbookinginvoice.UserID, internalbookinginvoice.RoomNo, room.RoomName, room.Date, room.Time, room.Capacity, internaluser.username, internaluser.useremail FROM internalbookinginvoice INNER JOIN room ON internalbookinginvoice.RoomNo = room.RoomNo INNER JOIN internaluser ON internalbookinginvoice.UserID = internaluser.UserID WHERE internalbookinginvoice.BookingNo= '$print_id'";
    $result = mysqli_query($dbcon, $sql);
    while($rows = mysqli_fetch_array($result))
    {
        $BookingNo= $rows['BookingNo'];
        $UserID= $rows['UserID'];
        $username= $rows['username'];
        $useremail= $rows['useremail'];
        $RoomNo= $rows['RoomNo'];
        $RoomName= $rows['RoomName'];
        $Capacity= $rows['Capacity'];
        $Date= $rows['Date'];
        $Time= $rows['Time'];
    }

    $body= "<b>Here are your booking details:</b><br><br>Booking Number: $BookingNo <br> UserID: $UserID <br> username: $username <br> useremail: $useremail <br> RoomNo: $RoomNo <br> RoomName: $RoomName <br> Capacity: $Capacity <br> Date: $Date <br> Time: $Time <br><br> Thank you for using FCSIT Meeting Room Booking and Management System services. 😊";
    

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'FCSIT Meeting Room Booking and Management System';
    $mail->Body    = $body;
    $mail->AltBody = strip_tags($body);

    //Recipients
    $mail->setFrom('muemueciaos@gmail.com', 'TeamSWEC', 0);
    $mail->addAddress($useremail);            //Add a recipient

    $mail->send();
    echo "<script>alert('Invoice has been sent to $useremail. Thank you.')</script>";
    echo "<script>window.open('InternalDashboard.php','_self')</script>";
} catch (Exception $e) {
    echo "<script>alert('E-mail could not be sent. Mailer Error: {$mail->ErrorInfo}')</script>";
    echo "<script>window.open('InternalDashboard.php','_self')</script>";
}