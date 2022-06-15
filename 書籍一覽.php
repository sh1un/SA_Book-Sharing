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
                    <a href="index.php" class="logo"><strong>首頁</strong></a>
                    <?php
                    if (isset($_SESSION['name'])) {
                        $name = $_SESSION['name'];
                        $account = $_SESSION['account'];
                        $con = $_SESSION['con'];
                        echo "<ul class='icons'>
                                <li><p>$name ，歡迎光臨 <a href='logout.php' class='button primary small'>登出</span></a></p></li>
                                </ul>";
                    } else {
                        echo "<ul class='icons'>
                                <li><a href='login.php' class='button primary small'>登入</span></a></li>
                                </ul>";
                    }
                    ?>
                </header>
                <!-- Banner -->
                <section id="banner">
                    <!--書籍-->
                    <div>
                        <img class="book_jpg_style123" style="width: 200px; height:240px;" src="images/<?php echo $book_info[8]; ?>" alt="">
                    </div>
                    <div class="content">
                        <h2>書名 :<?php echo $book_info[3]; ?></h2><br>
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
                            $book_id = $book_all['book_id'];
                            $fetch_orderlist_book_id_sql = "SELECT * FROM orderlist WHERE `orderlist`.`book_id` = '$book_id'";
                            $orderlist_book_id_rs = mysqli_query($link, $fetch_orderlist_book_id_sql);
                            $orderlist_book_id_array = mysqli_fetch_array($orderlist_book_id_rs);
                            
                        ?>
                            <form action="broken.php?book_id=<?php echo $book_all['book_id'] ?>" method="POST">
                                <div class="box_action haved_bar">
                                    <div class="book_jpg_style123 haved_bar_items">
                                        <a href="書籍一覽.php?book_name=<?php echo $book_all['book_name'] ?>" style="margin:30px;">
                                            <img class="book_image" src="images/<?php echo $book_all['book_image']; ?>" /></a>

                                    </div>
                                    <div class="haved_bar_items">
                                        <h4>ID : <?php echo $book_all["book_id"]; ?><br></h4>
                                    </div>
                                    <div class="haved_bar_items">
                                        <div>
                                            <p>書名 : <?php echo $book_all["book_name"]; ?><br></p><input type="hidden" name="book_name" value="<?php echo $book_all['book_name']; ?>">
                                            <p>擁有者 : <?php echo $book_all['book_owner']; ?><br></p><input type="hidden" name="book_own" value="<?php echo $book_all['book_owner']; ?>">
                                            <p>可借閱天數 : <?php echo $book_all["borrow_day"]; ?><br></p><input type="hidden" name="borrow_day" value="<?php echo $book_all['borrow_day']; ?>">
                                        </div>
                                    </div>
                                    <div class="haved_bar_items ">
                                        <?php $rates_sql = "select rate from evaluation where owner_account = '$book_all[book_owner]'";
                                        $total_rate = 0;
                                        $i = 1;
                                        $rate_rs=mysqli_query($link, $rates_sql);
                                       while ($rate = mysqli_fetch_row($rate_rs)) {
                                            $total_rate += $rate[0];
                                            $i++;
                                        }
                                        $total_rate /= $i;
                                        $aver_rate = round($total_rate,2);
                                        echo "<h5>". $aver_rate ."⭐</h5>";
                                        ?>
                                        <input type="hidden" name="aver_rate" value="<?php echo $aver_rate ?>"/>
                                    </div>
                                    <div class="haved_bar_items ">
                                        <h5><?php 
                                            if(!empty($orderlist_book_id_array['book_id'])){
                                            if (($book_all['book_id'] == $orderlist_book_id_array['book_id']) && ($book_all['book_user'] == 'none')) {
                                                
                                                    echo "<font color = orange>●已預約</font>";
                                                }
                                                
                                            }
                                            elseif($book_all['book_user']=='none'){
                                             echo "<font color = green>●可借閱</font>";   
                                            } 
                                            else {
                                                echo "<font color = red>●已借閱</font>";
                                            } ?></h5>
                                    </div>

                                    <div class="haved_bar_items ">
                                        <!--這邊連到訂單查詢-->
                                        <?php 
                                        if(!empty($orderlist_book_id_array['book_id'])){
                                        if (($book_all['book_id'] == $orderlist_book_id_array['book_id']) && ($book_all['book_user'] == 'none')) {
                                        ?>
                                                <input type="button" value="預約" disabled>
                                                
                                            <?php

                                            }
                                            ?>
                                        

                                        
                                        <?php 

                                        }
                                        
                                        elseif($book_all['book_user']=='none'){
                                        ?>
                                        <input type="submit" value="預約">
                                        <?php
                                        }
                                        else{ 
                                            echo "";
                                        } ?>
                                    </div>

                                </div>
                            </form>
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