<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
    <title>註冊帳號</title> 
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

                    <h3 align="right"><br><br>立即註冊開始使用！</h3>

                </header>

                <!-- Banner -->
                <section id="banner">
                    <span class="box">
						<div class="items">
							<h2>註冊</h2>
						</div>
						
						<div class="items2">
							<form action="register_check.php" method="post">
							請輸入以下基本資料：
							<input type="text" class="input_box" placeholder="姓名" name="name" required><br>
							<input type="text" class="input_box" placeholder="電子郵件" name="email" required><br>
							生日：
							<input type="date" class="input_box" placeholder="生日" name="birth" required><br>
							<input type="text" class="input_box" placeholder="住址" name="address" required><br>
							性別：<br>
							<input type="radio" name="gender" value="female" checked><label>女</label>
							<input type="radio" name="gender" value="male"><label>男</label><br>
							<input type="text" class="input_box" placeholder="帳號" name="account" required><br>
                         	<input type="password" class="input_box" placeholder="請輸入16位密碼" name="password" required><br>
						</div>
						<?php

                        if (isset($_GET['register'])) {
                            if ($_GET['register'] == "exist") {
                                echo "<span style='color:#CE0000;font-size:15px;'><br>帳號已存在 </span><span style='font-size: 20px;'></span>";
                                echo "<br>";
                            }
                        } ?>
						<input type="submit" class="input_btn" value="送出"><br>
					</form>
					</span>
                </section>
            </div>
        </div>
        <?php include "index_bar.html" ?>
    </div>


</body>

</html>