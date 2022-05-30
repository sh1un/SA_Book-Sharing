<?php 
session_start();
$link = mysqli_connect("localhost", "root");
mysqli_query($link, "SET NAMES 'UTF8'");
mysqli_select_db($link, "sa");
if(empty($_SESSION['name'])){
    header('location:index.php');
}
else if (isset($_SESSION['name'])) {
    $name = $_SESSION['name'];
    }
    
    $udname = $_POST['udname'];
    $udaccount = $_POST['udaccount'];
    $udpassword = $_POST['udpassword'];
    $udemail = $_POST['udemail'];
    $udbirth = $_POST['udbirth'];
    $udarea = $_POST['udarea'];
    $udaddress = $_POST['udaddress'];
    $udgender = $_POST['udgender'];

    if(!empty($udname)){
        $sql = "update account set name = '$udname', account = '$udaccount', password = '$udpassword', 
    email = '$udemail', birth = '$udbirth', area = '$udarea', address = '$udaddress', gender = '$udgender' where name = '$name'";
        mysqli_query($link, $sql);
        header('location:member.php?資料已修改');
    }
    ?>