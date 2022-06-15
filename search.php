<?php
$link = mysqli_connect("localhost", "root");
mysqli_query($link, "SET NAMES 'UTF8'");
mysqli_select_db($link, "sa");

$text = '排序方式';
if (!(isset($_GET['way']))) {
    $colname_rs = $_POST["query"];
    $query_rs = "SELECT * FROM book_info WHERE book_name LIKE '%$colname_rs%' or book_author LIKE '%$colname_rs%' or public LIKE '%$colname_rs%' group by ISBN";
}


if (isset($_GET['way'])) {

    $colname_rs = $_GET["query"];
    //echo $colname_rs;
    $text = $_GET['way'];
    $query_rs = "SELECT * FROM book_info WHERE book_name LIKE '%$colname_rs%' or book_author LIKE '%$colname_rs%' or public LIKE '%$colname_rs%' group by ISBN";

    switch ($_GET['way']) {
        case "最新":
            $query_rs .= " ORDER BY up_date DESC";
            break;
        case "最舊":
            $query_rs .= " ORDER BY up_date ASC";
            break;
        case "最多愛心":
            $query_rs .= " ORDER BY likes DESC";
            break;
        case "名稱":
            $query_rs .= " ORDER BY book_name DESC";
            break;
    }

    
}
$rs = mysqli_query($link, $query_rs);
?>


<html>

<head>
    <title>搜尋結果</title>
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

                <!-- Content -->
                <section>

                    <!-- Content -->
                    <h2 id="content">搜尋結果</h2>
                    <select name="way" onchange="location=this.value;" required>
                        <option selected="selected" disabled><?php echo $text;?>
                        <option value="search.php?query=<?php echo $colname_rs ?>&way=最新">最新
                        <option value="search.php?query=<?php echo $colname_rs ?>&way=最舊">最舊
                        <option value="search.php?query=<?php echo $colname_rs ?>&way=最多愛心">最多愛心
                        <option value="search.php?query=<?php echo $colname_rs ?>&way=名稱">名稱
                    </select>

                    <input type="hidden" name="query" value=<?php echo $colname_rs; ?>>

                    <hr class="major" />

                    <!--搜尋書籍關鍵字結果-->
                    <?php $get = "false"; ?>
                    <p align="center"><B>關鍵詞搜索結果如下：</B></p>




                    <?php while ($row_rs = mysqli_fetch_assoc($rs)) {
                        $get = "true"; ?>

                        <div class="box box_action">
                            <div class="book_jpg_style123">
                                <a href="書籍內容.php?book_name=<?php echo $row_rs['book_name'] ?>&ISBN=<?php echo $row_rs['ISBN'] ?>">
                                    <img class="book_image" src="images/<?php echo $row_rs['book_image']; ?>" /></a>
                            </div>
                            <p>書名 : <?php echo $row_rs["book_name"]; ?><br>
                            作者 : <?php echo $row_rs["book_author"]; ?><br>
                            收藏數 : <?php echo $row_rs["likes"]; ?>🤍<br>
                            類別 : <?php echo $row_rs["book_category"]; ?><br>
                            上架時間 : <?php echo $row_rs["up_date"]; ?><br></p>

                        </div>
                        
                    <?php }
                    if ($get <> "true") {
                        echo "無搜尋到您想要的書籍，換個關鍵字試試?";
                    }  ?>
                </section>

            </div>
<?php include "footer.php" ?>
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
