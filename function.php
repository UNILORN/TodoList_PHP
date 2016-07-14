<?php
session_start();

function usernamedecode($name){
  $dns = "mysql:host=127.0.0.1;dbname=todo_php;charset=utf8";
  $pdo = new PDO($dns,"root","shr850");
  $sql = "select id from user where name='$name';";
  $stmh = $pdo -> prepare($sql);
  $stmh->execute();
  $userdata = $stmh->fetch(PDO::FETCH_ASSOC);
  return $userdata["id"];
}

function groupnamedecode($userid,$groups){
  $dns = "mysql:host=127.0.0.1;dbname=todo_php;charset=utf8";
  $pdo = new PDO($dns,"root","shr850");
  $sql = "select * from group where name='test';";
  $stmh = $pdo -> prepare($sql);
  $stmh->execute();
  $groupdata = ($stmh->fetch(PDO::FETCH_ASSOC));
  var_dump($groupdata["id"]);
  return $groupdata["id"];
}

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

  try {
    $pdo = new PDO($dns,"root","shr850");
    $sql = "select name from user where name='$name';";
    $stmh = $pdo -> prepare($sql);
    $stmh->execute();
    $count = $stmh->rowCount();
    if($count >= 1){
      echo "そのＩＤはすでに存在しています";
    }

    $sql = "insert into user (name,pass,email) values('$name','$pass','$email')";
    $stmh = $pdo -> prepare($sql);
    $stmh->execute();

    if($count <= 0){
      $_SESSION["id"] = $name;
      header('location:top.php');
    }
  } catch (PDOException $err) {
      echo $err->getMessage();
    die();
  }
}

function selectlistdata($name,$groups){
  $dns = "mysql:host=127.0.0.1;dbname=todo_php;charset=utf8";
  $pdo = new PDO($dns,"root","shr850");
  //user_id を抽出する
  $userid = usernamedecode($name);
  //group_id　を抽出する
  $groupid = groupnamedecode($userid,$groups);


  echo "<br>";
  var_dump($groups);

  $sql = "select * from task where name='$name' and group_id='$groupid';";
  $stmh = $pdo -> prepare($sql);
  $stmh->execute();
  $count = $stmh->rowCount();
  $data = [];

  for ($i = 0;$i < $count;$i++){
    $data[] = ($stmh->fetch(PDO::FETCH_ASSOC));
  }
  return $data;
}

function addgroups($name){

}

function removegroups($name,$groups){

}

function addlistdata($name,$groups,$data){

}


 ?>
