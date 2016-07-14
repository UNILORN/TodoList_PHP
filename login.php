<?php
require __DIR__."/function.php";

if(!empty($_SESSION["id"])){
  header('location:top.php');
  exit;
}
if(!isset($_POST["name"])){
    $_POST["name"] = 0;
}
if(!isset($_POST["pass"])){
    $_POST["pass"] = 0;
}
if(!preg_match("/^[a-zA-Z0-9\ \_]+$/",$_POST["name"])){
  echo "その文字は使用できません";
  exit;
}
$res = login_control($_POST["name"],$_POST["pass"]);

switch($res){
  case -1:echo "<p>name is not</p>";
    break;
  case 1:echo "<p>pass is not</p>";
    break;
  case 2:
    $_SESSION["id"] = $_POST["name"];
    header('location:top.php');
    exit;
    break;
}

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>login</title>
  </head>
  <body>

    <a href="top.php">Main</a>
    <a href="index.php">TOP</a>
    <form action="login.php" method="post">
      <p>
        ID
        <input required type="text" name="name" value="">
      </p>
      <p>
        PASS
        <input required type="password" name="pass" value="">
      </p>
      <input type="submit" name="" value="送信">
    </form>
  </body>
</html>
