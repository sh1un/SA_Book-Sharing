<?php
session_start();
$link = mysqli_connect("localhost", "root");
mysqli_query($link, "SET NAMES 'UTF8'");
mysqli_select_db($link, "sa");

if (isset($_SESSION['account'])) {
    $name = $_SESSION['name'];
    $account = $_SESSION['account'];
} else {
    header("location:index.php?log=no");
}

$sql = "select * from account where account = '$account' ";
$rs = mysqli_query($link, $sql);


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
                    <h2>會員中心</h2>
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

                <!-- Banner -->

                <section id="banner">
                    <div class="content">
                        <form action="update.php" method="POST">
                            <table>
                                <?php $row = mysqli_fetch_assoc($rs) ?>
                                <tr>
                                    <td width="550px">使用者名稱</td>
                                    <td><input type="hidden" value=<?php echo $row['name']; ?> name="name">
                                        <?php echo $row['name']; ?></td>
                                </tr>
                                <tr>
                                    <td>持有點數</td>
                                    <td>
                                        <?php echo $row['point']; ?></td>
                                </tr>
                                <tr>
                                    <td>帳號</td>
                                    <td><input type="hidden" value=<?php echo $row['account']; ?> name="account">
                                        <?php echo $row['account']; ?></td>
                                </tr>
                                <tr>
                                    <td>密碼</td>
                                    <td><input type="hidden" value=<?php echo $row['password']; ?> name="password">
                                        <?php echo $row['password']; ?></td>
                                </tr>
                                <tr>
                                    <td>電子信箱</td>
                                    <td><input type="hidden" value=<?php echo $row['email']; ?> name="email">
                                        <?php echo $row['email']; ?></td>
                                </tr>
                                <tr>
                                    <td>生日</td>
                                    <td><input type="hidden" value=<?php echo $row['birth']; ?> name="birth">
                                        <?php echo $row['birth']; ?></td>
                                </tr>
                                <tr>
                                    <td>居住區域</td>
                                    <td><input type="hidden" value=<?php echo $row['area']; ?> name="area"><input type="hidden" value=" <?php echo $row['address']; ?>" name="address">
                                        <?php echo $row['area'] . "     " . $row['address']; ?></td>
                                </tr>
                                <tr>
                                    <td>性別</td>
                                    <td><input type="hidden" value=<?php echo $row['gender']; ?> name="gender">
                                        <?php if ($row['gender'] == 'fe') {
                                            echo "女";
                                        } else if ($row['gender'] == 'ma') {
                                            echo "男";
                                        } ?></td>
                                </tr>
                                <tr>
                                    <td>聯絡方式</td>
                                    <td>
                                        <input type="hidden" value=<?php echo $row['con'];?> name="con">
                                        <?php echo $row['con'];?>
                                    </td>
                                </tr>

                            </table>
                            <div align="center">
                                <input type="submit" class="input_btn" value="編輯會員資料"><br>
                            </div>
                        </form>
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