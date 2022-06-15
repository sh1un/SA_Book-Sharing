<?php
$name = $_SESSION['name'];
$account = $_SESSION['account'];
$book_id = $_GET['book_id'];
$order_id = $_GET['order_id'];
$order_day = $_GET['order_day'];
$link = mysqli_connect("localhost", "root");
mysqli_query($link, "SET NAMES 'UTF8'");

mysqli_select_db($link, "sa");
$sql = "select * from book_info where book_user = '$account' and book_id = '$book_id'";
$rs = mysqli_query($link, $sql);

?>



<!DOCTYPE HTML>
<html>

<head>
    <title>評論書籍</title>
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
                    <h2>馬上評論書籍！</h2>
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
                <section id="banner">
                    <div class="content">
                        <form action="borr.php?br=r" method="POST">
                            <input type='hidden' name='order_id' value="<?php echo $order_id; ?>">
                            <?php if ($book_info = mysqli_fetch_row($rs)) { 
                                $theDate = new DateTime($order_day);
                                $stringDate = $theDate->format('Y/m/d');
                                $latest_return_day = date("Y/m/d",strtotime("$book_info[13] day",strtotime($stringDate)));
                               ?>
                                <header>
                                    
                            
                            <div>
                                <img class="book_jpg_style123" style="width: 300px; height: 400px;" src="images/<?php echo $book_info[8]; ?>" alt="">
                            </div>
                            <br><br>
                            <div>
                                <h1>書名 : <?php echo $book_info[3]; ?><br></h1><input hidden name="book_name" value="<?php echo $book_info[3]; ?>" />
                                <h4>編號 : <?php echo $book_id; ?></h4><input hidden name="book_id" value="<?php echo $book_id; ?>" />
                                <h4>作者 : <?php echo $book_info[4]; ?></h4><input hidden name="book_author" value="<?php echo $book_info[4]; ?>" />
                                <h4>擁有者 : <?php echo $book_info[1]; ?></h4><input hidden name="book_owner" value="<?php echo $book_info[1]; ?>" />
                                <h4>借閱者 : <?php echo $book_info[2]; ?></h4><input hidden name="book_user" value="<?php echo $book_info[2]; ?>" />
                            </div>
                                    
                                    
                                </header>
                                <!--還書日期-->
                                <div class="col-4 col-12-xsmall">
                                    <h4>還書日期 : <?php echo date("Y/m/d"); ?></h4>
                                </div>
                                <div class="col-4 col-12-xsmall">
                                    <h4>最晚還書日期：<?php echo $latest_return_day; ?></h4>
                                </div>
                                <br>
                                <br>
                                <!--書籍分數-->
                                <div class="col-8 ppppp">
                                    <p><h2><b>對書籍持有者ID<<?php echo $book_info[1]; ?>>的評價?</b></h2></p>
                                    <input class="likepp" type="radio" name="rate" id="item01" value=1/>
                                    <label for="item01">極差</label>
                                    <input class="likepp" type="radio" name="rate" id="item02" value=2/>
                                    <label for="item02">不優</label>
                                    <input class="likepp" type="radio" name="rate" id="item03" value=3/>
                                    <label for="item03">普通</label>
                                    <input class="likepp" type="radio" name="rate" id="item04" value=4/>
                                    <label for="item04">優質</label>
                                    <input class="likepp" type="radio" name="rate" id="item05" value=5/>
                                    <label for="item05">極優</label>
                                </div><br>
                                    


                                <!--書籍評論-->
                                <p><h2><b>對於這本書的體驗如何</b></h2></p>
                                <div class="col-8">
                                    <textarea name="rate_content" id="rate_content" placeholder="對於這本書的體驗如何?" rows="6"></textarea>
                                </div>
                                <br>
                                <div class="col-12">
                                    <ul class="actions">
                                        <li><input type="submit" value="確定評價" class="primary" /></li>
                                        <li><input type="reset" value="重新填寫" /></li>
                                    </ul>
                                </div>
                        </form>
                    </div>
                <?php } ?>
                </section>
            </div>
            <?php include "footer.php" ?>
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
