<?php
if (isset($_SESSION['name'])) {
    $name = $_SESSION['name'];
    $account = $_SESSION['account'];
    $link = mysqli_connect("localhost", "root");

    mysqli_query($link, "SET NAMES 'UTF8'");
    mysqli_select_db($link, "sa");
    $sql = "select * from book_info where book_owner = '$account'  order by up_date DESC";
    $rs = mysqli_query($link, $sql);
} else {
    header("location:index.php?log=no");
}

if (isset($_GET['sorf'])) {
    if ($_GET['sorf'] == '上架成功') {
        echo "<script>alert('上架成功')</script>";
    } else if ($_GET['sorf'] == '上架失敗') {
        echo "<script>alert('上架失敗')</script>";
    }
}

?>
<!DOCTYPE HTML>

<html>

<head>
    <title>書籍共享-已上架書籍</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/book-list.css" />

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
                    <?php

                    $name = $_SESSION['name'];
                    $account = $_SESSION['account'];
                    $con = $_SESSION['con'];
                    echo "<ul class='icons'>
                                <li><p>$name ，歡迎光臨 <a href='logout.php' class='button primary small'>登出</span></a></p></li>
                                </ul>";

                    ?>
                </header>



                <!-- 書單 -->
                <!-- 點圖片到書籍資訊頁面 -->
                <section>
                    <header class="major">
                        <h2>已上架書籍</h2>
                    </header>
                    <div class="posts">
                        <?php
                        while ($rslt =  mysqli_fetch_assoc($rs)) {
                            $bookuser_account =  $rslt['book_user'];
                            $sql2 = "select * from account where account = '$bookuser_account'";
                            $reslt = mysqli_query($link, $sql2); //持書者的名字
                            $rslt2 =  mysqli_fetch_assoc($reslt);
                        ?>
                            <article>
                                <div class="img_box">
                                    <img class="img_item" src='images/<?php echo $rslt['book_image']; ?>' alt="" />
                                </div>
                                <h3><?php echo $rslt['book_name'] ?></h3>
                                編號 : <?php echo $rslt['book_id'] ?>
                                <p><?php if ($rslt['book_user'] == "none") {
                                    ?>租借情況：none <br> 租借人：none<?php
                                                            } else { ?>租借情況：租借中 <br> 租借人 : <?php
                                                                    echo $rslt2['name'];
                                                                } ?>
                                <br>捐借人：<?php echo $name ?>
                                <br>上架時間：<?php echo $rslt['up_date'] ?>
                                <br>作者：<?php echo $rslt['book_author'] ?>
                                <br>出版社：<?php echo $rslt['public'] ?>
                                <br>出版日期：<?php echo $rslt['public_date'] ?>
                                <br>類別：<?php echo $rslt['book_category'] ?>

                                </p>


                                <ul class="actions">
                                    <li><a href="下架書籍.php?book_id=<?php echo $rslt['book_id'] ?>" class="button">下架</a></li>
                                    <li><a href="編輯書籍.php?book_id=<?php echo $rslt['book_id'] ?>" class="button">編輯資訊</a></li>

                                </ul>
                            </article>
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
