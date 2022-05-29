<?php
$colname_rs = $_POST["query"];
$result = explode(" ", $_POST["query"]);
$link = mysqli_connect("localhost", "root");
mysqli_query($link, "SET NAMES 'UTF8'");

mysqli_select_db($link, "sa");
$query_rs = "SELECT * FROM book_info WHERE book_name LIKE '%$result[0]%' or book_author LIKE '%$result[0]%' or public LIKE '%$result[0]%' group by book_name";


$query_rs .= " ORDER BY book_name DESC";
$rs = mysqli_query($link, $query_rs);
$row_rs = mysqli_fetch_assoc($rs);
$totalRows_rs = mysqli_num_rows($rs);
?>

<style>
    .book_jpg_style123 {
        float: left;
        margin-right: 50px;
        clear: both;
    }
    .box_action:hover {
        cursor: pointer;
        background-color: #F0F0F0;
        opacity: 1.5;
    }

    .box_action:focus {
        cursor: pointer;
        opacity: 1.5;
    }
</style>

<html>

<head>
    <title>書籍共享平台-搜尋結果</title>
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

                    <section id="search" class="alt">
                        <form method="post" action="search.php">
                            <input type="text" name="query" id="query" placeholder="輸入關鍵字" />
                        </form>
                        <a href="index.php" class="logo"><strong>首頁</strong></a>
                    </section>

                </header>

                <!-- Content -->
                <section>

                    <!-- Content -->
                    <h2 id="content">搜尋結果</h2>
                    <hr class="major" />

                    <!--搜尋書籍關鍵字結果-->
                    <p align="center"><B>關鍵詞搜索結果如下：</B></p>

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