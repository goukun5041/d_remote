<?php
  session_start();
  
  if($error_message) {
    echo $error_message;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="index_css.css" />
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--スマホ画面切り替え-->
    <script src="mode.js"></script>
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>どこでもリモコン</title>
</head>
<body>
  <center>
ID:root / Pass:root
  <div id="form">
    <form action="index.php" method="POST" class="form">
      <p>ログインID</p>
      <pclass="loginID"><input type="text" name="user_name"></p>
      <p>password</p>
      <p class="pass"><input type="password" name="password"></p>
      <p class="submit"><input type="submit" class="login_btn" name="login" value="ログイン">
    </form>
  </center>
</body>
</html>

<?php
  $error_message = "";
  //DBでユーザーネームとパスワードを確認する
  if(isset($_POST["login"])) {
    if($_POST["user_name"] == "root" && $_POST["password"] == "root") {
      $_SESSION["user_name"] = $_POST["user_name"];
      $login_success_url = "main.php";
      header("Location: {$login_success_url}");
      exit;
    }
  $error_message = "※ID、もしくはパスワードが間違っています。<br>　もう一度入力して下さい。";
  }
?>