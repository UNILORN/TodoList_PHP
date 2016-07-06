<?php
require __DIR__."/function.php";

if(!isset($_POST["name"])){
    $_POST["name"] = 0;
}
if(!isset($_POST["pass"])){
    $_POST["pass"] = 0;
}

$res = login_control($_POST["name"],$_POST["pass"]);

switch($res){
  case -1:echo "<p>name is not</p>";
    break;
  case 1:echo "<p>pass is not</p>";
    break;
  case 2:echo "<p>Thank you!!</p>";
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
    <form action="login.php" method="post">
      <input type="text" name="name" value="">
      <input type="password" name="pass" value="">
      <input type="submit" name="" value="送信">
    </form>
  </body>
</html>
