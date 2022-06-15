<?php
if (isset($_SESSION['name'])) {
    $name = $_SESSION['name'];
    $account = $_SESSION['account'];
    $account2 = $_SESSION['account'];
    $link = mysqli_connect("localhost", "root");

    mysqli_query($link, "SET NAMES 'UTF8'");
    mysqli_select_db($link, "sa");
    $sql = "select * from book_info where book_owner = '$account'  order by up_date DESC";
    $rs = mysqli_query($link, $sql);
} else {
    header("location:index.php?log=no");
}


?>
<!DOCTYPE HTML>

<html>

<head>
    <title>訂單列表</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/book-list.css" />

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
                            $con = $_SESSION['con'];
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



                <!-- 書單 -->
                <!-- 點圖片到書籍資訊頁面 -->
                <section>
                    <header class="major">
                        <h2>訂單列表</h2>
                    </header>
                    <?php
                        @$searchtxt = $_GET["searchtxt"];
                        @$iamowner = $_GET["iamowner"];
                        @$iamuser = $_GET["iamuser"];
                        @$filter = $_GET["filter"]
                    ?>
                    <form method="get" action="" id='searchtxt'>
                        <input type="text" name="searchtxt" value="<?php echo $searchtxt; ?>"  placeholder="輸入關鍵字" />
                    </form>
                    <form method="get" action="return_check.php">
                        <input type="hidden" name="book_id" value="<?php echo $book_id;?>">
                    </form>
                    <div id="ss">
                        <ul class="pagination">
                            <li><a href="order.php?filter=iamowner" class="page" onclick="changestyle(this)">&emsp;我是捐借者</a></li>|&nbsp;
                            <li><a href="order.php?filter=iamuser" class="page">我是租借者</a></li>&nbsp; |&nbsp;
                            <li><a href="order.php?filter=tobeborrowed" class="page">待借書</a></li>&nbsp; |&nbsp; 
                            <li><a href="order.php?filter=tobereturn" class="page">待還書</a></li>&nbsp; |&nbsp; 
                            <li><a href="order.php?filter=tobeevaluation" class="page">待評價</a></li>&nbsp; |&nbsp; 
                            <li><a href="order.php?filter=finished" class="page">已完成</a></li> &nbsp;|
                            <li><a href="order.php" class="page">全部</a></li>
                        </ul>
                    </div>
                    
                    <br>
                    <div class="posts">
                        <table>
                            <thead>
                                <tr>
                                    <th>訂單編號</th>
                                    <th>書名</th>
                                    <th>捐借者</th>
                                    <th>租借者</th>
                                    <th>訂單成立時間</th>
                                    <th>最慢還書日期</th>
                                    <th>狀態</th>
                                    <th>操作</th>
                                    <th>刪除</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <?php
                                    $link = mysqli_connect("localhost", "root");
                                    mysqli_query($link, "SET NAMES 'UTF8'");
                                    mysqli_select_db($link, "sa");
                                    if(empty($searchtxt))
                                    {
                                        $sql="select * from orderlist where book_owner like '$account' or book_user like '$account' ";
                                    }
                                    elseif($filter=='iamowner')
                                    {
                                        $sql="select * from orderlist where book_owner like '$account'";
                                        

                                    }
                                    elseif($filter=='iamuser')
                                    {
                                        $sql="select * from orderlist where book_user like '$account'";

                                    }
                                    elseif($filter=='tobeborrowed')
                                    {
                                        $sql="select * from orderlist where (book_owner like '$account' or book_user like '$account') and order_status like '待借書' ";

                                    }
                                    elseif($filter=='tobereturn')
                                    {
                                        $sql="select * from orderlist where (book_owner like '$account' or book_user like '$account') and order_status like '待還書' ";

                                    }
                                    elseif($filter=='tobeevaluation')
                                    {
                                        $sql="select * from orderlist where (book_owner like '$account' or book_user like '$account') and order_status like '待評價' ";

                                    }
                                    elseif($filter=='finished')
                                    {
                                        $sql="select * from orderlist where (book_owner like '$account' or book_user like '$account') and order_status like '已完成' ";

                                    }
                                    else
                                    {
                                        $sql="select * from orderlist where order_id like '%$searchtxt%' or book_name like '%$searchtxt%' or order_time like '$searchtxt' or return_time like '$searchtxt' and (book_owner like '$account' or book_user like '$account') ";
                                    }
                                    echo $sql;
                                    $rs=mysqli_query($link,$sql);
                                    while($record=mysqli_fetch_row($rs))
                                    {
                                        echo 
                                        "   
                                        <tr>
                                            <td>$record[0]</td>
                                            <td>$record[1]</td>
                                            <td>$record[2]</td>
                                            <td>$record[3]</td>
                                            <td>$record[4]</td>
                                            <td>$record[5]</td>
                                            <td>$record[6]</td>
                                        ";

                                            $fetch_owner_user_check_sql = "SELECT * FROM orderlist WHERE order_id = '$record[0]'";//抱歉這裡可能需要改一下變數名稱我發現我設得不太合理雖然不影響系統運作，by Shiun
                                            $check_rs = mysqli_query($link,$fetch_owner_user_check_sql);
                                            $check_rs_array = mysqli_fetch_array($check_rs);
                                            $owner_check = $check_rs_array['owner_check'];
                                            $user_check = $check_rs_array['user_check'];
                                            $book_owner = $check_rs_array['book_owner'];
                                            $book_user = $check_rs_array['book_user'];
                                            $order_check = $check_rs_array['order_check'];
                                            $book_name = $check_rs_array['book_name'];
                                            $book_id = $check_rs_array['book_id'];
                                            $ISBN = $check_rs_array['ISBN'];

                                        if($book_owner == $account){
                                            if($owner_check == 1){
                                                echo "<td><button disabled>操作完成</button></td>";
                                            }
                                            elseif($order_check < 2){
                                                echo "<td><a href=order_check.php?method=update&order_id=$record[0]&book_id=$book_id><button>完成借書</button></a></td>";
                                            }
                                            elseif($order_check < 4){
                                                echo "<td><a href=order_check.php?method=update&order_id=$record[0]><button>完成還書</button></a></td>";
                                            }
                                            elseif($order_check < 5){
                                                echo "<td><button disabled>等待評價</button></td>";
                                            }
                                            else{
                                                echo "<td><a href=書籍內容.php?book_name=$book_name&ISBN=000000000001><button>查看書籍</button></a></td>";
                                            }
                                        }
                                        elseif($book_user == $account){
                                            if($user_check == 1){
                                                echo "<td><button disabled>操作完成</button></td>";
                                            }
                                            elseif($order_check < 2){
                                                echo "<td><a href=order_check.php?method=update&order_id=$record[0]&book_id=$book_id><button>完成借書</button></a></td>";
                                            }
                                            elseif($order_check < 4){
                                                echo "<td><a href=order_check.php?method=update&order_id=$record[0]><button>完成還書</button></a></td>";
                                            }
                                            elseif($order_check < 5){
                                                echo "<td><a href=return_check.php?order_id=$record[0]&book_id=$book_id&order_day=$record[4]><button>進行評價</button></a></td>";//點擊此按鈕應要進入評價頁面
                                            }
                                            else{
                                                echo "<td><a href=書籍內容.php?book_name=$book_name&ISBN=$ISBN><button>查看書籍</button></a></td>";//讓使用者可以回到這本書的頁面去看評價
                                            }
                                        }
                                            
                                            
                                        if($order_check == 5){
                                            echo "<td><button disabled>訂單完成</button></td>";
                                        }
                                        else if($order_check < 2){
                                            echo "<td><a href=order_check.php?method=delete&order_id=$record[0]><button>取消訂單</button></a></td>";
                                        }
                                        else{
                                            echo "<td><a href=order_check.php?method=delete&order_id=$record[0]><button disabled>取消訂單</button></a></td>";
                                        }
                                            
                                            
                                      
                                      
                                        
                                        
                                    }
                                    
                                    
                                    mysqli_close($link);
                                ?>
                                </tr>
                            </tbody>
                        </table>
                    
                    </div>
                </section>

            </div>
            <?php include "footer.php" ?>
        </div>

        <?php include "index_bar.html" ?>

    </div>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        function changestyle(obj){
        //obj.className='current';
        // document.getElementById('ss').className="page active";
        obj.className="page active";
        }
    </script>
</body>

</html>
