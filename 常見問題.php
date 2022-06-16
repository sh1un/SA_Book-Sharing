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
                    <span><b>點數</b></span>
                    <ul>
                        <li>1. 登入可獲得一點</li>
                        <li>2. 成功借出可獲得五點</li>
                        <li>3. 借閱書籍扣除五點</li>
                    </ul>
                </li>
                <li>
                    <span><b>上架問題</b></span>
                    <ul>
                        <li>1. 家裡的書都在積灰塵? 上架你的愛書讓更多人愛上這本書吧!</li>
                        <li>2. 上架書即時資訊打得越詳細，大家會越想借閱喔~</li>
                        <li>3. <a href="https://isbn.ncl.edu.tw/NEW_ISBNNet/">ISBN</a>是什麼? ISBN就是書籍的身分證~</li>
                    </ul>
                </li>
                <li>
                    <span><b>借書問題</b></span>
                    <ul>
                        <li>1. 看到喜歡的書籍點擊「預約」按鈕，書籍擁有者確認後，系統扣除五點，即可成功借書</a></li>
                        <li>2. 沒有看到想借的書怎麼辦? 分享我們的書籍共享平台! 越多使用者有越多書會上架喔!</li>
                        <li>3. 成功借出書籍可獲得五點</li>
                    </ul>
                </li>
                <li>
                    <span><b>訂單列表操作</b></span>
                    <ul>
                        <br>
                        <li>1. 借閱者：</li>
                        <ul>
                            <li>預約書籍後，訂單列表會顯示待借書</li>
                            <li>與捐借者雙方確認後，按下已借書，訂單列表顯示待還書</li>
                            <li>看完書籍，與捐借者雙方確認後，按下已還書，訂單列表顯示待評價</li>
                            <li>評價完成後則完成還書</li>
                            <li>在預約狀態可以取消訂單</li>
                        </ul>
                        <li>2. 捐借者：</li>
                        <ul>
                        <li>有人向你預約書籍，訂單列表會顯示待借書</li>
                        <li>與借閱者雙方確認後，按下已借書，訂單列表顯示待還書</li>
                        <li>待借閱者看完書籍，雙方確認後，按下已還書，訂單列表顯示待評價</li>
                        <li>待捐借者評價完成後則完成還書</li>
                        <li>在預約狀態可以取消訂單</li>
                        </ul>
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