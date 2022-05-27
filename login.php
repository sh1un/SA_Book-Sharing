<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
    <title>登入
    </title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/register.css" />
</head>

<body class="is-preload">

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Main -->
        <div id="main">
            <div class="inner">

                <!-- Header -->
                <header id="header">
                    <h1>歡迎使用書籍共享平台
                    </h1>
                    <h3 align="right"><br><br>立即登入！</h3>

                </header>

                <!-- Banner -->
                <section id="banner">
                    <span class="box">
                        <div class="items">
                            <h2>登入</h2>
                        </div>

                        <div class="items2">
                            <form action="login_check.php" method="post">
                                請輸入帳號密碼：
                                <input type="text" class="input_box" placeholder="帳號" name="account" required><br>
                                <input type="password" class="input_box" placeholder="請輸入16位密碼" name="password" required><br>
                        </div>
                        <?php

                        if (isset($_GET['login'])) {
                            if ($_GET['login'] == "nofound") {
                                echo "<span style='color:#CE0000;font-size:15px;'>" . "<br>" . "帳號不存在" . '</span>';
                            } elseif ($_GET['login'] == "fail") {
                                echo "<span style='color:#CE0000;font-size:15px;'>" . "<br>" . "帳號或密碼錯誤" . '</span>';
                            }
                        }
                        echo "<br>";
                        ?>
                        <input type="submit" class="input_btn" value="登入"><br>
                        <a href="register.php">註冊帳號</a><a href="forget.php">忘記密碼</a>
                        </form>
                    </span>
                </section>
            </div>
        </div>
        <?php include "index_bar.html" ?>
    </div>


</body>

</html>