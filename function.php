<?php
function login_control($name,$pass){
  $dns = "mysql:host=127.0.0.1;dbname=todo_php;charset=utf8";
  $pdo = new PDO($dns,"root","shr850");

  $sql = "select * from user where name = '$name'";
  $stmh = $pdo -> prepare($sql);
  $stmh->execute();
  $datalist = ($stmh->fetch(PDO::FETCH_ASSOC));

  if (!isset($datalist["name"])){
    return -1;
  }
  else {
      if($datalist["pass"]==$pass) { return 2; }
      else { return 1; }
  }
}

function signup_control($name,$pass,$email){
  $dns = "mysql:host=127.0.0.1;dbname=todo_php;charset=utf8";
  $pdo = new PDO($dns,"root","shr850");

  $sql = "insert into user ('name','pass','email') values('$name','$pass','$email')";
  $stmh = $pdo -> prepare($sql);
  $stmh->execute();
}
 ?>
