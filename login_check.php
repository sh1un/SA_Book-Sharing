<?php
//login傳值
$account = $_POST['account'];
$password = $_POST['password'];
//連結
$link = mysqli_connect("localhost", "root" ,"12345678");

mysqli_query($link, "SET NAMES 'UTF8'");
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
        $_SESSION['con'] = $user['con'];
        //每日登入
        $now_login = date("Y-m-d");
        if ($now_login <> $user['lasttime_login']) {
            $point = $user['point'] + 1;
            $login_sql = "UPDATE `account` SET `lasttime_login`='$now_login',`point`='$point' WHERE account = '$_SESSION[account]'";
            mysqli_query($link, $login_sql);
            echo "<script>alert('登入成功，獲得1point'); location.href='index.php'</script>";
        } else {
            header('location:index.php');
        }
    } else {
        header('location:login.php?login=fail&method=message&message=登入失敗');
    }
} else {
    if ($user['account'] != $account) {
        header('location:login.php?login=nofound&method=message&message=登入失敗');
    }
}
