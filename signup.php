<?php
require __DIR__."/function.php";

if(!empty($_SESSION["id"])){
  header('location:top.php');
  exit;
}

if(!empty($_POST["name"]) || !empty($_POST["pass"])){
  if(!preg_match("/^[a-zA-Z0-9\ \_]+$/",$_POST["name"])){
    exit;
  }
  $message = signup_control($_POST["name"],$_POST["pass"],$_POST["email"]);
}

 ?>
<!DOCTYPE html>
<html>
  <head>
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <title>Signup</title>
    <?php head(); ?>
  </head>
  <body>
        <?php echo navbar(array("li"));  ?>

    <form class="" action="signup.php" method="post">
      <p>ID<input required type="text" name="name" value=""></p>
      <p>PASS<input required type="password" name="pass" value=""></p>
      <p>email<input required type="email" name="email" value=""></p>
      <input type="submit" name="" value="送信">
    </form>
    <p>

    </p>

  </body>
</html>
