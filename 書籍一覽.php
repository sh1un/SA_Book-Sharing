<!DOCTYPE HTML>

<html>
<?php
$book_name = $_GET['book_name'];

$link = mysqli_connect("localhost", "root");
mysqli_query($link, "SET NAMES 'UTF8'");
mysqli_select_db($link, "sa");

$sql = "select * from book_info where book_name = '$book_name'";
$rs = mysqli_query($link, $sql);
$sql2 = "select * from book_info where book_name = '$book_name'";
$rs2 = mysqli_query($link, $sql2);
$book_info = mysqli_fetch_row($rs);

?>

<head>
    <title>書籍
    </title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/register.css" />
</head>

<body class="is-preload">

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Main -->
        <div id="main">
            <div class="inner">

                <!-- Header -->
                <header id="header">
                    <h1>書名 :<?php echo $book_info[3]; ?></h1><br>
                    <h3 align="right"><br><br>立即借書！</h3>

                </header>
                <!-- Banner -->
                <section id="banner">
                    <!--書籍-->
                    <div>
                        <img class="book_jpg_style123" style="width: 200px; height:240px;" src="images/<?php echo $book_info[8]; ?>" alt="">
                    </div>
                    <div class="content">
                        <h4>作者 : <?php echo $book_info[4]; ?></h4>
                        <h4>出版社 : <?php echo $book_info[5]; ?></h4>
                        <h4>出版日期 : <?php echo $book_info[6]; ?></h4>
                        <h4>類別 : <?php echo $book_info[7]; ?></h4>
                        <h4>介紹文 : </h4>
                        <p><?php echo $book_info[9]; ?></p>
                    </div>
                </section>
                <!--搜尋書籍關鍵字結果-->
                <section>
                    <h3 align="center"><br><br>擁有</h3>
                    <div class="have_box">
                        <?php while ($book_all = mysqli_fetch_assoc($rs2)) {
                            $ownsql = "select * from account where account = '$book_info[1]'";
                            $ownrs = mysqli_query($link, $ownsql);
                            $book_own = mysqli_fetch_assoc($ownrs);

                            $usersql = "select * from account where account = '$book_info[2]'";
                            $userrs = mysqli_query($link, $usersql);
                            $book_user = mysqli_fetch_assoc($userrs); ?>

                        <div class="box_action haved_bar">
                            <div class="book_jpg_style123 haved_bar_items">
                                <a href="書籍一覽.php?book_name=<?php echo $book_all['book_name'] ?>" style="margin:30px;">
                                    <img class="book_image" src="images/<?php echo $book_all['book_image']; ?>" /></a>

                            </div>
                            <div class="haved_bar_items">
                                <h4>ID : <?php echo $book_all["book_id"]; ?><br></h4>
                            </div>
                            <div class="haved_bar_item2">
                                <div>
                                    <p>書名 : <?php echo $book_all["book_name"]; ?><br></p>
                                    <p>擁有者 : <?php echo $book_own['name']; ?><br></p>
                                    <p>借閱者 : <?php if ($book_info[2] == "none") {
                                                echo "none";
                                            } else {
                                                echo $book_user['name'];
                                            } ?><br></p>
                                    <p>類別 : <?php echo $book_all["book_category"]; ?><br></p>
                                </div>
                            </div>
                            <div class="haved_bar_items ">
                                <h5><?php if ($book_all['book_user'] == "none") {
                                    echo "<font color = green>●可借閱</font>";} else {echo "<font color = red>●可借閱</font>"; } ?></h5>
                            </div>

                            <div class="haved_bar_items ">
                                <h4><a href="書籍一覽.php?book_name=<?php echo $book_all['book_name'] ?>">借閱</h4>
                            </div>

                        </div>
                    <?php } ?>

                    </div>
                </section>
            </div>






        </div>
        <?php include "index_bar.html" ?>
    </div>




</body>

</html>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>
