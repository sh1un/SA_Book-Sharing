<?php
//login傳值
$account = $_POST['account'];
$password = $_POST['password'];
//連結
$link = mysqli_connect("localhost", "root", "12345678");
//mysqli_select_db(連結，database名稱)
mysqli_select_db($link, "sa");
//sql語法
$sql = "select * from account where account = '$account' ";
//mysqli_query(連結，sql語法)
$rs = mysqli_query($link, $sql);
session_start();
if ($user = mysqli_fetch_assoc($rs)) {
    if ($user['password'] == $password) {
        $_SESSION['account'] = $user['account'];
        $_SESSION['name'] = $user['name'];
        header('location:index.php');
    } else {
        header('location:login.php?login=fail&method=message&message=登入失敗');
    }
} else {
    if ($user['account'] != $account) {
        header('location:login.php?login=nofound&method=message&message=登入失敗');
    }
}