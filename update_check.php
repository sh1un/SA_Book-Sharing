<?php
session_start();
$link = mysqli_connect("localhost", "root");
mysqli_query($link, "SET NAMES 'UTF8'");
mysqli_select_db($link, "sa");

$account = $_SESSION['account'];

$udname = $_POST['udname'];
$udpassword = $_POST['udpassword'];
$udemail = $_POST['udemail'];
$udbirth = $_POST['udbirth'];
$udarea = $_POST['udarea'];
$udaddress = $_POST['udaddress'];
$udgender = $_POST['udgender'];
$udcon = $_POST['udcon'];

$sql = "UPDATE `account` SET `name`='$udname',`password`='$udpassword',`email`='$udemail',`birth`='$udbirth'
,`area`='$udarea',`address`='$udaddress',`gender`='$udgender',`con`='$udcon' WHERE account = '$account'";


if (mysqli_query($link, $sql)) {
    $_SESSION['name']=$udname;
    header('location:member.php?資料已修改');
    
}
