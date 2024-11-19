<?php
$dbhost="localhost";
$dbuser="root";
$dbpass="";
$db="ssm";
$con=new mysqli($dbhost,$dbuser,$dbpass,$db) or dies("connect failed: %s\n",$conn->error);
