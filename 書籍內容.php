<!DOCTYPE HTML>

<html>

<?php
$name = $_SESSION['name'];
$account = $_SESSION['account'];

$ISBN = $_GET['ISBN'];
@$book_name = $_GET['book_name'];

$link = mysqli_connect("localhost", "root");
mysqli_query($link, "SET NAMES 'UTF8'");

mysqli_select_db($link, "sa");

$sql = "select * from book_info where ISBN = '$ISBN'";
$rs = mysqli_query($link, $sql);
$book_info = mysqli_fetch_row($rs);

//favorite
$fav_sql = "SELECT * FROM favorite WHERE ISBN = '$ISBN' AND account = '$account'";
$fav_rs = mysqli_query($link, $fav_sql);
if ($fav_reslt = mysqli_fetch_assoc($fav_rs)) {
    $fav = "Y";
} else {
    $fav = "N";
}

if (isset($_GET['f'])) {
    if ($_GET['f'] == "Y") {
        $fav = "Y";
        $fav_insert_sql = "INSERT INTO `favorite`(`book_name`, `account`, `favorite`, `ISBN`) VALUES ('$book_name','$account','$fav','$ISBN')";
        if (mysqli_query($link, $fav_insert_sql)) {
            //總按讚次數
            $likes_sql = "UPDATE book_info SET likes = $book_info[11]+1 WHERE ISBN='$ISBN'";
            if (mysqli_query($link, $likes_sql)) {
                header("location:書籍內容.php?ISBN=$ISBN&book_name=$book_name");
            }
        }
    } else {
        $fav_delete_sql = "DELETE FROM favorite WHERE ISBN = '$ISBN' and account = '$account';";
        if (mysqli_query($link, $fav_delete_sql)) {
            //總按讚次數
            $likes_sql = "UPDATE book_info SET likes = $book_info[11]-1 WHERE ISBN='$ISBN'";
            mysqli_query($link, $likes_sql);
            header("location:書籍內容.php?ISBN=$ISBN&book_name=$book_name");
        }
    }
}

?>

<head>
    <title>書籍共享平台-書籍上架</title>
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

                <!-- Content -->

                <section id="banner">

                    <form action="書籍一覽.php" method="post">
                        <div class="content">

                            <header>
                                <h2>書名 : <?php echo $book_info[3]; ?><br></h2>
                                <input type="hidden" name="book_name" id="book_name" value="<?php echo $book_info[3]; ?>">

                                <h4>作者 : <?php echo $book_info[4]; ?></h4>
                                <h4>出版社 : <?php echo $book_info[5]; ?></h4>
                                <h4>出版日期 : <?php echo $book_info[6]; ?></h4>
                                <h4>類別 : <?php echo $book_info[7]; ?></h4>


                            </header>

                            <p>介紹文 : <?php echo $book_info[9]; ?></p>
                            <ul class="actions">
                                <li>
                                    <?php if ($fav == "Y") {
                                        echo "<a style='background-color:#f56a6a' href='書籍內容.php?f=N&ISBN=$ISBN&book_name=$book_name' class=button big><font style='color:white'>" . $book_info[11] . "🤍收藏</font>";
                                    } else {
                                        echo "<a href='書籍內容.php?f=Y&ISBN=$ISBN&book_name=$book_name' class=button big>" . $book_info[11] . "🤍收藏";
                                    } ?></a>
                                    &nbsp&nbsp&nbsp<button class="button big" type="submit">查看所有相同書籍</button>
                                </li>
                            </ul>

                        </div>
                    </form>
                    <img style="margin:0 0 30% 0" src="images/<?php echo $book_info[8]; ?>" alt="">


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

>>>>>>> main

</html>
