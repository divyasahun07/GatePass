<?php
use PHPMailer\PHPMailer\PHPMailer;
require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";
$mail = new PHPMailer(true);
session_start();
if (!isset($_SESSION["hodDetails"])) {
    die("not authorized");
}
include_once 'con.php';
$leaveId = $_GET["leaveId"];
$sql = "update fleaves set status = $_GET[approved] where leaveId = $leaveId";
$fl="select * from fleaves where leaveId = $leaveId";
$qs=mysqli_query($con, $fl);
$flres=mysqli_fetch_assoc($qs);
$s ="select * from faculty where fid=(select fid from fleaves where leaveId=$leaveId)";
$mail->isSMTP();                                           
$mail->Host       = 'smtp.gmail.com';
$mail->SMTPAuth   = true ;
$mail->Username   = 'ssm.gctc@gmail.com';
$mail->Password   = 'Santosh@2001';
$mail->SMTPSecure ="ssl" ;
$mail->Port       = 465;
$mail->setFrom('ssm.gctc@gmail.com', 'Student Service Manager');
$mail->addReplyTo('ssm.gctc@gmail.com', 'Student Service Manager');
$mail->isHTML(true);                                 
$mail->Subject = 'Leave Request';
if (mysqli_query($con, $sql)) {
    if ($_GET["approved"] == 1) {
        // accepted to faculty
        if($res=mysqli_query($con, $s)){
            $row=mysqli_fetch_assoc($res);
            $to=$row["email"];
            $mail->addAddress($to); 
            try {
                $mail->Body    = "Dear Faculty,<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Your request for a leave stating the reason '$flres[reason]' from $flres[fromDate] to $flres[toDate] has been <b style=color:green;>Accepted</b>. Please take care.<br>Thanks and Regards,<br>Hod,<br>Geethanjali college of Engineering and Trechnology.";
                $mail->send();
                // echo 'Message has been sent';
                echo "<script>alert('Leave Approved');location.replace('hodHome.php');</script>";
            } catch (Exception $e) {
                echo "<script>alert('Leave Approved');location.replace('hodHome.php');</script>";
            }
        }
        echo "<script>alert('Leave Approved');location.replace('hodHome.php');</script>";
    } else if ($_GET["approved"] == 2) {
        if($res=mysqli_query($con, $s)){
            $row=mysqli_fetch_assoc($res);
            $to=$row["email"];
            $mail->addAddress($to); 
            try {
                $mail->Body    = "Dear Faculty,<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Your request for a leave stating the reason '$flres[reason]' from $flres[fromDate] to $flres[toDate] has been <b style=color:red;>Rejected</b>. Please take care.<br>Thanks and Regards,<br>Hod,<br>Geethanjali college of Engineering and Trechnology.";
                $mail->send();
                // echo 'Message has been sent';
                echo "<script>alert('Leave Rejected');location.replace('hodHome.php');</script>";
            } catch (Exception $e) {
                echo "<script>alert('Leave Rejected');location.replace('hodHome.php');</script>";
            }
        }
        //rejectd to faculty
        echo "<script>alert('Leave Rejected');location.replace('hodHome.php');</script>";
    }
} else {
    mysqli_error($con);
    die("<br>Something wrong");
}
