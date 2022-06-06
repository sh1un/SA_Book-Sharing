<?php
$account = $_POST['account'];
$email = $_POST['email'];

//連結
$link = mysqli_connect("localhost", "root");
//mysqli_select_db(連結，database名稱)
mysqli_select_db($link, "sa");
//sql語法
$sql = "select * from account where account = '$account' and email = '$email'";
//mysqli_query(連結，sql語法)
$rs = mysqli_query($link, $sql);
$user = mysqli_fetch_assoc($rs);

// if(empty($user['account'])){
//     header('location:login.php?message=無效的帳號！');
// }
?>

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
                <form action="" method="post">
                    <input type="hidden" name="account" value="<?php echo "$account" ?>">
                    <input type="hidden" name="email" value="<?php echo $email ?>">
                    <!-- Banner -->
                    <section id="banner">
                        <span class="box">
                            <div class="items">
                                <h2>安全性問題</h2>
                            </div>

                            <div class="items2">
                                <h4>請回答以下問題：</h4>
                                問題一：<?php echo $user['q1'] ?><br>
                                回答：<input type="text" name="answer1" required>
                            </div>
                            <div class="items2">
                                問題二：<?php echo $user['q2'] ?><br>
                                回答：<input type="text" name="answer2" required>
                            </div>
                            <div class="items2">
                                問題三：<?php echo $user['q3'] ?><br>
                                回答：<input type="text" name="answer3" required>
                            </div>
                            <?php 
                            @$answer1 = $_POST['answer1'];
                            @$answer2 = $_POST['answer2'];
                            @$answer3 = $_POST['answer3'];
                            if (isset($answer1)) {
                                if ($user['a1'] == $answer1 && $user['a2'] == $answer2 && $user['a3'] == $answer3) {
                                    header("location:pwsetting.php?email=$email&account=$account");
                                }
                                else{echo "<span style='color:#CE0000;font-size:15px;'><br>回答錯誤！</span><span style='font-size: 20px;'></span>";}
                            }?><br>
                            <input type="submit" value="確認"><br>
                            <a href="login.php">想起來了</a>
                        </span>

                    </section>
                </form>
            </div>
        </div>
        <?php include "index_bar.html" ?>
    </div>

</body>
