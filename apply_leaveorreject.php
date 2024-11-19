<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once "PHPMailer/PHPMailer.php";

require_once "PHPMailer/SMTP.php";

require_once "PHPMailer/Exception.php";

$mail = new PHPMailer(true);

session_start();

 print_r($_SESSION);

 if (isset($_SESSION["studentDetails"])) {

die("not authorized");

 }



 include once 'con.php';



 $mail->isSMTP();

 $mail->Host smtp.gmail.com';

 $mail->SMTPAuth true;

 $mail->Username ='ssm.gctc@gmail.com';

 $mail->Password ='Santosh@2001';

 $mail->SMTPSecure="ssl";

 $mail->Port= 465;

 $mail->setFrom('ssm.gctc@gmail.com', 'Student Service Manager');

 $mail->addReplyTo('ssm.gctc@gmail.com', 'Student Service Manager');

 $mail->isHTML(true);

 $mail->Subject 'Leave Request';



 $leaveId=$_GET["leaveld");

 $roll-$_GET["roll"];



 $sql "update leaves set approved $_GET[approved] where leaveld Sleaveld";

 $st select from student where roll (select studentId from leaves where leaveld-SleaveId)";

 $resst-mysqli_query($con, $st);

 $rowst-mysqli_fetch_assoc($resst);

 $lve select from leaves where leaveId=$leaveId";

 $resiv-mysqli_query($con, $iv);

 $rowlv-mysqli_fetch_assoc($reslv);



 $ho="select from hod where branch- $rowst[dept]'";

 $reshv-mysqli_query($con, sho);

 $rowhv-mysqli_fetch_assoc($reshv);

}
