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
include_once 'con.php';
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
$leaveId = $_GET["leaveId"];
$roll=$_GET["roll"];
$sql = "update leaves set approved = $_GET[approved] where leaveId = $leaveId";
$st="select * from student where roll=(select studentId from leaves where leaveId=$leaveId)";
$resst=mysqli_query($con,$st);
$rowst=mysqli_fetch_assoc($resst);
$lv="select * from leaves where leaveId=$leaveId";
$reslv=mysqli_query($con,$lv);
$rowlv=mysqli_fetch_assoc($reslv);
$ho="select * from hod where branch='$rowst[dept]'";
$reshv=mysqli_query($con,$ho);
$rowhv=mysqli_fetch_assoc($reshv);
if (mysqli_query($con, $sql)) {
    if ($_GET["approved"] == 1) {
        //accepted to hod
        if($res=mysqli_query($con, $st)){
            $row=mysqli_fetch_assoc($res);
            $to=$rowhv["email"];
            $mail->addAddress($to); 
            try {
                $mail->Body    = "Respected HOD,<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; You got a request from student <b>$rowst[name]</b>, bearing roll no:$rowst[roll] . Accept/Reject the request through the portal.<br><br>Thanks and Regards,<br>Student Service Manager,<br>Geethanjali College of Engineering and Technology.<br>";
                $mail->send();
                // echo 'Message has been sent';
                echo "<script>alert('Leave Accepted');location.replace('facultyHome.php');</script>";
            } catch (Exception $e) {
                echo "<script>alert('Leave Accepted');location.replace('facultyHome.php');</script>";
            }
        }
        echo "<script>alert('Leave approval sent to HOD');location.replace('facultyHome.php');</script>";
    } else if ($_GET["approved"] == 2) {
        //accepted mail parent and student
        if($res=mysqli_query($con, $st)){
            $row=mysqli_fetch_assoc($res);
            $to=$row["email"];
            $mail->addAddress($to); 
            try {
                $mail->Body= "Dear Student,<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Your request for a leave stating the reason '$rowlv[reason]' on '$rowlv[date]' has been <b style=color:green;>Accepted</b>.Please take care.<br>Thanks and Regards,<br>Hod,<br>Geethanjali college of Engineering and Trechnology.";
                $mail->send();
                $to=$row["fatherEmail"];
                $mail->addAddress($to); 
                $mail->Body= "Dear parent,<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Your ward <b>$rowst[name]</b> ,bearing Roll no: <b>$rowst[roll]</b> ,has requested for a leave stating the reason '$rowlv[reason]' on '$rowlv[date]' and the request has been <b style=color:green;>Accepted</b>.Please take care of your child.<br>Thanks and Regards,<br>Hod,<br>Geethanjali college of Engineering and Trechnology.";
                $mail->send();
                // echo 'Message has been sent';
                echo "<script>alert('Leave Approved');location.replace('hodHome.php');</script>";
            } catch (Exception $e) {
                echo "<script>alert('Leave Approved');location.replace('hodHome.php');</script>";
            }
        }
        echo "<script>alert('Leave Approved');location.replace('hodHome.php');</script>";
    } else {
        if (isset($_SESSION['hodDetails'])) {
            // hod to stundent rejected
            if($res=mysqli_query($con, $st)){
                $row=mysqli_fetch_assoc($res);
                $to=$row["email"];
                $mail->addAddress($to); 
                try {
                    $mail->Body= "Dear Student,<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Your request for a leave stating the reason '$rowlv[reason]' on '$rowlv[date]' has been <b style=color:red;>Rejected</b>.Please take care.<br>Thanks and Regards,<br>Hod,<br>Geethanjali college of Engineering and Trechnology.";
                    $mail->send();
                    $to=$row["fatherEmail"];
                    $mail->addAddress($to); 
                    $mail->Body= "Dear parent,<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Your ward <b>$rowst[name]</b> ,bearing Roll no: <b>$rowst[roll]</b> ,has requested for a leave stating the reason '$rowlv[reason]' on '$rowlv[date]' and the request has been <b style=color:red;>Rejected</b>.Please take care of your child.<br>Thanks and Regards,<br>Hod,<br>Geethanjali college of Engineering and Trechnology.";
                    $mail->send();
                    // echo 'Message has been sent';
                    echo "<script>alert('Leave Rejected');location.replace('hodHome.php');</script>";
                } catch (Exception $e) {
                    echo "<script>alert('Leave Rejected');location.replace('hodHome.php');</script>";
                }
            }
            echo "<script>alert('Leave Rejected');location.replace('hodHome.php');</script>";
        } else {
            // faculty to  stundet rejected
            if($res=mysqli_query($con, $st)){
                $row=mysqli_fetch_assoc($res);
                $to=$row["email"];
                $mail->addAddress($to); 
                try {
                    $mail->Body= "Dear Student,<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Your request for a leave stating the reason '$rowlv[reason]' on $rowlv[date] has been <b style=color:red;>Rejected</b>.Please take care.<br>Thanks and Regards,<br>Faculty,<br>Geethanjali college of Engineering and Trechnology.";
                    $mail->send();
                    // echo 'Message has been sent';
                    echo "<script>alert('Leave Rejected');location.replace('facultyHome.php');</script>";
                } catch (Exception $e) {
                    echo "<script>alert('Leave Rejected');location.replace('facultyHome.php');</script>";
                }
            }
            echo "<script>alert('Leave rejected');location.replace('facultyHome.php');</script>";
        }
    }
} else {
    mysqli_error($con);
    die("<br>Something wrong");
}
