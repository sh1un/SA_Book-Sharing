
<!DOCTYPE HTML>

<html>

<head>
    <title>書籍共享平台-書籍上架</title>
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
                            header("location:index.php?log=no");
                        }
                        ?>
                </header>

                <!-- Content -->
                <section>

                    <!-- Content -->
                    <h2 id="content">輕鬆分享書籍！</h2>
                    <p>簡單幾個步驟，就能將您的愛書分享出去！讓其他人看看您的推薦吧！</p>

                    <hr class="major" />
                    <!--書籍資訊填寫表單-->
                    <h2 id="elements">書籍資訊</h2>

                    <form method="post" action="上架書籍_check.php">
                        <div class="row gtr-uniform">
                            <!--書名-->
                            <div class="col-6 col-12-xsmall">
                                <input type="text" name="book-name" id="book-name" value="" placeholder="書名" />
                            </div>
                             <!--ISBN-->
                             <div class="col-6 col-12-xsmall">
                                <input type="text" name="ISBN" id="ISBN" value="" placeholder="ISBN" />
                            </div>
                            <!--作者-->
                            <div class="col-6 col-12-xsmall">
                                <input type="name" name="book-author" id="book-author" value="" placeholder="作者" />
                            </div>
                            <div>
                                幫助：<a href="https://isbn.ncl.edu.tw/NEW_ISBNNet/">查詢ISBN</a>
                            </div>
                            <!--出版社-->
                            <div class="col-8 col-12-xsmall">
                                <input type="text" name="public" id="public" value="" placeholder="出版社" />
                            </div>
                            <!--出版日期-->
                            <div class="col-4 col-12-xsmall">
                                出版日期&nbsp&nbsp&nbsp<input type="date" name="public-date" id="public-date" />
                            </div>
                            <!-- 書籍分類 -->
                            <div class="col-6">
                                <select name="book-category" id="book-category">
                                    <option value="">分類</option>
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
                                </select>
                            </div>

                            <!-- 書籍簡介 -->
                            <div class="col-6">
                                請拍照上傳書籍現況封面&nbsp&nbsp&nbsp<input type="file" name="book-image" id="book-image" accept=".jpg, .png, .img, .jpeg" value=" " required />
                            </div>
                            <div class="col-6">
                                設定借閱天數：
                                <select name="borrow_day" id="book-category">
                                    <option value="30">借閱天數</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                </select>
                            </div>
                            <input type="hidden" value="none" name="book_user">
                            <!-- 上架按鈕 -->
                            <div class="col-12">
                                <ul class="actions">
                                    <li><input type="submit" value="下一步" class="primary" /></li>
                                    <li><input type="reset" value="重新填寫" /></li>
                                </ul>
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

</body>

</html>
