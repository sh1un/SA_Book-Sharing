<?php
    session_start();
    date_default_timezone_set('Asia/Taipei');
    $book_name = $_POST['book_name'];
    $book_owner = $_POST['book_owner'];
    $book_user = $_POST['book_user'];
    $order_time = date("Y/m/d/H/m/s");
    $return_time = date("Y/m/d/H/m/s");
    $order_status = $_POST['order_status'];

    $link = mysqli_connect("localhost", "root");
    mysqli_query($link, "SET NAMES 'UTF8'");
    mysqli_select_db($link, "sa");

    if(!$link){
        echo "連接失敗" . mysqli_connect_error();
    }
        $sql="insert into orderlist (book_name, book_owner, book_user, order_time, return_time, order_status) values ('$book_name', '$book_owner', '$book_user', '$order_time', '$return_time', '$order_status')";
        echo $sql;
            if(mysqli_query($link, $sql))
        {
            header('location:order.php?method=query');
        }

?>