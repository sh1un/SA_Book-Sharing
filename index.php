<?php

$link = mysqli_connect("localhost", "root");
mysqli_query($link, "SET NAMES 'UTF8'");
mysqli_select_db($link, "sa");
$sql = "select * from book_info order by likes DESC";
$rs = mysqli_query($link, $sql);
if (isset($_GET['log'])) {
    if ($_GET['log'] == 'no') {
        echo "<script>alert('請先登入帳號密碼')</script>";
    } else if ($_GET['log'] == 'r_success') {
        //echo "<script>alert('還書成功')</script>";
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
                    <form action="member.php">
                    <section id="search" class="alt">
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
                        </form>
                        <form method="post" action="search.php">
                            <input type="text" name="query" id="query" placeholder="輸入關鍵字" />
                        </form>
                    </section>

                </header>

                <!-- Banner -->

                <section id="banner">
                    <div class="content" style="padding:15px">
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
                    <img src="images/book.jpg" width="560" height="320" alt=""  style="margin-top: 100px"/>
                </section>

                <!-- Section  -->
                <section>
                    <header class="major">
                        <h2>熱門推薦</h2>
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
                                                <li><a href="書籍內容.php?book_name=<?php echo $rslt['book_name'] ?>&ISBN=<?php echo $rslt['ISBN'] ?>" class="button">書籍資訊</a>
                                                </li><?php } else { ?>
                                                <li><a href="書籍內容.php?book_name=<?php echo $rslt['book_name'] ?>&ISBN=<?php echo $rslt['ISBN'] ?>" class="button">書籍資訊</a>
                                                </li><?php }
                                                } else { ?>
                                            <li><a href="書籍內容.php?book_name=<?php echo $rslt['book_name'] ?>&ISBN=<?php echo $rslt['ISBN'] ?>" class="button">書籍資訊</a>
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
                                    <li><a href="#" class="button">書籍資訊</a></li>
                                </ul>
                            </div>
                        </article>
                        <article>
                            <span><img class="book_image" src="images/股票作手回憶錄.jpg" alt="" /></span>
                            <div class="content">
                                <h3>股票作手回憶錄</h3>
                                <p>我之所以能夠賺進大錢，靠的是我能縮手不動，而絕不是靠我的想法。既能看得對，又能縮手不動的人，並不常見。──傳奇操盤手傑西‧李佛摩　</p>
                                <ul class="actions">
                                    <li><a href="#" class="button">書籍資訊</a></li>
                                </ul>
                            </div>
                        </article>
                        <article>
                            <span><img class="book_image" src="images/致富心態.jpg" alt="" /></span>
                            <div class="content">
                                <h3>致富心態</h3>
                                <p>《華爾街日報》、亞馬遜書店暢銷書現代社會最重要、卻被嚴重被低估的技能</p>
                                <ul class="actions">
                                    <li><a href="#" class="button">書籍資訊</a></li>
                                </ul>
                            </div>
                        </article>
                        <article>
                            <span><img class="book_image" src="images/漫步華爾街.jpg" alt="" /></span>
                            <div class="content">
                                <h3>漫步華爾街</h3>
                                <p>無論你是投資新手、散戶、理財顧問、證券營業員、市場研究專家……
　　                                所有年齡層的投資人都該必備的投資聖經！</p>
                                <ul class="actions">
                                    <li><a href="#" class="button">書籍資訊</a></li>
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
                                    <li><a href="#" class="button">書籍資訊</a></li>
                                </ul>
                            </div>
                        </article>
                        <article>
                            <span><img class="book_image" src="images/股票作手回憶錄.jpg" alt="" /></span>
                            <div class="content">
                                <h3>灰階思考</h3>
                                <p>黑白之間都是灰，找到無限價值的所在。Podcast冠軍節目股癌製作人謝孟恭首本力作！</p>
                                <ul class="actions">
                                    <li><a href="#" class="button">書籍資訊</a></li>
                                </ul>
                            </div>
                        </article>
                        <article>
                            <span><img class="book_image" src="images/致富心態.jpg" alt="" /></span>
                            <div class="content">
                                <h3>致富心態</h3>
                                <p>《華爾街日報》、亞馬遜書店暢銷書現代社會最重要、卻被嚴重被低估的技能</p>
                                <ul class="actions">
                                    <li><a href="#" class="button">書籍資訊</a></li>
                                </ul>
                            </div>
                        </article>
                        <article>
                            <span><img class="book_image" src="images/漫步華爾街.jpg" alt="" /></span>
                            <div class="content">
                                <h3>漫步華爾街</h3>
                                <p>無論你是投資新手、散戶、理財顧問、證券營業員、市場研究專家……
　　                                所有年齡層的投資人都該必備的投資聖經！</p>
                                <ul class="actions">
                                    <li><a href="#" class="button">書籍資訊</a></li>
                                </ul>
                            </div>
                        </article>
                    </div>
                </section>

               

            </div>
            
            <footer id="footer" style="background-color: #F5FFFA">
                <hr>
                <div class="row">
                    
                    <div class=col-12 style="margin-left: 7%;margin-top: 2%">
                        <h2 style="color: #B22222">書籍共享平台</h2>
                    </div>
                    <div class="col-4" style="margin-left: 7%;">
                    <ul class="contact">
                        <li class="icon solid fa-envelope"><a href="#">409401289@mail.fju.edu.tw</a></li>
                        <li class="icon solid fa-phone">(000) 000-0000</li>
                    </ul>
                    </div>
                    <div class="col-4">
                        <ul class="contact">
                            <li class="icon solid fa-home">1234 Somewhere Road #8254<br> Nashville, TN 00000-0000</li>
                        </ul>
                    </div>
                    <div class="col-3" style="margin-top: 3%;">
                        <h3>輔仁大學SA第一組</h3>
                    </div>
                </div>
                <p class="copyright" style="margin-left: 50%;margin-bottom:10px">© Untitled. All rights reserved. Demo Images: <a href="https://unsplash.com">Unsplash</a>. Design: <a href="https://html5up.net">HTML5 UP</a>.</p>
            </footer>
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
