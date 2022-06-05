<?php
$colname_rs = $_POST["query"];
$link = mysqli_connect("localhost", "root");
mysqli_query($link, "SET NAMES 'UTF8'");

mysqli_select_db($link, "sa");

$query_rs = "SELECT * FROM book_info WHERE book_name LIKE '%$colname_rs%' or book_author LIKE '%$colname_rs%' or public LIKE '%$colname_rs%' group by book_name";


$query_rs .= " ORDER BY book_name DESC";
$rs = mysqli_query($link, $query_rs);

?>


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
                            <input type="text" name="query" placeholder="輸入關鍵字" />
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
                    <?php $get="false";?>
                    <p align="center"><B>關鍵詞搜索結果如下：</B></p>
                    <?php while ($row_rs = mysqli_fetch_assoc($rs)){
                        $get="true";?>
                        
                        <div class="box box_action">
                            <div class="book_jpg_style123">
                                <a href="書籍內容.php?book_name=<?php echo $row_rs['book_name'] ?>">
                                    <img class="book_image" src="images/<?php echo $row_rs['book_image']; ?>" /></a>
                            </div>
                            <p>書名 : <?php echo $row_rs["book_name"]; ?><br></p>
                            <p>作者 : <?php echo $row_rs["book_author"]; ?><br></p>
                            <p>類別 : <?php echo $row_rs["book_category"]; ?><br></p>

                        </div>

                    <?php }
                    if($get<>"true"){
                        echo "無搜尋到您想要的書籍，換個關鍵字試試?";}  ?>
                </section>

            </div>

        </div>

        <?php include "index_bar.html" ?>

    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>


</body>

</html>
