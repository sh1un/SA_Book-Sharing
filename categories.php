<?php
session_start();
$account = $_SESSION['account'];
$category = $_GET['cat'];
$link = mysqli_connect("localhost", "root");
mysqli_query($link, "SET NAMES 'UTF8'");

mysqli_select_db($link, "sa");
$sql = "select * from book_info where book_category = '$category' order by up_date DESC;";
$rs = mysqli_query($link, $sql);

?>
<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
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
					<div class="featuresforbrowse">
						<?php
						while ($rslt =  mysqli_fetch_assoc($rs)) {
						?>
							<article>
								<div style="width:30%; height:30%"><img style="width:100%; height:200%"src="images/<?php echo $rslt['book_image']; ?>" alt="" /></div>
								<div class="content">
									<h3><?php echo $rslt['book_name']; ?></h3>
									<p>作者 : <?php echo $rslt['book_author']; ?><br>
									出版社 : <?php echo $rslt['public']; ?><br>
									類別：<?php echo $rslt['book_category']; ?><br>
									上架時間 : <?php echo $rslt['up_date']; ?><br>
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