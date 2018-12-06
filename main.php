<?php
    session_start();
    ini_set( 'display_errors', 1 );
    ini_set( 'error_reporting', E_ALL );

    //他ページへの移動用リンク
    $login_Page = "index.php";
    $twitter_page ="https://twitter.com/dokodemoremote/";
    $camera_page ="camera.html";

    //ログインしないと移動される
    if(!isset($_SESSION["user_name"])) {
        header("Location: {$login_Page}");
        exit;
    }
?>
<!DOCTYPE html>
<head>
  <title>どこでもリモコン(仮)</title>
  <link rel="stylesheet" type="text/css" href="page_main.css" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

  <meta name="viewport" content="width=device-width,initial-scale=1">
  <!--スマホ画面切り替え-->
  <script src="mode.js"></script>
</head>
<body>
    <div id="links">
        <form method="POST" action="">
            <input type="submit" class="logout_btn" value="ログアウト" name="logout">
            <input type="submit" class="remote_btn" value="リモコン確認画面" name="remote">
        </form>
    </div>
    <?php
        if (isset($_POST["logout"])) {
            // セッションの値を初期化
            $_SESSION = array();
            // セッションを破棄
            session_destroy();
            //ログインページに飛ばす
            header("Location: {$login_Page}");
        }
    ?>
    <?php
        if (isset($_POST["remote"])) {
            //カメラ画面に飛ばす
            header("Location: {$camera_page}");
        }
    ?>
<span id="morterbtn">
    <?php
        if (isset($_POST["bt1"])) {
            /*ここにsystem関数を入れる*/
        }
    ?>
        <form method="POST" action="">
            <input type="submit" class="btn" value="モーター" name="bt1">
        </form>
    </span>
    </br>

<!--ここからGoogleGlaph-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <div id="chart_div"></div>
    <script>
        google.charts.load('current', {packages: ['corechart', 'line']});
        google.charts.setOnLoadCallback(drawCurveTypes);
        function drawCurveTypes() {
            var data = google.visualization.arrayToDataTable([
            ['年月日時', '気温', '湿度'],
                <?php
                    // DBに接続
                    $db = new PDO('mysql:host=localhost;dbname=anabuki07','root');
                    // SQL文
                            $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                    //DB問い合わせ　[mesh]テーブルから[time][temp][humi]取ってくる
                    $sql = ('SELECT DISTINCT mesh.time, mesh.temp, mesh.humi 
                                FROM mesh'
                    );
                    // クエリ
                    $stmt = $db->query($sql);
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    // 行の長さ取得
                    $length = $stmt->rowCount();
                    // カウント
                    $no = 0;
                    foreach ($result as $value) {
                        echo '['. "'" .$value["time"]."'".',' .$value["temp"].',' .$value["humi"]. ']';
                        $no++;
                        if ($no !== $length) {
                            echo ",\n";
                        }
                    }
                ?>
            ]);
            var options = {
                hAxis: {title: '時間'},
                vAxis: {title: '数値'},
                series: {1: {curveType: 'function'}},
				chartArea: {width: '70%',height:'100%'}
            };
        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</body>
    <p>要望はツイッターのDMにお送りください</p>
   <div id="links"> 
    <a href =<?php echo "$twitter_page" ?> class="twitter_btn" target="_blank">ツイッター</a>
    </div>
    </html>
