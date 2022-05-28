<head>
    <title>找回密碼</title>
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

                <!-- Banner -->
                <section id="banner">
                    <span class="box">

                        <div class="items2">
                            <?php
                            $account = $_POST['account'];
                            $email = $_POST['email'];
                            $link = mysqli_connect("localhost", "root", "12345678");
                            mysqli_select_db($link, "sa");


                            $sql = "SELECT * FROM `account` WHERE account ='$account' AND email = '$email'";
                            //mysqli_query(連結，sql語法)
                            $rs = mysqli_query($link, $sql);

                            if ($user = mysqli_fetch_assoc($rs)) {
                                echo "<h2>找回密碼成功！</h2>" . "您的密碼為：";
                                echo $user['password'];
                            } else echo "<h2>沒有此帳號！</h2>";
                            ?>
                        </div>
                        <a href="login.php" type="submit">登入</a>
                        <a href="forget.php" type="submit">返回</a>
                    </span>
                </section>
            </div>
        </div>

    <?php include "index_bar.html" ?>
    </div>

</body>