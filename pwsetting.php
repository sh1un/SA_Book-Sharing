<?php
//login傳值
$account = $_GET['account'];
$email = $_GET['email'];
$pw1 = $_POST['pw1'];
$pw2 = $_POST['pw2'];

if(isset($pw1)){
    $link = mysqli_connect("localhost", "root");
    mysqli_select_db($link, "sa");
    if($pw1 == $pw2){
        $sql = "UPDATE account SET password = '1234' WHERE email='$email';";
        if(mysqli_query($link, $sql))
        {
            header("location:login.php?密碼修改成功！");
        }
    }else{
        echo "<script>alert('密碼不一致')</script>";
    }
}
?>
<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
    <title>忘記密碼</title> 
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/register.css" />

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
							<h2>重設密碼</h2>
						</div>
						
						<div class="items2">
							<form name=pw action="" method="post">
                                
                    <input hidden name="account" value= <?php echo "$account" ?>>
                    <input hidden name="email" value=<?php echo "$email" ?>>
							重新設定新密碼：
							<input type="text" class="input_box" placeholder="新密碼" name="pw1" required><br>
                        </div>
                        <div class="items2">
							確認密碼：
							<input type="text" class="input_box" placeholder="新密碼" name="pw2" required><br>
                        </div>
                        <input type="submit" value="確認"><br>
</form>
            </div>
        </div>
        <?php include "index_bar.html" ?>
    </div>


</body>

</html>