<head>
    <title>忘記密碼
    </title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/login.css" />
</head>

<body class="is-preload">

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Main -->
        <div id="main">
            <div class="inner">
            <header id="header">
                    <h1>歡迎使用書籍共享平台
                    </h1>
                    <h3 align="right"><br><br>忘記密碼！</h3>

                </header>
                <form action="safe_qa.php" method="post">
                    <!-- Banner -->
                    <section id="banner">
                        <span class="box">
                            <div class="items">
                                <h2>忘記密碼</h2>
                            </div>

                            <div class="items2">
                                <h4>輸入您的信箱和帳號以查詢密碼：</h4>
                                信箱：<input type="text" name="email" required>
                                帳號：<input type="text" name="account" required>
                            </div>
                            <input type="submit" value="尋找"><br>
                            <a href="login.php">想起來了</a>
                        </span>

                    </section>
                </form>
            </div>
        </div>
        <?php include "index_bar.html" ?>
    </div>

</body>
