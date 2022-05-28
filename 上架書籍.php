<?php
session_start();
if (!(isset($_SESSION['name']))) {
    header("location:index.php?log=no");
}

?>
<!DOCTYPE HTML>

<html>

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
                    <h2 id="content">輕鬆分享書籍！</h2>
                    <p>簡單幾個步驟，就能將您的愛書分享出去！讓其他人看看您的推薦吧！</p>

                    <hr class="major" />
                    <!--書籍資訊填寫表單-->
                    <h2 id="elements">書籍資訊</h2>

                    <form method="post" action="上架書籍_check.php">
                        <div class="row gtr-uniform">
                            <!--書名-->
                            <div class="col-6 col-12-xsmall">
                                <input type="text" name="book-name" id="book-name" value="" placeholder="書名" />
                            </div>
                            <!--作者-->
                            <div class="col-6 col-12-xsmall">
                                <input type="name" name="book-author" id="book-author" value="" placeholder="作者" />
                            </div>
                            <!--出版社-->
                            <div class="col-8 col-12-xsmall">
                                <input type="text" name="public" id="public" value="" placeholder="出版社" />
                            </div>
                            <!--出版日期-->
                            <div class="col-4 col-12-xsmall">
                                出版日期&nbsp&nbsp&nbsp<input type="date" name="public-date" id="public-date" />
                            </div>
                            <!-- 書籍分類 -->
                            <div class="col-6">
                                <select name="book-category" id="book-category">
                                    <option value="">分類</option>
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
                            </div>

                            <!-- 書籍簡介 -->
                            <div class="col-6">
                                上傳書籍封面&nbsp&nbsp&nbsp<input type="file" name="book-image" id="book-image" accept=".jpg, .png, .img, .jpeg" value=" " required />
                            </div>
                            <div class="col-8">
                                <textarea name="book-introduction" id="book-introduction" placeholder="簡單介紹一下書吧！" rows="6"></textarea>
                            </div>
                            <input type="hidden" value="none" name="book_user">
                            <!-- 上架按鈕 -->
                            <div class="col-12">
                                <ul class="actions">
                                    <li><input type="submit" value="上架" class="primary" /></li>
                                    <li><input type="reset" value="重新填寫" /></li>
                                </ul>
                            </div>
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