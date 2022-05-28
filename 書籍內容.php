<!DOCTYPE HTML>

<html>

<?php
session_start();
$name = $_SESSION['name'];
$account = $_SESSION['account'];
$_SESSION['book_id'] = $_GET['book_id'];
$book_id = $_SESSION['book_id'];
$link = mysqli_connect("localhost", "root");
mysqli_query($link, "SET NAMES 'UTF8'");

mysqli_select_db($link, "sa");

$sql = "select * from book_info where book_id = '$book_id'";
$rs = mysqli_query($link, $sql);

?>

<head>
    <title>書籍共享平台-書籍上架</title>
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
                    <a href="index.php" class="logo"><strong>首頁</strong></a>

                </header>

                <!-- Content -->

                <section id="banner">
                    <div class="content">
                        <?php if ($book_info = mysqli_fetch_row($rs)) { ?>
                            <header>
                                <h1>書名 : <?php echo $book_info[3]; ?><br></h1>
                                <h4>編號 : <?php echo $book_id; ?></h4>
                                <h4>擁有者 : <?php echo $book_info[1]; ?></h4>
                                <h4>借閱者 : <?php echo $book_info[2]; ?></h4>
                                <h4>上架日期 : <?php echo $book_info[10]; ?></h4>
                                <h4>作者 : <?php echo $book_info[4]; ?></h4>
                                <h4>出版社 : <?php echo $book_info[5]; ?></h4>
                                <h4>出版日期 : <?php echo $book_info[6]; ?></h4>
                                <h4>類別 : <?php echo $book_info[7]; ?></h4>
                                
                            </header>

                            <p>介紹文 : <?php echo $book_info[9]; ?></p>
                            <ul class="actions">
                                <li><?php if ($book_info[1] == $name) { ?><a href="下架書籍.php?book_id=$book_id" class="button big">下架</a>
                                    <?php } else if ($book_info[2] == 'none') { ?><a href="borr.php?br=b" class="button big">借閱</a><?php } ?>
                                </li>
                            </ul>

                    </div>
                    <span class="image object">
                        <img src="images/<?php echo $book_info[8]; ?>" alt="">
                    </span>
                <?php } ?>
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