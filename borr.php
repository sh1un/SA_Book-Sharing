<!--借書或還書-->
<?php
session_start();

$name = $_SESSION['name'];
$account = $_SESSION['account'];
$link = mysqli_connect("localhost", "root");
mysqli_query($link, "SET NAMES 'UTF8'");

mysqli_select_db($link, "sa");
if ($_GET['br'] == 'r') {
	$book_id = $_POST['book_id'];
	$sql = "UPDATE `book_info` SET `book_user`='none' WHERE book_id = $book_id";
	if (mysqli_query($link, $sql)) {
		header("location:index.php?log=r_success");
	}
} else {
	$book_id = $_SESSION['book_id'];
	$sql = "UPDATE `book_info` SET `book_user`='$account' WHERE book_id = $book_id";
	if (mysqli_query($link, $sql)) {
		header('location:index.php?log=b_success');
	}
}
?>