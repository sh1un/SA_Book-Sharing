<!--借書或還書-->
<?php
session_start();

$name = $_SESSION['name'];
$account = $_SESSION['account'];
$link = mysqli_connect("localhost", "root");
mysqli_query($link, "SET NAMES 'UTF8'");

mysqli_select_db($link, "sa");
if ($_GET['br'] == 'r') {
	//return
	$book_id = $_POST['book_id'];
	$sql = "UPDATE `book_info` SET `book_user`='none' WHERE book_id = $book_id";
	//評論書籍
	$return_time = $_POST['return_date'];
	$rate = $_POST['rate'];
	$rate_content = $_POST['rate_content'];
	$rate_sql = "INSERT INTO `evaluation`(`rate_id`,`book_id`,`account`,`rate`, `rate_content`, `rate_time`) 
    VALUES (null,'$book_id','$account','$rate','$rate_content','$return_time')";
	//query
	if (mysqli_query($link, $rate_sql) and mysqli_query($link, $sql)) {
		header("location:index.php?log=r_success");
	} else {
		header("location:index.php?log=r_fail");
	}
} else {
	$book_id = $_SESSION['book_id'];
	$sql = "UPDATE `book_info` SET `book_user`='$account' WHERE book_id = $book_id";
	if (mysqli_query($link, $sql)) {
		header('location:index.php?log=b_success');
	}
}
?>