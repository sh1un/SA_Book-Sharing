<?php
$link = mysqli_connect("localhost", "root" ,"12345678");
mysqli_query($link, "SET NAMES 'UTF8'");
mysqli_select_db($link, "sa");


?>
<!DOCTYPE HTML>

<html>

<head>
    <title>書籍共享平台</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <script>
        department = new Array();
        department[0] = [];
        department[1] = ["中正區", "萬華區", "大同區", "中山區", "松山區", "大安區", "信義區",
            "內湖區", "南港區", "士林區", "北投區", "文山區",
        ]; // 臺北市
        department[2] = ["仁愛區", "中正區", "信義區", "中山區", "安樂區", "七堵區", "暖暖區"]; // 基隆市
        department[3] = ["板橋區", "三重區", "中和區", "永和區", "新莊區", "新店區", "土城區",
            "蘆洲區", "樹林區", "汐止區", "鶯歌區", "三峽區", "淡水區", "瑞芳區", "五股區", "泰山區",
            "林口區", "深坑區", "石碇區", "坪林區", "三芝區", "石門區", "八里區", "平溪區", "雙溪區",
            "貢寮區", "金山區", "萬里區", "烏來區"
        ]; // 新北市
        department[4] = ["桃園區", "中壢區", "平鎮區", "八德區", "楊梅區", "蘆竹區", "大溪區",
            "龜山區", "大園區", "觀音區", "新屋區", "龍潭區", "復興區"
        ]; // 桃園市
        department[5] = ["東區", "北區", "香山區"];
        department[6] = ["竹北市", "竹東鎮", "新埔鎮", "關西鎮", "新豐鄉", "峨眉鄉", "寶山鄉",
            "五峰鄉", "橫山鄉", "北埔鄉", "尖石鄉", "芎林鄉", "湖口鄉"
        ];
        department[7] = ["苗栗市", "苑裡鎮", "通霄鎮", "竹南鎮", "頭份市", "後龍鎮", "卓蘭鎮",
            "大湖鄉", "公館鄉", "銅鑼鄉", "南庄鄉", "頭屋鄉", "三義鄉", "西湖鄉", "造橋鄉", "三灣鄉", "獅潭鄉", "泰安鄉"
        ];
        department[8] = ["中區", "東區", "西區", "南區", "北區", "西屯區", "南屯區", "北屯區",
            "豐原區", "大里區", "太平區", "清水區", "沙鹿區", "大甲區", "東勢區", "梧棲區", "烏日區", "神岡區",
            "大肚區", "大雅區", "后里區", "霧峰區", "潭子區", "龍井區", "外埔區", "和平區", "石岡區", "大安區", "新社區"
        ]; //台中市
        department[9] = ["彰化市", "員林市", "和美鎮", "鹿港鎮", "溪湖鎮", "二林鎮", "田中鎮", "北斗鎮",
            "花壇鄉", "芬園鄉", "大村鄉", "永靖鄉", "伸港鄉", "線西鄉", "福興鄉", "秀水鄉", "埔心鄉", "埔鹽鄉",
            "大城鄉", "芳苑鄉", "竹塘鄉", "社頭鄉", "二水鄉", "田尾鄉", "埤頭鄉", "溪州鄉"
        ];
        department[10] = ["南投市", "埔里鎮", "草屯鎮", "竹山鎮", "集集鎮", "名間鄉", "鹿谷鄉", "中寮鄉",
            "魚池鄉", "國姓鄉", "水里鄉", "仁愛鄉", "信義鄉"
        ];
        department[11] = ["麥寮鄉", "崙背鄉", "二崙鄉", "西螺鎮", "莿桐鄉", "林內鄉", "臺西鄉", "東勢鄉", "褒忠鄉",
            "元長鄉", "土庫鎮", "大埤鄉", "虎尾鎮", "斗六市", "斗南鎮", "古坑鄉", "四湖鄉", "口湖鄉", "水林鄉", "北港鎮"
        ];
        department[12] = ["太保市", "朴子市", "布袋鎮", "大林鎮", "民雄鄉", "溪口鄉", "新港鄉", "六腳鄉", "東石鄉",
            "義竹鄉", "鹿草鄉", "水上鄉", "中埔鄉", "竹崎鄉", "梅山鄉", "番路鄉", "大埔鄉", "阿里山鄉"
        ];
        department[13] = ["東區", "西區"];
        department[14] = ["中西區", "東區", "南區", "北區", "安平區", "安南區", "永康區", "歸仁區", "新化區", "左鎮區",
            "玉井區", "楠西區", "南化區", "仁德區", "關廟區", "龍崎區", "官田區", "麻豆區", "佳里區", "西港區", "七股區",
            "將軍區", "學甲區", "北門區", "新營區", "後壁區", "白河區", "東山區", "六甲區", "下營區", "柳營區", "鹽水區",
            "善化區", "大內區", "山上區", "新市區", "安定區"
        ];
        department[15] = ["楠梓區", "左營區", "鼓山區", "三民區", "鹽埕區", "前金區", "新興區", "苓雅區", "前鎮區",
            "小港區", "旗津區", "鳳山區", "大寮區", "鳥松區", "林園區", "仁武區", "大樹區", "大社區", "岡山區", "路竹區",
            "橋頭區", "梓官區", "彌陀區", "永安區", "燕巢區", "田寮區", "阿蓮區", "茄萣區", "湖內區", "旗山區", "美濃區",
            "內門區", "杉林區", "甲仙區", "六龜區", "茂林區", "桃源區", "那瑪夏區"
        ];
        department[16] = ["屏東市", "潮州鎮", "東港鎮", "恆春鎮", "萬丹鄉", "長治鄉", "麟洛鄉", "九如鄉", "里港鄉",
            "鹽埔鄉", "高樹鄉", "萬巒鄉", "內埔鄉", "竹田鄉", "新埤鄉", "枋寮鄉", "新園鄉", "崁頂鄉", "林邊鄉", "南州鄉",
            "佳冬鄉", "琉球鄉", "車城鄉", "滿州鄉", "枋山鄉", "霧台鄉", "瑪家鄉", "泰武鄉", "來義鄉", "春日鄉", "獅子鄉", "牡丹鄉", "三地門鄉"
        ];
        department[17] = ["宜蘭市", "羅東鎮", "蘇澳鎮", "頭城鎮", "礁溪鄉", "壯圍鄉", "員山鄉", "冬山鄉", "五結鄉", "三星鄉", "大同鄉", "南澳鄉"];
        department[18] = ["花蓮市", "鳳林鎮", "玉里鎮", "新城鄉", "吉安鄉", "壽豐鄉", "秀林鄉", "光復鄉", "豐濱鄉",
            "瑞穗鄉", "萬榮鄉", "富里鄉", "卓溪鄉"
        ];
        department[19] = ["臺東市", "成功鎮", "關山鎮", "長濱鄉", "海端鄉", "池上鄉", "東河鄉", "鹿野鄉", "延平鄉",
            "卑南鄉", "金峰鄉", "大武鄉", "達仁鄉", "綠島鄉", "蘭嶼鄉", "太麻里鄉"
        ];
        department[20] = ["馬公市", "湖西鄉", "白沙鄉", "西嶼鄉", "望安鄉", "七美鄉"];
        department[21] = ["金城鎮", "金湖鎮", "金沙鎮", "金寧鄉", "烈嶼鄉", "烏坵鄉"];
        department[22] = ["南竿鄉", "北竿鄉", "莒光鄉", "東引鄉"];

        function renew(index) {
            for (var i = 0; i < department[index].length; i++)
                document.a.udaddress.options[i] = new Option(department[index][i], department[index][i]); // 設定新選項
        }
    </script>
