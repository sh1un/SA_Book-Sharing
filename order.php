<?php
session_start();
if (isset($_SESSION['name'])) {
    $name = $_SESSION['name'];
    $account = $_SESSION['account'];
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
    <title>書籍共享-已上架書籍</title>
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
                   
                </header>



                <!-- 書單 -->
                <!-- 點圖片到書籍資訊頁面 -->
                <section>
                    <header class="major">
                        <h2>訂單列表</h2>
                    </header>
                    <?php
                        $searchtxt = $_GET["searchtxt"]
                    ?>
                    <form method="get" action="">
                            <input type="text" name="searchtxt" value="<?php echo $searchtxt ?>"  placeholder="輸入關鍵字" />
                        </form>
                    <div class="posts">
                    
                        <table>
                            <thead>
                                <tr>
                                    <th>訂單編號</th>
                                    <th>書名</th>
                                    <th>捐借者名稱</th>
                                    <th>租借者名稱</th>
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
                                    $sql="select * from orderlist where book_owner like '$name' or book_user like '$name' ";
                                    }
                                    else
                                    {
                                    $sql="select * from orderlist where order_id like '%$searchtxt%' or book_name like '%$searchtxt%' or book_owner like '$searchtxt' or book_user like '$searchtxt' or order_time like '$searchtxt' or return_time like '$searchtxt' ";
                                    }
                                    
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
                                            
                                            
                                            
                                            <td><a href=order_check.php?method=update&order_id=$record[0]><button>完成訂單</button></a></td>
                                            
                                            <td><button>取消訂單</button></td>
                                            ";
                                      
                                      
                                        
                                        
                                    }
                                    
                                    
                                    mysqli_close($link);
                                ?>
                                </tr>
                            </tbody>
                        </table>
                    
                    </div>
                </section>

            </div>
        </div>

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