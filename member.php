<?php
session_start();
$link = mysqli_connect("localhost", "root");
mysqli_query($link, "SET NAMES 'UTF8'");
mysqli_select_db($link, "sa");

if (isset($_SESSION['name'])) {
$name = $_SESSION['name'];
}

$sql ="select * from account where name = $name ";
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
                    <?php while($row = mysqli_fetch_assoc($rs)){ ?>
                        <p>使用者名稱  <?php echo $row['name']; ?><br></p>
                        <p>帳號  <?php echo $row['account']; ?><br></p>
                        <p>密碼  <?php echo $row['password']; ?><br></p>
                        <p>電子信箱  <?php echo $row['email']; ?><br></p>
                        <p>生日  <?php echo $row['birth']; ?><br></p>
                        <p>居住區域  <?php echo $row['area'] ."  ". $row['address']; ?><br></p>
                        <p>性別  <?php echo $row['gender']; ?><br></p>
                        <?php } ?>
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