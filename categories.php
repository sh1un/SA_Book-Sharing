<?php
$account = $_SESSION['account'];
$category = $_GET['cat'];
$link = mysqli_connect("localhost", "root");
mysqli_query($link, "SET NAMES 'UTF8'");

mysqli_select_db($link, "sa");

$text = '排序方式';
if (!(isset($_GET['way']))) {
    $query_sql = "select * from book_info where book_category = '$category' group by ISBN";
}

if (isset($_GET['way'])) {

    //echo $colname_rs;
    $text = $_GET['way'];
    $query_sql = "select * from book_info where book_category = '$category' group by ISBN";

    switch ($_GET['way']) {
        case "最新":
            $query_sql .= " ORDER BY up_date DESC";
            break;
        case "最舊":
            $query_sql .= " ORDER BY up_date ASC";
            break;
        case "最多愛心":
            $query_sql .= " ORDER BY likes DESC";
            break;
        case "名稱":
            $query_sql .= " ORDER BY book_name DESC";
            break;
    }

    
}


$query_rs = mysqli_query($link, $query_sql);

?>
<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
	<title>書籍分類</title>
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

				<!-- 瀏覽Section  -->
				<section>
					<header class="major">
						<h2><?php echo $category?></h2>
					</header>
					<form method="get" action="">
					<h2 id="content">分類結果</h2>
					<select name="way" onchange="location=this.value;" required>
						<option selected="selected" disabled><?php echo $text; ?></option>
						<option value="categories.php?cat=<?php echo $category?>&way=最新">最新</option>
						<option value="categories.php?cat=<?php echo $category?>&way=最舊">最舊</option>
						<option value="categories.php?cat=<?php echo $category?>&way=最多愛心">最多愛心</option>
						<option value="categories.php?cat=<?php echo $category?>&way=名稱">名稱</option>
					</select>
					</form>
					 
					
					<div class="featuresforbrowse">
						<?php
						while ($rslt =  mysqli_fetch_assoc($query_rs)) {
						?>
							<article>
								<div style="width:30%; height:30%"><img style="width:100%; height:200%"src="images/<?php echo $rslt['book_image']; ?>" alt="" /></div>
								<div class="content">
									<h3><?php echo $rslt['book_name']; ?></h3>
									<p>作者 : <?php echo $rslt['book_author']; ?><br>
									出版社 : <?php echo $rslt['public']; ?><br>
									類別：<?php echo $rslt['book_category']; ?><br>
									上架時間 : <?php echo $rslt['up_date']; ?><br>
									收藏數：<?php echo $rslt['likes']; ?>🤍<br><br>
									<?php echo $rslt['book_introduction']; ?></p>
									<ul class="actions">
										<li><a href="書籍內容.php?ISBN=<?php echo $rslt['ISBN'] ?>" class="button big">書籍資訊</a>
                                </li></li>
									</ul>
								</div>
							</article>
							<article>
							</article>

						<?php
						} ?>

					</div>
				</section>


				
			</div>
		</div>

		<!-- Sidebar -->
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