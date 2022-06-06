<!DOCTYPE HTML>

<html>
<?php
session_start();
$book_name = $_POST['book_name'];
$account = $_SESSION['account'];
$link = mysqli_connect("localhost", "root");
mysqli_query($link, "SET NAMES 'UTF8'");
mysqli_select_db($link, "sa");
//抓評論資料
$rate_sql = "select * from evaluation where book_id = '$_GET[book_id]'";
$rate_rs = mysqli_query($link, $rate_sql);
//抓書籍資料
$book_sql = "select * from book_info where book_id = '$_GET[book_id]'";
$book_rs = mysqli_query($link, $book_sql);
//點數
$point_sql = "select * from account where account = '$account'";
$point_rs = mysqli_query($link, $point_sql);
$point = mysqli_fetch_array($point_rs);
$points = $point['point'];
?>

<head>
    <title>書籍</title>
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
                    <h1>書名 :</h1><br>
                    <h3 align="right"><br><br>立即借書！</h3>

                </header>

                <!--破損情況-->
                <section>
                    <form action="addorder.php" method="post">
                        <div class="brok_box">

                            <?php
                            $book = mysqli_fetch_assoc($book_rs);
                            //借書跟捐書人的名字
                            $ownsql = "select * from account where account = '$book[book_owner]'";
                            $ownrs = mysqli_query($link, $ownsql);
                            $book_own = mysqli_fetch_assoc($ownrs);
                            $usesql = "select * from account where account = '$book[book_user]'";
                            $users = mysqli_query($link, $usesql);
                            $book_use = mysqli_fetch_assoc($users);
                            ?> <div class="brok_box_item link-right">
                                <img class="brok_img" src="images/<?php echo $book['book_image']; ?>" />
                                <h4><?php echo $book['book_name']; ?></h4>
                                <input type='hidden' name='book_name' value="<?php echo $book['book_name']; ?>">
                                <h8>#<?php echo $book['book_id']; ?><br></h8>
                                <input type='hidden' name='book_id' value="<?php echo $_GET['book_id']; ?>">
                                <h5>擁有者 : <?php echo $book_own['account']; ?><br></h5>
                                <input type="hidden" name="book_own" value="<?php echo $book['book_owner']; ?>">
                                <h5>租借者 : <?php if ($book['book_user'] == "none") {
                                                echo "none";
                                            } else {
                                                echo $book_use['account'];
                                            } ?><br></h5>
                                <input type="hidden" name="book_user" value="<?php echo $account; ?>">
                                <h7>作者 : <?php echo $book['book_author']; ?><br></h7>
                                <h7>出版社 : <?php echo $book['public']; ?><br></h7>
                                <h7>出版日期 : <?php echo $book['public_date']; ?><br></h7>
                                <input type="hidden" name="status" value="待借書">
                            </div>
                            <div class="brok_box_item2">
                                <?php
                                while ($rate = mysqli_fetch_assoc($rate_rs)) {
                                ?>

                                    &nbsp;
                                    <div style="flex: 1;"><img class="book_image" src="images/<?php echo $rate['brok_img']; ?>" /></div>
                                    <div style="flex:5;margin-left: 40px; display:flex; flex-direction:column" class="link-top">
                                        <div style="flex:1">
                                            <h4><?php echo $rate['account']; ?></h4>
                                        </div>
                                        <div style="flex:1">
                                            <h8><?php echo $rate['rate_content']; ?></h8>
                                        </div>
                                        <div style="flex:1">
                                            <h8>#<?php echo $rate['rate_id']; ?>&nbsp&nbsp&nbsp&nbsp<?php echo $rate['rate_time']; ?></h8>
                                        </div>
                                    </div>




                                <?php } ?>
                            </div>

                        </div>
                        <div class="haved_bar_items " style="margin:30px ;">
                            <?php if ($points < 5) { ?>
                                <input type="submit" value="您的點數<5" disabled>
                            <?php } else { ?>
                                <input type="submit" value="確定借閱"> <?php } ?>
                        </div>
                    </form>
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
<style>
    .brok_box {
        margin: 5%;
        height: 100%;
        display: flex;
    }

    .brok_img {
        height: 200px;
        width: 150px;
    }

    .brok_box_item {
        flex: 1;
    }

    .brok_box_item2 {
        flex: 2;
        height: 100%;
        width: 100%;
        display: flex;
        flex-direction: row;
        margin-left: 40px;
    }

    /*中間的過度的橫線*/
    .link-top {
        width: 50%;
        border-bottom: solid #ACC0D8 1px;
    }

    /*畫一條再右邊的豎線*/
    .link-right {
        width: 100px;
        height: 20%;
        border-right: solid #ACC0D8 1px;
    }
</style>