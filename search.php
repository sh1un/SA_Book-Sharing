<?php 
    $colname_rs = $_POST["query"];
    $result = explode(" ",$_POST["query"]);
    $link = mysqli_connect("localhost", "root");
mysqli_query($link, "SET NAMES 'UTF8'");

    mysqli_select_db($link, "sa");
    $query_rs = "";
    for($i=0;$i<count($result);$i++){
        if($i==0) 
            $query_rs = "SELECT * FROM book_info WHERE book_name LIKE '$result[0]' ";
        else 
            $query_rs .= " UNION SELECT * FROM book_info WHERE book_name LIKE '$result[$i]' ";
    }

    $query_rs .= " ORDER BY book_name DESC"; 
    $rs = mysqli_query($link, $query_rs);
    $row_rs = mysqli_fetch_assoc($rs);
    $totalRows_rs = mysqli_num_rows($rs);
?>

<style>
    .book_jpg_style123{
        float:left;
        margin-right:40px;
        clear: both;
        height: 400px;
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
                    <a href="index.php" class="logo"><strong>書籍共享平台</strong></a>
                    <ul class="icons">
                        <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
                        <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
                        <li><a href="#" class="icon brands fa-snapchat-ghost"><span class="label">Snapchat</span></a></li>
                        <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
                        <li><a href="#" class="icon brands fa-medium-m"><span class="label">Medium</span></a></li>
                    </ul>
                </header>

                <!-- Content -->
                <section>

                    <!-- Content -->
                    <h2 id="content">搜尋結果</h2>
                    <hr class="major" />
                    
                    <!--搜尋書籍關鍵字結果-->
                    <p align="center"><B>關鍵詞搜索結果如下：</B></p>
                    
                    <?php if($totalRows_rs>0) do { ?>
                        <div class="book_jpg_style123">
                            <a href="書籍內容.php?book=<?php echo $row_rs['book_name'] ?>"><img src="images/<?php echo $row_rs['book_image'];?>" /></a>
                        </div>
                    <p>書名 : <?php echo $row_rs["book_name"]; ?><br></p>
                    <p>作者 : <?php echo $row_rs["book_author"]; ?><br></p>
                    <p>出版社 : <?php echo $row_rs["public"]; ?><br></p>
                    <p>出版日期 : <?php echo $row_rs["public_date"]; ?><br></p>
                    <p>類別 : <?php echo $row_rs["book_category"]; ?><br></p>
                    <p>簡介 : <?php echo $row_rs["book_introduction"]; ?><br></p>
                    <br><br><br><br>
                    <?php } while ($row_rs = mysqli_fetch_assoc($rs)); ?>
                    

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
