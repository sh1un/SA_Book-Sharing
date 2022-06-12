<!DOCTYPE HTML>

<html>
<?php
$link = mysqli_connect("localhost", "root");
mysqli_query($link, "SET NAMES 'UTF8'");
?>

<head>
    <title>常見問題</title>
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
                <!-- 常見問題 -->
                <ul>
                    <br><br>
                <li>
                    <span class="opener"><b>如何獲得點數</b></span>
                    <ul>
                        <li>1. 登入可獲得一點</li>
                        <li>2. 成功借出可獲得五點</li>
                        <li>3. 成功還書可獲得五點</a></li>
                    </ul>
                </li>
                <li>
                    <span class="opener"><b>上架問題</b></span>
                    <ul>
                        <li>1. 家裡的書都在積灰塵? 上架你的愛書讓更多人愛上這本書吧!</li>
                        <li>2. 上架書即時資訊打得越詳細，大家會越想借閱喔~</li>
                        <li>3. <a href="https://isbn.ncl.edu.tw/NEW_ISBNNet/">ISBN</a>是什麼? ISBN就是書籍的身分證~</li>
                    </ul>
                </li>
                <li>
                    <span class="opener"><b>借書問題</b></span>
                    <ul>
                        <li>1. 看到喜歡的書籍點擊「預約」按鈕，書籍擁有者確認後，系統扣除五點，即可成功借書</a></li>
                        <li>2. 沒有看到想借的書怎麼辦? 分享我們的書籍共享平台! 越多使用者有越多書會上架喔!</li>
                        <li>3. 成功借書可獲得五點</a></li>
                    </ul>
                </li>
                <li>
                    <span class="opener"><b>還書問題</b></span>
                    <ul>
                        <li>1. 點擊訂單列表中的「完成還書」按鈕，持有者確認後即可完成還書</li>
                        <li>2. 成功還書可獲得五點</a></li>
                    </ul>
                </li>
                
            </ul>
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