</head>

<body class="is-preload">

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Main -->
        <div id="main">
            <div class="inner">

                <!-- Header -->
                <header id="header">
                    <h2>編輯帳號</h2>
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
                
                <!-- Banner -->
                <section id="banner">
                    <div class="content">
                        <form name = "a" action="update_check.php" method="POST">
                            <table>
                                <tr>
                                    <td>
                                        <h3>修改資料</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="150px">使用者名稱</td>
                                    <td><input type="text" class="input_box" value=<?php echo $_POST['name']; ?> name="udname" required></td>
                                </tr>
                                <tr>
                                    <td>帳號</td>
                                    <td><?php echo $_POST['account']; ?></td>
                                </tr>
                                
                                <tr>
                                    <td>電子信箱</td>
                                    <td><input type="text" class="input_box" value=<?php echo $_POST['email']; ?> name="udemail" required></td>
                                </tr>
                                <tr>
                                    <td>生日</td>
                                    <td><input type="date" class="input_box" value=<?php echo $_POST['birth']; ?> name="udbirth" required></td>
                                </tr>
                                <tr>
                                    <td>居住區域</td>
                                    <td><select name="udarea" onChange="renew(this.selectedIndex)" required>
                                            <option selected="selected" disabled><?php echo $_POST['area']; ?>
                                            <option value="臺北市">臺北市
                                            <option value="基隆市">基隆市
                                            <option value="新北市">新北市
                                            <option value="桃園市">桃園市
                                            <option value="新竹市">新竹市
                                            <option value="新竹縣">新竹縣
                                            <option value="苗栗縣">苗栗縣
                                            <option vlaue="臺中市">臺中市
                                            <option value="彰化縣">彰化縣
                                            <option value="南投縣">南投縣
                                            <option value="雲林縣">雲林縣
                                            <option vlaue="嘉義縣">嘉義縣
                                            <option value="嘉義市">嘉義市
                                            <option value="臺南市">臺南市
                                            <option value="高雄市">高雄市
                                            <option vlaue="屏東縣">屏東縣
                                            <option value="宜蘭縣">宜蘭縣
                                            <option value="花蓮縣">花蓮縣
                                            <option value="臺東縣">臺東縣
                                            <option value="澎湖縣">澎湖縣
                                            <option value="金門縣">金門縣
                                            <option value="連江縣">連江縣
                                        </select>
                                        <select name="udaddress" value="<?php echo $_POST['address']; ?>" required>
                                            <option value="<?php echo $_POST['address']; ?>" disabled>請先選擇行政區域
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>性別</td>
                                    <td>
                                        <input type="radio" name="udgender" id="r1" value="female"><label for="r1">女</label>
                                        <input type="radio" name="udgender" id="r2" value="male"><label for="r2">男</label><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>聯絡方式</td>
                                    <td>
                                        <input type="text" value=<?php echo $_POST['con'];?> name="udcon">
                                    </td>
                                </tr>
                            </table>
                            <div align="center">
                                <input type="submit" class="input_btn" value="確認修改"><br>
                            </div>
                        </form>
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

</body>

</html>
