<?php
session_start();
if (isset($_SESSION['name'])) {
    $name = $_SESSION['name'];
    $link = mysqli_connect("localhost", "root");

    mysqli_query($link, "SET NAMES 'UTF8'");
    mysqli_select_db($link, "sa");
    $sql = "select * from book_info where book_owner = '$name'";
    $rs = mysqli_query($link, $sql);
} else {
    header("location:index.php?log=no");
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
                    <a href="index.php" class="logo"><strong>書籍共享</strong></a>
                    <ul class="icons">
                        <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
                        <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
                        <li><a href="#" class="icon brands fa-snapchat-ghost"><span class="label">Snapchat</span></a></li>
                        <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
                        <li><a href="#" class="icon brands fa-medium-m"><span class="label">Medium</span></a></li>
                    </ul>
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
                        ?>
                            <article>
                                <a href="書籍內容.php?book_id=<?php echo $rslt['book_id'] ?>" class="image">
                                    <img src='images/<?php echo $rslt['book_image']; ?>' alt="" /></a>
                                <h3><?php echo $rslt['book_name'] ?></h3>
                                編號 : <?php echo $rslt['book_id'] ?>
                                <p>租借情況：<?php if ($rslt['book_user'] == "無") {
                                            echo "無";
                                        } else {
                                            echo $rslt['book_user'];
                                        }
                                        ?><br>租借人：<?php echo $rslt['book_user'] ?>
                                    <br>捐借人：<?php echo $rslt['book_owner'] ?>
                                    <br>作者：<?php echo $rslt['book_author'] ?>
                                    <br>出版社：<?php echo $rslt['public'] ?>
                                    <br>出版日期：<?php echo $rslt['public_date'] ?>
                                    <br>類別：<?php echo $rslt['book_category'] ?>

                                </p>


                                <ul class="actions">
                                    <li><a href="下架書籍.php?book_id=<?php echo $rslt['book_id'] ?>" class="button">下架</a></li>
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