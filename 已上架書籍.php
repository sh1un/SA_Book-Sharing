<?php
session_start();
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
                   
                </header>



                <!-- 書單 -->
                <!-- 點圖片到書籍資訊頁面 -->
                <section>
                    <header class="major">
                        <h2>已上架書籍</h2>
                    </header>
                    <form action="編輯書籍.php" method="POST">
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
                                <input type="hidden" value=<?php echo $rslt['book_image']; ?> name="book_image">
                                    <img class="img_item" src='images/<?php echo $rslt['book_image']; ?>' alt="" /></div>
                                    <input type="hidden" value=<?php echo $rslt['book_name'] ?> name="book_name">
                                    <h3><?php echo $rslt['book_name'] ?></h3>
                                編號 : <input type="hidden" value=<?php echo $rslt['book_id'] ?> name="book_id">
                                <?php echo $rslt['book_id'] ?>
                                <p><?php if ($rslt['book_user'] == "none") {
                                    ?><input type="hidden" value="none" name="book_user">
                                    租借情況：none <br> 租借人：none<?php
                                    } else { ?><input type="hidden" value="<?php echo $rslt2['name']?>" name="book_user">
                                    租借情況：租借中 <br> 租借人 : <?php
                                            echo $rslt2['name'];}?>
                                <br>捐借人：<input type="hidden" value=<?php echo $name ?> name="book_owner">
                                <?php echo $name ?>
                                <br>上架時間：<input type="hidden" value=<?php echo $rslt['up_date'] ?> name="up_date">
                                <?php echo $rslt['up_date'] ?>
                                <br>作者：<input type="hidden" value=<?php echo $rslt['book_author'] ?> name="book_author">
                                <?php echo $rslt['book_author'] ?>
                                <br>出版社：<input type="hidden" value=<?php echo $rslt['public'] ?> name="public">
                                <?php echo $rslt['public'] ?>
                                <br>出版日期：<input type="hidden" value=<?php echo $rslt['public_date'] ?> name="public_date">
                                <?php echo $rslt['public_date'] ?>
                                <br>類別：<input type="hidden" value=<?php echo $rslt['book_category'] ?> name="book_category">
                                <?php echo $rslt['book_category'] ?>

                                </p>


                                <ul class="actions">
                                    <li><a href="下架書籍.php?book_id=<?php echo $rslt['book_id'] ?>" class="button">下架</a></li>
                                    <li><input type="submit" class="input_btn" value="編輯資訊"></li>
                                    

                                </ul>
                            </article>
                        <?php } ?>


                    </div>
                    </form>
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