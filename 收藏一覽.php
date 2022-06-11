<!DOCTYPE HTML>

<html>
<?php
$account = $_SESSION['account'];
$name = $_SESSION['name'];
$link = mysqli_connect("localhost", "root");
mysqli_query($link, "SET NAMES 'UTF8'");
mysqli_select_db($link, "sa");
if (!(isset($_SESSION['account']))) {
    header("location:index.php?log=no");
}
if (isset($_GET['f'])) {
    $fav_delete_sql = "DELETE FROM favorite WHERE ISBN = '$_GET[ISBN]' and account = '$account';";
    if (mysqli_query($link, $fav_delete_sql)) {
        //總按讚次數
        $likes_sql = "UPDATE book_info SET likes = $_GET[like]-1 WHERE ISBN='$_GET[ISBN]'";
        mysqli_query($link, $likes_sql);
        header("location:收藏一覽.php");
    }
}
?>

<head>
    <title>收藏書籍</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/book-list.css" />
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
                    echo "<ul class='icons'>
                                <li><p>$name ，歡迎光臨 <a href='logout.php' class='button primary small'>登出</span></a></p></li>
                                </ul>";

                    $sql = "select * from favorite  where account = '$account'";
                    $rs = mysqli_query($link, $sql);

                    ?>
                </header>
                <!-- Banner -->
                <section>
                <header class="major">
                        <h2>已收藏書籍</h2>
                    </header>
                <!--書籍-->
                <div class="posts">
                <?php while ($fav = mysqli_fetch_assoc($rs)) { ?>
                        <?php
                        $book_sql = "select * from book_info where ISBN = '$fav[ISBN]'";
                        $book_rs = mysqli_query($link, $book_sql);
                        if ($book_info = mysqli_fetch_assoc($book_rs)) {

                        ?>
                        <article>
                            <div class="img_box">
                                <img class="img_item" src="images/<?php echo $book_info['book_image']; ?>" alt="">
                            </div>
                                <h2>書名 : <?php echo $book_info['book_name']; ?></h2>
                                <h5>作者 : <?php echo $book_info['book_author']; ?></h5>
                                <h5>出版社 : <?php echo $book_info['public']; ?></h5>
                                <h5>介紹文 : </h5>
                                <p><?php echo $book_info['book_introduction']; ?></p>
                                <ul class="actions">
									<li><a style='background-color:#f56a6a' href='收藏一覽.php?f=N&like=<?php echo $book_info['likes']; ?>&ISBN=<?php echo $book_info['ISBN']; ?>' class=button big>
                                    <font style='color:white'>🤍收藏</font>"</a></li>
                                    <li><a href="書籍內容.php?ISBN=<?php echo $fav['ISBN'] ?>" class="button big">書籍資訊</a></li>
                                    
                            </ul>
                        </article>
                        <?php } ?>
                    <?php
                            } ?>
                </div>
                </section>
            </div>
            <?php include "footer.php" ?>
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
