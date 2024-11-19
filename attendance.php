   <?php
session_start();
include_once 'con.php';
?>
<!doctype html>
<html lang="en">
<head>
    <link rel="icon" href="favicon.ico" type="image/ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Title Here</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include_once 'header.php'; ?>
    <div class="container top-margin">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="cse" data-bs-toggle="tab" data-bs-target="#c-se" type="button" role="tab" aria-controls="cse" aria-selected="true">CSE</button>
                <button class="nav-link" id="ece" data-bs-toggle="tab" data-bs-target="#e-ce" type="button" role="tab" aria-controls="ece" aria-selected="true">ECE</button>
                <button class="nav-link" id="eee" data-bs-toggle="tab" data-bs-target="#e-ee" type="button" role="tab" aria-controls="eee" aria-selected="true">EEE</button>
                <button class="nav-link" id="mech" data-bs-toggle="tab" data-bs-target="#m-ech" type="button" role="tab" aria-controls="mech" aria-selected="true">MECH</button>
                <button class="nav-link" id="civil" data-bs-toggle="tab" data-bs-target="#c-ivil" type="button" role="tab" aria-controls="civil" aria-selected="true">CIVIL</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="c-se" role="tabpanel" aria-labelledby="cse">
                <div class="container details-tab">
                    <table class="table">
                        <tr>
                            <td><b>Name</b></td>
                            <td><b>Roll Number</b></td>
                            <td><b>Attendance</b></td>
                        </tr>
                        <?php
                            $sql = "select * from student where dept='CSE'";
                            if ($res = mysqli_query($con, $sql)) {
                                while ($row = mysqli_fetch_assoc($res)) {
                        ?>
                        <tr>
                            <td><?php echo $row["name"] ?></td>
                            <td><?php echo $row["roll"] ?></td>
                            <td><?php echo $row["attendance"] ?></td>
                        </tr>
                        <?php
                                }
                            }
                        ?>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade show" id="e-ce" role="tabpanel" aria-labelledby="ece">
                <div class="container details-tab">
                    <table class="table">
                        <tr>
                            <td><b>Name</b></td>
                            <td><b>Roll Number</b></td>
                            <td><b>Attendance</b></td>
                        </tr>
                        <?php
                            $sql = "select * from student where dept='ECE'";
                            if ($res = mysqli_query($con, $sql)) {
                                while ($row = mysqli_fetch_assoc($res)) {
                        ?>
                        <tr>
                            <td><?php echo $row["name"] ?></td>
                            <td><?php echo $row["roll"] ?></td>
                            <td><?php echo $row["attendance"] ?></td>
                        </tr>
                        <?php
                                }
                            }
                        ?>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade show" id="e-ee" role="tabpanel" aria-labelledby="eee">
                <div class="container details-tab">
                    <table class="table">
                        <tr>
                            <td><b>Name</b></td>
                            <td><b>Roll Number</b></td>
                            <td><b>Attendance</b></td>
                        </tr>
                        <?php
                            $sql = "select * from student where dept='EEE'";
                            if ($res = mysqli_query($con, $sql)) {
                                while ($row = mysqli_fetch_assoc($res)) {
                        ?>
                        <tr>
                            <td><?php echo $row["name"] ?></td>
                            <td><?php echo $row["roll"] ?></td>
                            <td><?php echo $row["attendance"] ?></td>
                        </tr>
                        <?php
                                }
                            }
                        ?>
                    </table>
                </div>
                <br><br>
            </div>
            <div class="tab-pane fade show " id="m-ech" role="tabpanel" aria-labelledby="mech">
                <div class="container details-tab">
                    <table class="table">
                        <tr>
                            <td><b>Name</b></td>
                            <td><b>Roll Number</b></td>
                            <td><b>Attendance</b></td>
                        </tr>
                        <?php
                            $sql = "select * from student where dept='MECH'";
                            if ($res = mysqli_query($con, $sql)) {
                                while ($row = mysqli_fetch_assoc($res)) {
                        ?>
                        <tr>
                            <td><?php echo $row["name"] ?></td>
                            <td><?php echo $row["roll"] ?></td>
                            <td><?php echo $row["attendance"] ?></td>
                        </tr>
                        <?php
                                }
                            }
                        ?>
                    </table>
                </div>
                <br><br>
            </div><div class="tab-pane fade show " id="c-ivil" role="tabpanel" aria-labelledby="civil">
                <div class="container details-tab">
                    <table class="table">
                        <tr>
                            <td><b>Name</b></td>
                            <td><b>Roll Number</b></td>
                            <td><b>Attendance</b></td>
                        </tr>
                        <?php
                            $sql = "select * from student where dept='CIVIL'";
                            if ($res = mysqli_query($con, $sql)) {
                                while ($row = mysqli_fetch_assoc($res)) {
                        ?>
                        <tr>
                            <td><?php echo $row["name"] ?></td>
                            <td><?php echo $row["roll"] ?></td>
                            <td><?php echo $row["attendance"] ?></td>
                        </tr>
                        <?php
                                }
                            }
                        ?>
                    </table>
                </div>
                <br><br>
            </div>
        </div>   <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>
</body>
<?php include_once "footer.php" ?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script>
    // page specific script here
</script>
</html>      
