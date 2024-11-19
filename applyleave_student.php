<?php
use PHPMailer\PHPMailer\PHPMailer;
require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";
$mail = new PHPMailer(true);
session_start();
include_once 'con.php';
if (isset($_POST["apply"])) {
    $sql = "insert into leaves(studentId,facultyId,reason,date) values('$_POST[id]',$_POST[incharge], '$_POST[reason]' ,'$_POST[date]' )";
    mysqli_query($con, $sql);
    $s = "select email from faculty where fid=".$_POST['incharge'];
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
            $mail->Body    = "Respected Faculty,<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
            You got a request from student bearing roll no: $_POST[id]. 
            Accept/Reject the request through the portal.<br><br>Thanks and Regards
            ,<br>Student Service Manager,<br>Geethanjali College of Engineering and Technology.<br>";
            $mail->send();
            // echo 'Message has been sent';
            echo "<script>alert('Leave Applied');location.replace('studentHome.php');</script>";
        } catch (Exception $e) {
            echo "<script>alert('Leave Applied');location.replace('studentHome.php');</script>";
        }
    }
