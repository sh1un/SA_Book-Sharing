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
        
        $rs = mysqli_query($link, $sql);
    } else {
        header("location:index.php?log=no");
    }
?>
<?php
    $order_id = $_GET['order_id'];
    $method = $_GET['method'];
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
// 根據order_check 更改 order_status
    $fetch_book_user="SELECT book_user FROM orderlist WHERE order_id='$order_id' ";//抓此訂單的book_user
    $rs2=mysqli_query($link, $fetch_book_user);
    $record_book_user=mysqli_fetch_assoc($rs2);

    if($record['order_check']+1 == 2){
        $sql2="UPDATE orderlist SET order_status = '待還書' WHERE order_id='$order_id'";
        
        if($record_book_user['book_user']==$account){//判斷按下此按鈕的人是否為租借者，是的話將他點數-5
            $borrow_point_sql="UPDATE `account` SET point=point-5 WHERE account = '$account'"; 
            mysqli_query($link, $borrow_point_sql);
            $location_deny=true;//用來防止83行，header("location:order.php?"); 擋掉借書扣除5points的location
            echo "<script>alert('借書成功，扣除5point'); location.href='order.php'</script>";
            
        }
        mysqli_query($link, $sql2);
    }
    elseif($record['order_check']+1 == 4){
        $sql3="UPDATE orderlist SET order_status = '待評價' WHERE order_id='$order_id'";
        mysqli_query($link, $sql3);
    }
    elseif($record['order_check']+1 == 5){
        $sql4="UPDATE orderlist SET order_status = '已完成' WHERE order_id='$order_id'";
        mysqli_query($link, $sql4);
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