<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    session_start();
    if (isset($_SESSION['name'])) {
        $name = $_SESSION['name'];
        $account = $_SESSION['account'];
        $link = mysqli_connect("localhost", "root");
        
        mysqli_query($link, "SET NAMES 'UTF8'");
        mysqli_select_db($link, "sa");
        
    } else {
        header("location:index.php?log=no");
    }
?>
<?php
    date_default_timezone_set('Asia/Taipei');
    $order_id = $_GET['order_id'];
    $method = $_GET['method'];
    $book_id = $_GET['book_id'];
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
    if($book_owner==$account){
        $fetch_owner_check="SELECT owner_check FROM orderlist WHERE order_id='$order_id' ";
        $owner_check_rs=mysqli_query($link, $fetch_owner_check);
        $owner_check_record=mysqli_fetch_assoc($owner_check_rs);
        $owner_check_record2=$owner_check_record['order_check'];
        $owner_check_plusone_sql="UPDATE orderlist SET owner_check = $owner_check_record2 + 1 WHERE order_id='$order_id'";
        mysqli_query($link, $owner_check_plusone_sql);
    }
    else{
        $fetch_user_check="SELECT user_check FROM orderlist WHERE order_id='$order_id' ";
        $user_check_rs=mysqli_query($link, $fetch_user_check);
        $user_check_record=mysqli_fetch_assoc($user_check_rs);
        $user_check_record2=$user_check_record['order_check'];
        $user_check_plusone_sql="UPDATE orderlist SET user_check = $user_check_record2 + 1 WHERE order_id='$order_id'";
        mysqli_query($link, $user_check_plusone_sql);
    }
?>


<?php
// 根據order_check 更改 order_status，每過一個階段就會將owner_check和user_check歸零
    $fetch_book_user="SELECT book_user FROM orderlist WHERE order_id='$order_id' ";//抓此訂單的book_user
    $rs2=mysqli_query($link, $fetch_book_user);
    $record_book_user=mysqli_fetch_assoc($rs2);
    $owner_check_clear_sql="UPDATE orderlist SET owner_check = 0 WHERE order_id='$order_id'";
    $user_check_clear_sql="UPDATE orderlist SET user_check = 0 WHERE order_id='$order_id'";
    

    if($record['order_check']+1 == 2){
        $return_time = date("Y-m-d H:m:s",strtotime("+$borrow_day day"));//根據分享者設定的借閱天數，會在借到書的當下+上借閱天數，就會得到最慢還書時間
        $sql2="UPDATE orderlist SET order_status = '待還書' WHERE order_id='$order_id'";
        $update_book_info_user_sql="UPDATE book_info SET book_user = '$book_user' WHERE book_id='$book_id'";
        $update_return_time_sql="UPDATE orderlist SET return_time = '$return_time' WHERE book_id='$book_id'";
        
        mysqli_query($link, $update_return_time_sql);
        mysqli_query($link, $sql2);
        mysqli_query($link, $owner_check_clear_sql);
        mysqli_query($link, $user_check_clear_sql);
        
    }

    

    if($book_owner==$account && $record['order_check'] <= 1){//判斷按下此按鈕的人是否為分享者，以及是否為待借書狀態，是的話將他點數+5
        $lend_point_sql="UPDATE `account` SET point=point+5 WHERE account = '$account'";

        mysqli_query($link, $lend_point_sql);

        $location_deny=true;//用來防止83行，header("location:order.php?"); 擋掉location
        echo "<script>alert('感謝您的分享，您已獲得5point！'); location.href='order.php'</script>";
        
    }

    
    if($record_book_user['book_user']==$account && $record['order_check'] <= 1){//判斷按下此按鈕的人是否為租借者，以及是否為待借書狀態，是的話將他點數-5
        $borrow_point_sql="UPDATE `account` SET point=point-5 WHERE account = '$account'";
        $update_book_info_user_sql="UPDATE book_info SET book_user = '$account' WHERE book_id='$book_id'";
        
        mysqli_query($link, $borrow_point_sql);
        mysqli_query($link, $update_book_info_user_sql);
        
        $location_deny=true;//用來防止83行，header("location:order.php?"); 擋掉借書扣除5points的location
        echo "<script>alert('借書成功，已扣除5point，可借閱天數為 $borrow_day 天，在雙方確認借書後，請務必至訂單列表確認「最慢還書日期」'); location.href='order.php'</script>";
        
    }
    elseif($record['order_check']+1 == 4){
        $sql3="UPDATE orderlist SET order_status = '待評價' WHERE order_id='$order_id'";
        mysqli_query($link, $sql3);
        mysqli_query($link, $owner_check_clear_sql);
        mysqli_query($link, $user_check_clear_sql);
    }
    elseif($record['order_check']+1 == 5){
        $sql4="UPDATE orderlist SET order_status = '已完成' WHERE order_id='$order_id'";
        mysqli_query($link, $sql4);
        mysqli_query($link, $owner_check_clear_sql);
        mysqli_query($link, $user_check_clear_sql);
    }
?>

<?php
    if($method=='delete'){
        $sql5="DELETE FROM orderlist WHERE order_id = '$order_id'";
        mysqli_query($link, $sql5);
    }

?>
<?php
    mysqli_close($link);
    if($location_deny){//用來防止83行，header("location:order.php?"); 擋掉借書扣除5points的location
        
    }
    else{
        header("location:order.php?");
    }
    
?>
</body>
</html>