<?php
use PHPMailer\PHPMailer\PHPMailer;
require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";
$mail = new PHPMailer(true);
session_start();
include_once 'con.php';
if (isset($_POST["apply"])) {
    $sql = "insert into fleaves(fid,fName,fromDate,toDate,reason,hid) values($_POST[id],'$_POST[name]','$_POST[fdate]', '$_POST[tdate]' ,'$_POST[reason]',$_POST[hod] )";
    mysqli_query($con, $sql);
    $s="select * from hod where hid=$_POST[hod]";
    if($res=mysqli_query($con, $s)){
        $row=mysqli_fetch_assoc($res);
        $to=$row["email"];
        try {
            $mail->isSMTP();                                           
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true ;
            $mail->Username   = 'ssm.gctc@gmail.com';
            $mail->Password   = 'Santosh@2001';
            $mail->SMTPSecure ="ssl" ;
            $mail->Port       = 465;
            $mail->setFrom('ssm.gctc@gmail.com', 'Student Service Manager');
            $mail->addAddress($to); 
            $mail->addReplyTo('ssm.gctc@gmail.com', 'Student Service Manager');
            $mail->isHTML(true);                                 
            $mail->Subject = 'Leave Request';
            $mail->Body    = "Respected Hod,<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; You got a request from Faculty $_POST[name]. Accept/Reject the request through the portal.<br><br>Thanks and Regards,<br>Student Service Manager,<br>Geethanjali College of Engineering and Technology.<br>";
            $mail->send();
            // echo 'Message has been sent';
            echo "<script>alert('Leave Applied');location.replace('facultyHome.php');</script>";
        } catch (Exception $e) {
            echo "<script>alert('Leave Applied');location.replace('facultyHome.php');</script>";
        }
    }
    else {
        mysqli_error($con);
    }
}
