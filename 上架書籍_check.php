<?php
session_start();
date_default_timezone_set('Asia/Taipei');
    $book_name = $_POST['book-name'];
    $book_author = $_POST['book-author'];
    $public = $_POST['public'];
    $public_date = $_POST['public-date'];
    $book_category = $_POST['book-category'];
    $book_image = $_POST['book-image'];
    $book_introduction = $_POST['book-introduction'];
    $book_owner = $_SESSION['account'];
    $ISBN = $_POST['ISBN'];
    $connection_method = $_SESSION['con'];
    $book_user = $_POST['book_user'];
    $borrow_day = $_POST['borrow_day'];
    $book_up_date = date("Y/m/d/H/m/s");
    
    $link = mysqli_connect("localhost", "root");
    
    mysqli_query($link, "SET NAMES 'UTF8'");
	mysqli_select_db($link, "sa");
    
    $sql="INSERT INTO `book_info`(`book_id`,`book_owner`,`book_user`,`book_name`, `book_author`, `public`, `public_date`, `book_category`, `book_image`, `book_introduction`, `up_date`, `likes`, `ISBN`, `borrow_day`) 
    VALUES (null,'$book_owner','$book_user','$book_name','$book_author','$public','$public_date','$book_category','$book_image','$book_introduction','$book_up_date',0,'$ISBN', '$borrow_day')";
      
    if(mysqli_query($link,$sql))
    {  

    }else{
        header('location:已上架書籍.php?sorf=上架失敗');
    }

    //將book_id傳入book_condition資料表
    $fetch_book_info_all_sql = "SELECT MAX(book_id) FROM book_info ";
    $book_info_rs = mysqli_query($link,$fetch_book_info_all_sql);
    $book_info_record = mysqli_fetch_array($book_info_rs);

    $sql2 = "INSERT INTO book_condition(book_id) VALUES ('$book_info_record[0]')";

    if(mysqli_query($link,$sql2))
    {  
        echo "<script>location.href = '上傳書況.php?book_id=$book_info_record[0]';</script>";
    }else{
        header('location:已上架書籍.php?sorf=上架失敗');
    }


    ;

?>