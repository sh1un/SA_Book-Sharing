<?php

$link = mysqli_connect("localhost", "root");
mysqli_query($link, "SET NAMES 'UTF8'");
mysqli_select_db($link, "sa");
$sql = "select * from book_info";
$rs = mysqli_query($link, $sql);
if (isset($_GET['log'])) {
    if ($_GET['log'] == 'no') {
        echo "<script>alert('請先登入帳號密碼')</script>";
    } else if ($_GET['log'] == 'r_success') {
        echo "<script>alert('還書成功')</script>";
    } else if ($_GET['log'] == 'r_fail') {
        echo "<script>alert('還書失敗')</script>";
    } else if ($_GET['log'] == 'b_success') {
        echo "<script>alert('借書成功')</script>";
    }
}
?>
<!DOCTYPE HTML>

<html>

<head>
    <title>書籍共享平台</title>
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
                        <?php
                        session_start();
                        if (isset($_SESSION['name'])) {
                            $name = $_SESSION['name'];
                            $account = $_SESSION['account'];
                            echo "<ul class='icons'>
                                <li><p>$name ，歡迎光臨 <a href='logout.php' class='button primary small'>登出</span></a></p></li>
                                </ul>";
                        } else {
                            echo "<ul class='icons'>
                                <li><a href='login.php' class='button primary small'>登入</span></a></li>
                                </ul>";
                        }
                        ?>

                        <form method="post" action="search.php">
                            <input type="text" name="query" id="query" placeholder="輸入關鍵字" />
                        </form>
                    </section>

                </header>

                <!-- Banner -->

                <section id="banner">
                    <div class="content">
                        <header>
                            <h1>書籍共享平台</h1>
                        </header>
                        <h4>想要看書又不想花錢嗎？只要捐出家裡閒置的藏書，你也可以免費看書！</h4>
                        <p>為了解決書籍價值因書籍被閒置在書櫃中而浪費，我們希望這個網頁能夠有效最大化這些書的價值。
                            隨著「共享經濟」逐漸普及，許多平台的出現，都是為了讓家中閒置的物品，
                            不要浪費它的價值，讓有需要的人可以透過小小的錢甚至是免費，也能擁有「使用權」。</p>
                        <p>本系統設有點數制，每日登入系統即可獲得點數，分享書籍者可以獲得更多的點數。
                            若想要借閱書籍，必須消耗點數才能借閱。借書和還書的部分，
                            我們會將會員提供的聯絡方式、居住地區顯示在網站上，因此借閱者可以和分享者聯絡，
                            並約好在何時何地見面，也可以在面交時確認書籍完整程度，以免發生爭議。</p>

                    </div>
                    <img src="images/book.jpg" width="700" height="400" alt="" />
                </section>

                <!-- Section  -->
                <section>
                    <header class="major">
                        <h2>本月推薦</h2>
                    </header>
                    <div class="features">

                        <?php
                        $i = 0;
                        while ($rslt =  mysqli_fetch_assoc($rs) and $i < 4) {
                        ?>
                            <article>
                                <span><img  class="book_image" src="images/<?php echo $rslt['book_image']; ?>" alt="" /></span>
                                <div class="content">
                                    <h3><?php echo $rslt['book_name']; ?></h3>
                                    <p><?php echo $rslt['book_introduction']; ?></p>
                                    <ul class="actions">
                                        <?php if (isset($account)) {
                                            if ($rslt['book_owner'] == $account) { ?>
                                                <li><a href="書籍內容.php?book_id=<?php echo $rslt['book_id'] ?>" class="button">下架書籍</a>
                                                </li><?php } else { ?>
                                                <li><a href="書籍內容.php?book_id=<?php echo $rslt['book_id'] ?>" class="button">立即借閱</a>
                                                </li><?php }
                                                } else { ?>
                                            <li><a href="書籍內容.php?book_id=<?php echo $rslt['book_id'] ?>" class="button">立即借閱</a>
                                            </li><?php } ?>

                                    </ul>
                                </div>

                            </article>
                        <?php $i += 1;
                        } ?>

                    </div>
                </section>

                <!-- Section -->

                <!-- 投資理財Section  -->
                <section>
                    <header class="major">
                        <h2>投資理財</h2>
                    </header>
                    <div class="features">
                        <article>
                            <span><img class="book_image" src="images/灰階思考.jpg" alt="" /></span>
                            <div class="content">
                                <h3>灰階思考</h3>
                                <p>黑白之間都是灰，找到無限價值的所在。Podcast冠軍節目股癌製作人謝孟恭首本力作！</p>
                                <ul class="actions">
                                    <li><a href="#" class="button">立即借閱</a></li>
                                </ul>
                            </div>
                        </article>
                        <article>
                            <span><img class="book_image" src="images/股票作手回憶錄.jpg" alt="" /></span>
                            <div class="content">
                                <h3>灰階思考</h3>
                                <p>黑白之間都是灰，找到無限價值的所在。Podcast冠軍節目股癌製作人謝孟恭首本力作！</p>
                                <ul class="actions">
                                    <li><a href="#" class="button">立即借閱</a></li>
                                </ul>
                            </div>
                        </article>
                        <article>
                            <span><img class="book_image" src="images/致富心態.jpg" alt="" /></span>
                            <div class="content">
                                <h3>致富心態</h3>
                                <p>《華爾街日報》、亞馬遜書店暢銷書現代社會最重要、卻被嚴重被低估的技能</p>
                                <ul class="actions">
                                    <li><a href="#" class="button">立即借閱</a></li>
                                </ul>
                            </div>
                        </article>
                        <article>
                            <span><img class="book_image" src="images/漫步華爾街.jpg" alt="" /></span>
                            <div class="content">
                                <h3>灰階思考</h3>
                                <p>黑白之間都是灰，找到無限價值的所在。Podcast冠軍節目股癌製作人謝孟恭首本力作！</p>
                                <ul class="actions">
                                    <li><a href="#" class="button">立即借閱</a></li>
                                </ul>
                            </div>
                        </article>
                    </div>
                </section>

                <!-- Section -->

                <!-- 瀏覽Section  -->
                <section>
                    <header class="major">
                        <h2>瀏覽書籍</h2>
                    </header>
                    <div class="featuresforbrowse">
                        <article>
                            <span><img class="book_image" src="images/灰階思考.jpg" alt="" /></span>
                            <div class="content">
                                <h3>灰階思考</h3>
                                <p>黑白之間都是灰，找到無限價值的所在。Podcast冠軍節目股癌製作人謝孟恭首本力作！</p>
                                <ul class="actions">
                                    <li><a href="#" class="button">立即借閱</a></li>
                                </ul>
                            </div>
                        </article>
                        <article>
                            <span><img class="book_image" src="images/股票作手回憶錄.jpg" alt="" /></span>
                            <div class="content">
                                <h3>灰階思考</h3>
                                <p>黑白之間都是灰，找到無限價值的所在。Podcast冠軍節目股癌製作人謝孟恭首本力作！</p>
                                <ul class="actions">
                                    <li><a href="#" class="button">立即借閱</a></li>
                                </ul>
                            </div>
                        </article>
                        <article>
                            <span><img class="book_image" src="images/致富心態.jpg" alt="" /></span>
                            <div class="content">
                                <h3>致富心態</h3>
                                <p>《華爾街日報》、亞馬遜書店暢銷書現代社會最重要、卻被嚴重被低估的技能</p>
                                <ul class="actions">
                                    <li><a href="#" class="button">立即借閱</a></li>
                                </ul>
                            </div>
                        </article>
                        <article>
                            <span><img class="book_image" src="images/漫步華爾街.jpg" alt="" /></span>
                            <div class="content">
                                <h3>灰階思考</h3>
                                <p>黑白之間都是灰，找到無限價值的所在。Podcast冠軍節目股癌製作人謝孟恭首本力作！</p>
                                <ul class="actions">
                                    <li><a href="#" class="button">立即借閱</a></li>
                                </ul>
                            </div>
                        </article>
                    </div>
                </section>

                <!-- Section -->
                <section>
                    <header class="major">
                        <h2>Ipsum sed dolor</h2>
                    </header>
                    <div class="content">
                        <article>
                            <span><img class="book_image" src="images/灰階思考.jpg" alt="" /></span>
                            <div class="content">
                                <h3>Interdum aenean</h3>
                                <p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
                                <ul class="actions">
                                    <li><a href="#" class="button">More</a></li>
                                </ul>
                            </div>
                        </article>
                        <article>
                            <a href="#" class="book_image"><img src="images/股票作手回憶錄.jpg" alt="" /></a>
                            <h3>Nulla amet dolore</h3>
                            <p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
                            <ul class="actions">
                                <li><a href="#" class="button">More</a></li>
                            </ul>
                        </article>
                        <article>
                            <a href="#" class="book_image"><img src="images/灰階思考.jpg" alt="" /></a>
                            <h3>Tempus ullamcorper</h3>
                            <p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
                            <ul class="actions">
                                <li><a href="#" class="button">More</a></li>
                            </ul>
                        </article>
                        <article>
                            <a href="#" class="book_image"><img src="images/灰階思考.jpg" alt="" /></a>
                            <h3>Sed etiam facilis</h3>
                            <p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
                            <ul class="actions">
                                <li><a href="#" class="button">More</a></li>
                            </ul>
                        </article>
                        <article>
                            <a href="#" class="book_image"><img src="images/灰階思考.jpg" alt="" /></a>
                            <h3>Feugiat lorem aenean</h3>
                            <p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
                            <ul class="actions">
                                <li><a href="#" class="button">More</a></li>
                            </ul>
                        </article>
                        <article>
                            <a href="#" class="book_image"><img src="images/灰階思考.jpg" alt="" /></a>
                            <h3>Amet varius aliquam</h3>
                            <p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
                            <ul class="actions">
                                <li><a href="#" class="button">More</a></li>
                            </ul>
                        </article>
                    </div>
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