<?php
if (isset($_SESSION['name'])) {
    $name = $_SESSION['name'];
    $account = $_SESSION['account'];
    $book_id = $_GET['book_id'];
    $link = mysqli_connect("localhost", "root");

    mysqli_query($link, "SET NAMES 'UTF8'");
    mysqli_select_db($link, "sa");
    $sql = "select * from book_info where book_owner = '$account' and book_id = '$book_id'";
    $rs = mysqli_query($link, $sql);
} else {
    header("location:index.php?log=no");
}

//從book_condition資料表取得資料
$fetch_book_condition_all_sql = "SELECT * FROM book_condition WHERE book_id = '$book_id'";
$book_condition_rs = mysqli_query($link, $fetch_book_condition_all_sql);
$book_condition_array = mysqli_fetch_array($book_condition_rs);
?>
<!DOCTYPE HTML>

<html>

<head>
    <title>編輯書籍</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/book-list.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

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



                <!-- 書單 -->
                <!-- 點圖片到書籍資訊頁面 -->
                <section>
                    <header class="major">
                        <h2>編輯書籍</h2>
                    </header>
                    <form action="編輯書籍_check.php" method="POST">
                        <div class="posts">
                            <?php
                            $rs =  mysqli_fetch_assoc($rs);
                            ?>
                            <div>
                                <table>

                                    <tr>
                                        <td width="550px">更換圖片：</td>
                                        <td><input type="file" name="udbook-image" id="book-image" accept=".jpg, .png, .img, .jpeg" value="" />
                                            <input type="hidden" value=<?php echo $rs['book_image']; ?> name="book-image">
                                            <img class="img_item" src='images/<?php echo $rs['book_image']; ?>' alt="" />
                            </div>
                            </td>
                            </tr>
                            <tr>
                                <td>書名：</td>
                                <td>
                                    <h3><input type="text" name="udbook-name" id="book-name" value="<?php echo $rs['book_name'] ?>" /></h3>
                                </td>
                            </tr>
                            <tr>
                                <td>ISBN：</td>
                                <td>
                                    <h3><input type="text" name="udISBN" id="ISBN" value="<?php echo $rs['ISBN'] ?>" /></h3>
                                </td>
                            </tr>
                            <tr>
                                <td>編號 :</td>
                                <td><input type="hidden" value=<?php echo $rs['book_id'] ?> name="book_id">
                                    <?php echo $rs['book_id'] ?>
                                    <p><?php if ($rs['book_user'] == "none") {
                                        ?><input type="hidden" value="none" name="book_user">
                                </td>
                                </p>
                            </tr>
                            <tr>
                                <td>租借情況：none <br> 租借人：none</td>
                                <td><?php
                                        } else { ?><input type="hidden" value="<?php echo $rs['name'] ?>" name="book_user">
                                    租借情況：租借中 <br> 租借人 : <?php
                                                        echo $rs['name'];
                                                    } ?></td>
                            </tr>
                            <tr>
                                <td>捐借人：</td>
                                <td><input type="hidden" value=<?php echo $name ?> name="book_owner"><?php echo $name ?></td>
                            </tr>
                            <tr>
                                <td>上架時間：</td>
                                <td><input type="hidden" value=<?php echo $rs['up_date'] ?> name="up_date">
                                    <?php echo $rs['up_date'] ?></td>
                            </tr>
                            <tr>
                                <td>作者：</td>
                                <td><input type="text" name="udbook-author" id="book-author" value="<?php echo $rs['book_author'] ?>" required></td>
                            </tr>
                            <tr>
                                <td>出版社：</td>
                                <td><input type="text" name="udpublic" id="public" value="<?php echo $rs['public'] ?>" /></td>
                            </tr>
                            <tr>
                                <td>出版日期：</td>
                                <td><input type="date" name="udpublic-date" id="public-date" value="<?php echo $rs['public_date'] ?>" /></td>
                            </tr>
                            <tr>
                                <td>類別：</td>
                                <td><select name="udbook-category" id="book-category" required>
                                        <option selected="selected" disabled>請重新選擇類別</option>
                                        <option value="總類">000 總類</option>
                                        <option value="哲學類">100 哲學類</option>
                                        <option value="宗教類">200 宗教類</option>
                                        <option value="科學類">300 科學類</option>
                                        <option value="應用科學類">400 應用科學類</option>
                                        <option value="社會科學類">500 社會科學類</option>
                                        <option value="史地類：中國史地">600 史地類：中國史地</option>
                                        <option value="史地類：世界史地">700 史地類：世界史地</option>
                                        <option value="語言文學類">800 語言文學類</option>
                                        <option value="藝術類">900 藝術類</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td>
                                    <!-- 以下輪播圖 -->
                                    書況圖：
                                    <div id="demo" class="carousel slide" data-ride="carousel" style='width:200px;'>
                                        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                                            <div class="carousel-indicators">
                                                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="3" aria-label="Slide 4"></button>
                                                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="4" aria-label="Slide 5"></button>
                                            </div>
                                            <div class="carousel-inner">
                                                <div class="carousel-item active" data-bs-interval="10000">
                                                    <img src="images/<?php echo $book_condition_array['book_broken_image1']; ?>" class="d-block w-100" style='height:240px;' alt="書況圖1">
                                                </div>
                                                <div class="carousel-item" data-bs-interval="2000">
                                                    <img src="images/<?php echo $book_condition_array['book_broken_image2']; ?>" class="d-block w-100" style='height:240px;' alt="書況圖2">
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="images/<?php echo $book_condition_array['book_broken_image3']; ?>" class="d-block w-100" style='height:240px;' alt="書況圖3">
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="images/<?php echo $book_condition_array['book_broken_image4']; ?>" class="d-block w-100" style='height:240px;' alt="書況圖4">
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="images/<?php echo $book_condition_array['book_broken_image5']; ?>" class="d-block w-100" style='height:240px;' alt="書況圖5">
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </a>
                                        </div>

                                    </div>
                                    <!-- 以上輪播圖 -->
                                </td>
                                <td><a href="重新上傳書況.php?book_id=<?php echo $book_id; ?>" target="_blank">編輯</a></td>
                            </tr>

                            </table>
                            <div align="center">
                                <input type="submit" class="input_btn" value="確認修改"><br>
                            </div>

                        </div>





            </div>
            </form>
            </section>

        </div>
        <?php include "footer.php" ?>
    </div>

    <?php include "index_bar.html" ?>

    </div>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>


</body>

</html>