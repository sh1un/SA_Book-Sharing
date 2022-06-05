<!DOCTYPE HTML>

<html>
<?php
session_start();
$book_name = $_POST['book_name'];

$link = mysqli_connect("localhost", "root");
mysqli_query($link, "SET NAMES 'UTF8'");
mysqli_select_db($link, "sa");
//抓評論資料
$sql = "select * from evaluation where book_id = '$_GET[book_id]'";
$rs = mysqli_query($link, $sql);
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
                    <div class="have_box">
                        <?php while ($rate = mysqli_fetch_assoc($rs)) {

                        ?>

                            <div class="box_action haved_bar">
                                <div class="haved_bar_items" style="margin:30px ;">
                                    <p><?php echo $rate["rate_id"]; ?></p>
                                </div>
                                <div class="haved_bar_items">

                                    <img class="book_image" src="images/<?php echo $rate['brok_img']; ?>" />

                                </div>
                                <div class="haved_bar_items" style="margin:30px ;">

                                    <p><?php echo $rate['account']; ?><br></p>

                                    <input type="hidden" name="status" value="待借書">
                                </div>
                                <div class="haved_bar_item2" style="margin:30px ;background-color:white; border:#E0E0E0 1px solid">

                                    <p><?php echo $rate["rate_content"]; ?><br><?php echo $rate["rate_time"]; ?><br></p>
                                </div>

                            </div>
                        <?php } ?>
                        <div class="haved_bar_items " style="margin:30px ;">

                            <input type="submit" value="確定借閱">
                        </div>
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