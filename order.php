

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">訂貨專區</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">首頁</a></li>
                            <li class="breadcrumb-item active">訂貨專區</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                店內庫存
                                <div class="row justify-content-end">
                                <form class="col-lg-4 col-md-6" role="search" method="get" action="order1.php" target="_blank">
                                    
                                    <button type="submit" class="btn btn-primary" href="insert.php" style="float:right">訂貨</button>
                                    
                                </form>
                            </div>
                            </div>
                            <div class="card-body">
                            <table id="datatablesSimple" class="table table-striped table-bordered" style="width:100%">
                                
                                <?php
                                    $connection=mysqli_connect("sa0901.c8wn5lwjlmlv.ap-northeast-1.rds.amazonaws.com", "admin", "danny91113");
                                    $database=mysqli_select_db($connection, "五大");
                                    $sql="select * From `order`";

                                    if($rs =mysqli_query($connection, $sql)){
                                        echo "hi";
                                    }else{
                                        echo "1";
                                    }

                                    while ($record=mysqli_fetch_row($rs)){
                                        echo "<tr><td>$record[0]</td><td>$record[1]</td><td>$record[2]</td><td>$record[3]</td><td>$record[4]</td>";
                                        echo "<td><a href=index.php?method=update&ord_id=$record[0]>[修改]</a> </td><td><a href=index.php?method=delete&ord_id=$record[0]>[刪除]</a></td><td><a href=index.php?method=detail&ord_id=$record[0]>[詳細資訊]</a></td></tr>";
                                    }

                                    mysqli_close($connection);
                                ?>

                                <thead>
                                    <tr>
                                        <th>產品編號</th>
                                        <th>產品名稱</th>
                                        <th>產品種類</th>
                                        <th>庫存數量</th>
                                        <th>藝人編號</th>
                                        <th>產品價格(單價淨價)</th>
                                        <th>進貨時間</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>產品編號</th>
                                        <th>產品名稱</th>
                                        <th>產品種類</th>
                                        <th>庫存數量</th>
                                        <th>藝人編號</th>
                                        <th>產品價格(單價淨價)</th>
                                        <th>進貨時間</th>
                                    </tr>
                                </tfoot>
                            </table>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
