<?php
$name = $_POST['name'];
$birth = $_POST['birth'];
$area = $_POST['area'];
$address = $_POST['address'];
$gender = $_POST['gender'];
$account = $_POST['account'];
$password = $_POST['password'];
$email = $_POST['email'];
$con = $_POST['con'];
$safe_q1 = $_POST['safe_q1'];
$safe_a1 = $_POST['safe_a1'];
$safe_q2 = $_POST['safe_q2'];
$safe_a2 = $_POST['safe_a2'];
$safe_q3 = $_POST['safe_q3'];
$safe_a3 = $_POST['safe_a3'];

$link = mysqli_connect("localhost", "root" ,"12345678");
mysqli_query($link, "SET NAMES 'UTF8'");

mysqli_select_db($link, "sa");

$sql = "select * from account where account = '$account'";
$rs = mysqli_query($link, $sql);
if (mysqli_fetch_assoc($rs)) {
    header("location:register.php?register=exist");
} else {
    $add = "INSERT INTO `account`(`name`, `email`, `birth`, `area` , `address`, `gender`, `account`, `password`, `con`, `a1`, `q1`, `a2`, `q2`, `a3`, `q3`, `point`) 
    VALUES ('$name','$email','$birth','$area', '$address','$gender','$account','$password', '$con', '$safe_a1', '$safe_q1', '$safe_a2', '$safe_q2', '$safe_a3', '$safe_q3',0)";

    if (mysqli_query($link, $add)) {
        header('location:login.php?method=message&message=新增成功');
    } else {
        header('location:register.php?method=message&message=新增失敗');
    }
}
