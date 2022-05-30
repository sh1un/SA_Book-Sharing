<?php
session_start();
$link = mysqli_connect("localhost", "root");
mysqli_query($link, "SET NAMES 'UTF8'");
mysqli_select_db($link, "sa");

if (isset($_SESSION['name'])) {
$name = $_SESSION['name'];
$account = $_SESSION['account'];
}
else{echo "Error";} //test

$sql ="select * from account where name = $name and account = $account ";
$rs = mysqli_query($link, $sql);


if (isset($_GET['log'])) {
    if ($_GET['log'] == 'no') {
        echo "<script>alert('請先登入帳號密碼')</script>";
}}
?>
<!DOCTYPE HTML>

<html>

<head>
    <title>書籍共享平台</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
</head>

<body class="is-preload">

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Main -->
        <div id="main">
            <div class="inner">

                <!-- Header -->
                <header id="header">
                    <h2>會員中心</h2>
                </header>

                <!-- Banner -->

                <section id="banner">
                    <div class="content">
                        <form action="update.php">
                        <table>
                    <?php while($row = mysqli_fetch_assoc($rs)){ ?>
                        <tr>
                            <td>使用者名稱</td>
                            <td><?php echo $row['name']; ?></td>
                        </tr>
                        <tr>
                            <td>帳號</td>
                            <td><?php echo $row['account']; ?></td>
                        </tr>
                        <tr>
                            <td>密碼</td>
                            <td><?php echo $row['password']; ?></td>
                        </tr>
                        <tr>
                            <td>電子信箱</td>
                            <td><?php echo $row['email']; ?></td>
                        </tr>
                        <tr>
                            <td>生日</td>
                            <td><?php echo $row['birth']; ?></td>
                        </tr>
                        <tr>
                            <td>居住區域</td>
                            <td><?php echo $row['area'] ."  ". $row['address']; ?></td>
                        </tr>
                        <tr>
                            <td>性別</td>
                            <td><?php if($row['gender'] == 'fe'){ echo "女";}
                             else if($row['gender'] == 'ma'){ echo "男";}?></td>
                        </tr>
                        <?php } ?>
                        </table>
                        <div align="center">
                        <input type="submit" class="input_btn" value="編輯會員資料"><br>
                        </div>
                    </form>
                    </div>
                </section>

            </div>
        </div>
        <?php include "index_bar.html" ?>

    </div>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>