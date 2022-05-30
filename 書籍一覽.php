
<!DOCTYPE HTML>

<html>
<?php
$book_name = $_GET['book_name'];

$link = mysqli_connect("localhost", "root");
mysqli_query($link, "SET NAMES 'UTF8'");
mysqli_select_db($link, "sa");

$sql = "select * from book_info where book_name = '$book_name'";
$rs = mysqli_query($link, $sql);
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
                    <h1>歡迎查看空閒書籍
                    </h1>
                    <h3 align="right"><br><br>立即借書！</h3>

                </header>
                <!-- Banner -->
                <section id="banner">
                    <div class="content">
                        <?php $book_info = mysqli_fetch_row($rs)
                            ?>
                            
                                <h1>書名 : <?php echo $book_info[3]; ?><br></h1>
                                
                                <h4>作者 : <?php echo $book_info[4]; ?></h4>
                                <h4>出版社 : <?php echo $book_info[5]; ?></h4>
                                <h4>出版日期 : <?php echo $book_info[6]; ?></h4>
                                <h4>類別 : <?php echo $book_info[7]; ?></h4>

                            

                            <p>介紹文 : <?php echo $book_info[9]; ?></p>
                            

                    </div>
                        <img style="margin:0 0 30% 0" src="images/<?php echo $book_info[8]; ?>" alt="">
                    
                </section>
                
            </div>

            <!--搜尋書籍關鍵字結果-->




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