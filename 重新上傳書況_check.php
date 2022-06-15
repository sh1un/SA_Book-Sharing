<?php
session_start();
date_default_timezone_set('Asia/Taipei');
    $book_broken_image_count = count($_FILES['book_broken_image']['name']);

    $link = mysqli_connect("localhost", "root");
    
    mysqli_query($link, "SET NAMES 'UTF8'");
	mysqli_select_db($link, "sa");

    $book_id = $_GET['book_id'];
    $note = $_POST['note'];
    $account = $_SESSION['account'];
    
    //從book_info資料表取得資料
    $fetch_book_info_all_sql = "SELECT * FROM book_info WHERE book_id = '$book_id'";
    $book_info_rs = mysqli_query($link,$fetch_book_info_all_sql);
    $book_info_array = mysqli_fetch_array($book_info_rs);
    $book_owner = $book_info_array['book_owner'];



if(isset($_POST['submit'])){
    if($book_owner == $account){
        $book_broken_image_count = count($_FILES['book_broken_image']['name']);
        $record = [];
        for($i=0;$i<$book_broken_image_count;$i++){
            $record[$i] = $_FILES['book_broken_image']['name'][$i];
            echo $record[$i];

        }
        $book_broken_image_insert_sql = "UPDATE book_condition SET book_broken_image1 = '$record[0]',  book_broken_image2 = '$record[1]',  book_broken_image3 = '$record[2]',  book_broken_image4 = '$record[3]' , book_broken_image5 = '$record[4]', note = '$note' WHERE book_id = $book_id";
        if(empty($record[4])){
            $delete_broken_image = "DELETE FROM book_condition WHERE book_id = $book_id ";
            echo "<script>alert('請上傳完整五張書況圖！')</script>";
            header("location:重新上傳書況.php?book_id=$book_id");}
        else{
            mysqli_query($link,$book_broken_image_insert_sql);
        echo mysqli_query($link,$book_broken_image_insert_sql);
        echo "<script>alert('上傳成功！'); location.href='已上架書籍.php'</script>";
        }
        
    }
    else{
        echo "<script>alert('權限不足'); location.href='index.php'</script>";
    }
}
else{
    // header('location:已上架書籍.php?sorf=上架失敗');
}

?>