<?php
if (!(isset($_SESSION['name']))) {
    header("location:index.php?log=no");
} else {
    $name = $_SESSION['name'];
    $account = $_SESSION['account'];
    $link = mysqli_connect("localhost", "root");
    mysqli_query($link, "SET NAMES 'UTF8'");

    mysqli_select_db($link, "sa");
    $sql = "select * from book_info where book_user = '$account'  order by up_date DESC";
    $rs = mysqli_query($link, $sql);
}

?>
<!DOCTYPE HTML>

<html>

<head>
    <title>書籍共享-已借書籍</title>
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
                        <h2>已借書籍</h2>
                    </header>
                    <div class="posts">
                        <?php
                        while ($rslt =  mysqli_fetch_assoc($rs)) {
                            $bookowner_account =  $rslt['book_owner'];
                            $sql2 = "select * from account where account = '$bookowner_account'";
                            $reslt = mysqli_query($link, $sql2); //擁有書者的名字
                            $rslt2 =  mysqli_fetch_assoc($reslt);
                        ?>
                            <article>
                            <div class="img_box">
                                    <img class="img_item" src='images/<?php echo $rslt['book_image']; ?>' alt="" /></div>
                                
                                <h3><?php echo $rslt['book_name'] ?></h3>
                                <p>租借情況：<?php if ($rslt['book_user'] == "none") {
                                            echo "none";
                                        } else {
                                            echo "租借中";
                                        }
                                        ?><br>捐借人：<?php echo $rslt2['name'] ?>
                                    <br>租借人：<?php echo $name ?>
                                    <br>上架時間：<?php echo $rslt['up_date'] ?>
                                    <br>作者：<?php echo $rslt['book_author'] ?>
                                    <br>出版社：<?php echo $rslt['public'] ?>
                                    <br>出版日期：<?php echo $rslt['public_date'] ?>
                                    <br>類別：<?php echo $rslt['book_category'] ?>
                                </p>

                                <ul class="actions">
                                    <li><a href="return.php?book_id=<?php echo $rslt['book_id'] ?>" class="button">還書</a></li>
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
