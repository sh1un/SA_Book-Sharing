
<?php

    if (isset($_SESSION['name'])) {
        $name = $_SESSION['name'];
        $account = $_SESSION['account'];
        $link = mysqli_connect("localhost", "root" ,"12345678");
        
        mysqli_query($link, "SET NAMES 'UTF8'");
        mysqli_select_db($link, "sa");
        
    } else {
        header("location:index.php?log=no");
    }
?>
<?php
    date_default_timezone_set('Asia/Taipei');
    $order_id = $_GET['order_id'];
    @$method = $_GET['method'];
    $book_id = $_GET['book_id'];
    $order_day = $_GET['order_day'];
?>
    <form action='' method='post'>
        <input type='hidden' name='order_id' value="<?php echo $order_id; ?>">
    </form>
<?php
// 點擊使Order_check + 1
    $fetch_order_check="SELECT order_check FROM orderlist WHERE order_id='$order_id' ";
    $rs=mysqli_query($link, $fetch_order_check);
    $record=mysqli_fetch_assoc($rs);
    $record2=$record['order_check'];
    $sql="UPDATE orderlist SET order_check = $record2 + 1 WHERE order_id='$order_id'";
    mysqli_query($link, $sql);
?>
<?php
//從orderlist資料表取得資料
    $fetch_orderlist_all_sql = "SELECT * FROM orderlist WHERE order_id = '$order_id'";
    $orderlist_rs = mysqli_query($link,$fetch_orderlist_all_sql);
    $orderlist_array = mysqli_fetch_array($orderlist_rs);
    $book_owner = $orderlist_array['book_owner'];
    $book_user = $orderlist_array['book_user'];
    $return_time = $orderlist_array['return_time'];
?>

<?php
//從book_info資料表取得資料
    $fetch_book_info_all_sql = "SELECT * FROM book_info WHERE book_id = '$book_id'";
    $book_info_rs = mysqli_query($link,$fetch_book_info_all_sql);
    $book_info_array = mysqli_fetch_array($book_info_rs);
    $borrow_day = $book_info_array['borrow_day'];
?>

<?php
// 判斷目前登入帳號是書本的捐借者還是租借者，點擊使owner_check或user_check +1
    if($book_user==$account){
        $fetch_user_check="SELECT user_check FROM orderlist WHERE order_id='$order_id' ";
        $user_check_rs=mysqli_query($link, $fetch_user_check);
        $user_check_record=mysqli_fetch_assoc($user_check_rs);
        $user_check_record2=$user_check_record['user_check'];
        $user_check_plusone_sql="UPDATE orderlist SET user_check = $user_check_record2 + 1 WHERE order_id='$order_id'";
        mysqli_query($link, $user_check_plusone_sql);
    }
?>

<?php
    if($method=='delete'){
        $sql5="DELETE FROM orderlist WHERE order_id = '$order_id'";
        mysqli_query($link, $sql5);
    }

?>
<?php
    header("location:return.php?book_id=$book_id&order_id=$order_id&order_day=$order_day");
    $sql4="UPDATE orderlist SET order_status = '已完成' WHERE order_id='$order_id'";
    mysqli_query($link, $sql4);
    mysqli_close($link);


?>
</body>
</html>