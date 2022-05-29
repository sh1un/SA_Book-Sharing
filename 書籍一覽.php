<?php
$book_name = $_GET['book_name'];
?>
<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

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
                <section>

                    <!-- Content -->
                    <h2 id="content">書籍內容</h2>
                    <hr class="major" />

                    <!--搜尋書籍關鍵字結果-->
                    <p align="center"><B>相同書籍內容如下</B></p>

                    <?php while ($row_rs = mysqli_fetch_assoc($rs)) { ?>

                        <div class="box box_action">
                            <div class="book_jpg_style123">
                                <a href="書籍一覽.php?book_name=<?php echo $row_rs['book_name'] ?>">
                                    <img class="book_image" src="images/<?php echo $row_rs['book_image']; ?>" /></a>
                            </div>
                            <p>書名 : <?php echo $row_rs["book_name"]; ?><br></p>
                            <p>作者 : <?php echo $row_rs["book_author"]; ?><br></p>
                            <p>類別 : <?php echo $row_rs["book_category"]; ?><br></p>

                        </div>

                    <?php } ?>
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