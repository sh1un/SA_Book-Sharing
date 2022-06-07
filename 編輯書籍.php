<?php
session_start();
if (isset($_SESSION['name'])) {
    $name = $_SESSION['name'];
    $account = $_SESSION['account'];
    $book_id = $_GET['book_id'];
    $link = mysqli_connect("localhost", "root");

    mysqli_query($link, "SET NAMES 'UTF8'");
    mysqli_select_db($link, "sa");
    $sql = "select * from book_info where book_owner = '$account' and book_id = '$book_id'";
    $rs = mysqli_query($link, $sql);
} else {
    header("location:index.php?log=no");
}

?>
<!DOCTYPE HTML>

<html>

<head>
    <title>書籍共享-編輯書籍</title>
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



                <!-- 書單 -->
                <!-- 點圖片到書籍資訊頁面 -->
                <section>
                    <header class="major">
                        <h2>編輯書籍</h2>
                    </header>
                    <form action="編輯書籍_check.php" method="POST">
                    <div class="posts">
                        <?php
                            $rs =  mysqli_fetch_assoc($rs);
                        ?>
                            <article>
                                <div class="img_box">
                                更換圖片：<input type="file" name="udbook-image" id="book-image" accept=".jpg, .png, .img, .jpeg" value=""/>
                                <input type="hidden" value=<?php echo $rs['book_image']; ?> name="book-image">
                                    <img class="img_item" src='images/<?php echo $rs['book_image']; ?>' alt="" /></div>
                                書名：<h3><input type="text" name="udbook-name" id="book-name" value="<?php echo $rs['book_name'] ?>"/></h3>
                                編號 : <input type="hidden" value=<?php echo $rs['book_id'] ?> name="book_id">
                                <?php echo $rs['book_id'] ?>
                                <p><?php if ($rs['book_user'] == "none") {
                                    ?><input type="hidden" value="none" name="book_user">
                                    租借情況：none <br> 租借人：none<?php
                                    } else { ?><input type="hidden" value="<?php echo $rs['name']?>" name="book_user">
                                    租借情況：租借中 <br> 租借人 : <?php
                                            echo $rs['name'];}?>
                                <br>捐借人：<input type="hidden" value=<?php echo $name ?> name="book_owner">
                                <?php echo $name ?>
                                <br>上架時間：<input type="hidden" value=<?php echo $rs['up_date'] ?> name="up_date">
                                <?php echo $rs['up_date'] ?>
                                <br>作者：<input type="text" name="udbook-author" id="book-author"  value="<?php echo $rs['book_author'] ?>" required>
                                <br>出版社：<input type="text" name="udpublic" id="public" value="<?php echo $rs['public'] ?>"/>
                                <br>出版日期：<input type="date" name="udpublic-date" id="public-date" value="<?php echo $rs['public_date'] ?>"/>
                                <br>類別：<select name="udbook-category" id="book-category" required>
                                    <option selected="selected" disabled>請重新選擇類別</option>
                                    <option value="總類">000 總類</option>
                                    <option value="哲學類">100 哲學類</option>
                                    <option value="宗教類">200 宗教類</option>
                                    <option value="科學類">300 科學類</option>
                                    <option value="應用科學類">400 應用科學類</option>
                                    <option value="社會科學類">500 社會科學類</option>
                                    <option value="史地類：中國史地">600 史地類：中國史地</option>
                                    <option value="史地類：世界史地">700 史地類：世界史地</option>
                                    <option value="語言文學類">800 語言文學類</option>
                                    <option value="藝術類">900 藝術類</option>
                                </select>
                                

                                </p>

                                <div align="center">
                                <input type="submit" class="input_btn" value="確認修改"><br>
                                </div>
                            </article>


                    </div>
                    </form>
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