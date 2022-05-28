<?php
session_start();
$name = $_SESSION['name'];
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
					<a href="index.php" class="logo"><strong>書籍共享平台</strong></a>
					<ul class="icons">
						<li><a href="login.php" class="button primary small">登入</span></a></li>
					</ul>

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
										<li><a href="書籍內容.php?book_id=<?php echo $rslt['book_id'] ?>" class="button">立即借閱</a></li>
									</ul>
								</div>
							</article>
							<article>
							</article>

						<?php
						} ?>

					</div>
				</section>

				<!-- Section 
				<section>
					<header class="major">
						<h2>哲學類</h2>
					</header>
					<div class="features">
						<article>
							<span><img src="images/沉思錄.jpg" alt="" /></span>
							<div class="content">
								<h3>沉思錄</h3>
								<p>作者：馬可·奧理略</p>
								<p>書籍簡介：影響西方文化兩千年的傳世經典，最完整台灣新譯一代賢帝的立身處世之道，欲成大器者必讀之書<br></p>
								<ul class="actions">
									<li><a href="#" class="button">立即借閱</a></li>
								</ul>
							</div>
						</article>
						<article>
							<span><img src="images/哲學與人生.jpg" alt="" /></span>
							<div class="content">
								<h3>哲學與人生</h3>
								<p>作者：傅佩榮</p>
								<p>書籍簡介：「哲學」做為一門學問，原來只是一種生活態度，就是保持好奇的天性，探詢一切事物的真相。這種態度稱為「愛智」。<br></p>
								<ul class="actions">
									<li><a href="#" class="button">立即借閱</a></li>
								</ul>
							</div>
						</article>
						<article>
							<span><img src="images/廁所裡的哲學課.jpg" alt="" /></span>
							<div class="content">
								<h3>廁所裡的哲學課</h3>
								<p>作者：亞當弗萊徹.盧卡斯‧NP‧艾格.康拉德柯列弗</p>
								<p>書籍簡介：平均來說，我們每天會花14分鐘蹲馬桶，既然如此，何不善用蹲馬桶的寶貴時間，學點真正有用的東西？<br></p>
								<ul class="actions">
									<li><a href="#" class="button">立即借閱</a></li>
								</ul>
							</div>
						</article>
						<article>
							<span><img src="images/西方哲學與人生.jpg" alt="" /></span>
							<div class="content">
								<h3>西方哲學與人生</h3>
								<p>作者：亞當弗萊徹</p>
								<p>書籍簡介：哲學就是人生經濟學，用最少時間，達成最大效果。<br></p>
								<ul class="actions">
									<li><a href="#" class="button">立即借閱</a></li>
								</ul>
							</div>
						</article>
					</div>
				</section>-->

				
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