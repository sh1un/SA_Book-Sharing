<!DOCTYPE HTML>

<html>

<?php
session_start();
if (!(isset($_SESSION['account']))) {
    header("location:index.php?log=no");
}
$name = $_SESSION['name'];
$account = $_SESSION['account'];
$_SESSION['book_id'] = $_GET['book_id'];
$book_id = $_SESSION['book_id'];
$link = mysqli_connect("localhost", "root");
mysqli_query($link, "SET NAMES 'UTF8'");

mysqli_select_db($link, "sa");

$sql = "select * from book_info where book_id = '$book_id'";
$rs = mysqli_query($link, $sql);

//favorite
$fav_sql = "select * from favorite where book_id = '$book_id' and account = '$account'";
$fav_rs = mysqli_query($link, $fav_sql);
if ($fav_reslt = mysqli_fetch_assoc($fav_rs)) {
    $fav = "Y";
} else {
    $fav = "N";
}

if (isset($_GET['f'])) {
    if ($_GET['f'] == "Y") {
        $fav = "Y";
        $fav_insert_sql = "INSERT INTO `favorite`(`book_id`,`account`,`favorite`) 
    VALUES ('$book_id','$account','$fav')";
        if (mysqli_query($link, $fav_insert_sql)) {
            header("location:書籍內容.php?book_id=$book_id");
        }
    } else {
        $fav_delete_sql="DELETE FROM favorite WHERE book_id = '$book_id' and account = '$account';";
        if (mysqli_query($link, $fav_delete_sql)) {
            header("location:書籍內容.php?book_id=$book_id");
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

                </header>

                <!-- Content -->

                <section id="banner">
                    <div class="content">
                        <?php if ($book_info = mysqli_fetch_row($rs)) {
                            $ownsql = "select * from account where account = '$book_info[1]'";
                            $ownrs = mysqli_query($link, $ownsql);
                            $book_own = mysqli_fetch_assoc($ownrs);

                            $usersql = "select * from account where account = '$book_info[2]'";
                            $userrs = mysqli_query($link, $usersql);
                            $book_user = mysqli_fetch_assoc($userrs); ?>
                            <header>
                                <h1>書名 : <?php echo $book_info[3]; ?><br></h1>
                                <h4>編號 : <?php echo $book_id; ?></h4>
                                <h4>擁有者 : <?php echo $book_own['name']; ?></h4>
                                <h4>借閱者 : <?php if ($book_info[2] == "none") {
                                                echo "none";
                                            } else {
                                                echo $book_user['name'];
                                            } ?></h4>
                                <h4>上架日期 : <?php echo $book_info[10]; ?></h4>
                                <h4>作者 : <?php echo $book_info[4]; ?></h4>
                                <h4>出版社 : <?php echo $book_info[5]; ?></h4>
                                <h4>出版日期 : <?php echo $book_info[6]; ?></h4>
                                <h4>類別 : <?php echo $book_info[7]; ?></h4>
                                <h4>聯絡方式 : <?php echo $book_info[11]; ?></h4>
                            </header>

                            <p>介紹文 : <?php echo $book_info[9]; ?></p>
                            <ul class="actions">
                                <li><?php if ($book_info[1] == $account) { ?><a href="下架書籍.php?book_id=$book_id" class="button big">下架</a>
                                    <?php } else if ($book_info[2] == $account) { ?><a href='return.php?book_id=<?php echo $book_info[0]; ?>' class="button big">還書</a><?php } else if ($book_info[2] == 'none') { ?>
                                        <?php if ($fav == "Y") {
                                            echo "<a style='background-color:#f56a6a' href='書籍內容.php?f=N&book_id=$book_id' class=button big><font style='color:white'>🤍收藏</font>";
                                            } else {
                                            echo "<a href='書籍內容.php?f=Y&book_id=$book_id' class=button big>🤍收藏";
                                            } ?></a>
                                        &nbsp&nbsp&nbsp<a href="borr.php?br=b" class="button big">借閱</a><?php } ?>
                                </li>
                            </ul>

                    </div>

                    <img style="margin:0 0 30% 0" src="images/<?php echo $book_info[8]; ?>" alt="">

                <?php } ?>
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