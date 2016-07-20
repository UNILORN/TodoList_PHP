<?php
require __DIR__."/htmlfunction.php";
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
  $sql = "select id from `group` where user_id='$userid' and name='$groups';";
  $stmh = $pdo -> prepare($sql);
  $stmh->execute();
  $groupdata = $stmh->fetch(PDO::FETCH_ASSOC);
  return $groupdata["id"];
}
function groupnameencode($groups){
  $dns = "mysql:host=127.0.0.1;dbname=todo_php;charset=utf8";
  $pdo = new PDO($dns,"root","shr850");
  $sql = "select name from `group` where id='$groups';";
  $stmh = $pdo -> prepare($sql);
  $stmh->execute();
  $groupdata = $stmh->fetch(PDO::FETCH_ASSOC);
  return $groupdata["name"];
}

function passwordcheck($name,$pass){
  $dns = "mysql:host=127.0.0.1;dbname=todo_php;charset=utf8";
  $pdo = new PDO($dns,"root","shr850");
  $sql = "select * from user where name = '$name'";
  $stmh = $pdo -> prepare($sql);
  $stmh->execute();
  $datalist = ($stmh->fetch(PDO::FETCH_ASSOC));
  if($datalist["pass"]==$pass) { return 1; }
  else { return 0; }
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
    //idがヒットすれば
    if($count >= 1){
      echo "そのＩＤはすでに存在しています";
    }

    $sql = "insert into user (name,pass,email) values('$name','$pass','$email')";
    $stmh = $pdo -> prepare($sql);
    $stmh->execute();
    // idがヒットしない場合
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
  //user_id を抽出する
  $userid = usernamedecode($name);
  //group_id　を抽出する
  $groupid = groupnamedecode($userid,$groups);

  $dns = "mysql:host=127.0.0.1;dbname=todo_php;charset=utf8";
  $pdo = new PDO($dns,"root","shr850");
  $sql = "select * from task where user_id='$userid' and group_id='$groupid';";
  $stmh = $pdo -> prepare($sql);
  $stmh->execute();
  $count = $stmh->rowCount();
  $data = [];

  for ($i = 0;$i < $count;$i++){
    $data[] = ($stmh->fetch(PDO::FETCH_ASSOC));
    // 項目の"user_id"と"group_id"が必要ないのでこの時点で消去
    unset($data[$i]["user_id"],$data[$i]["group_id"]);
  }
  return $data;
}

function selectgroupdata($name){
  //user_id を抽出
  $userid = usernamedecode($name);

  $dns = "mysql:host=127.0.0.1;dbname=todo_php;charset=utf8";
  $pdo = new PDO($dns,"root","shr850");
  $sql = "select name from `group` where user_id='$userid';";
  $stmh = $pdo -> prepare($sql);
  $stmh->execute();
  $count = $stmh->rowCount();
  $data = [];

  for ($i = 0;$i < $count;$i++){
    $data[] = ($stmh->fetch(PDO::FETCH_ASSOC));
  }
  return $data;
}

function addgroups($name,$username){
  //user_id を抽出
  $userid = usernamedecode($username);

  $dns = "mysql:host=127.0.0.1;dbname=todo_php;charset=utf8";
  $pdo = new PDO($dns,"root","shr850");

  $sql = "select * from `group` where user_id = '$userid' and name = '$name';";
  $stmh = $pdo -> prepare($sql);
  $stmh->execute();
  $count = $stmh->rowCount();
  if($count <=0){
    $sql = "insert into `group` (name,user_id) values('".mb_convert_encoding($name,'UTF-8')."','$userid');";
    $stmh = $pdo -> prepare($sql);
    $stmh->execute();
    return NULL;
  }
  else{
    return "グループ名が重複しています。";
  }
}

function removegroups($username,$groups){
  $userid = usernamedecode($username);
  $groupid = groupnamedecode($userid,$groups);
  $dns = "mysql:host=127.0.0.1;dbname=todo_php;charset=utf8";
  $pdo = new PDO($dns,"root","shr850");
  $sql = "delete from task where user_id = '$userid' and group_id = '$groupid';";
  $stmh = $pdo -> prepare($sql);
  $stmh->execute();

  $sql = "delete from `group` where user_id = '$userid' and id = '$groupid';";
  $stmh = $pdo -> prepare($sql);
  $stmh->execute();

}

function addlistdata($name,$groups,$data,$date){
  $userid = usernamedecode($name);
  $groupid = groupnamedecode($userid,$groups);
  $dns = "mysql:host=127.0.0.1;dbname=todo_php;charset=utf8";
  $pdo = new PDO($dns,"root","shr850");
  if(!empty($date)){
    $sql = "insert into `task` (name,time,user_id,group_id) values ('".mb_convert_encoding($data,'UTF-8')."','$date','$userid','$groupid');";
  }
  else{
    $sql = "insert into `task` (name,user_id,group_id) values ('".mb_convert_encoding($data,'UTF-8')."','$userid','$groupid');";
  }
  $stmh = $pdo -> prepare($sql);
  $stmh->execute();
}

function editlistdata($dataid,$data,$date,$name){
  $userid = usernamedecode($name);
  $dns = "mysql:host=127.0.0.1;dbname=todo_php;charset=utf8";
  $pdo = new PDO($dns,"root","shr850");
  if(!empty($date)){
    $sql = "update `task` set name= '".mb_convert_encoding($data,'UTF-8')."',time='$date' where id = '$dataid' and user_id='$userid';";
  }
  else{
    $sql = "update `task` set name= '".mb_convert_encoding($data,'UTF-8')."' where id = '$dataid' and user_id='$userid';";
  }
  $stmh = $pdo -> prepare($sql);
  $stmh->execute();
}

function deletelistdata($dataid){
  $dns = "mysql:host=127.0.0.1;dbname=todo_php;charset=utf8";
  $pdo = new PDO($dns,"root","shr850");
  $sql = "delete from `task` where id = '$dataid';";
  $stmh = $pdo -> prepare($sql);
  $stmh->execute();
}

function firstgroup($name){
  $userid = usernamedecode($name);
  $dns = "mysql:host=127.0.0.1;dbname=todo_php;charset=utf8";
  $pdo = new PDO($dns,"root","shr850");
  $sql = "select name from `group` where user_id='$userid';";
  $stmh = $pdo -> prepare($sql);
  $stmh->execute();
  $data = ($stmh->fetch(PDO::FETCH_ASSOC));
  return $data["name"];
}

function searchlist($name,$data){
  $userid = usernamedecode($name);
  $dns = "mysql:host=127.0.0.1;dbname=todo_php;charset=utf8";
  $pdo = new PDO($dns,"root","shr850");
  $strcnt = strpos($data,'-');
  if($strcnt !== false){
    switch($strcnt){
      case 2:
      $sqlstr = "substring(`time`,6,".strlen($data).")";
      break;
      case 4:
      $sqlstr = "substring(`time`,1,".strlen($data).")";
      break;
      default:
      $sqlstr = "substring(`time`,1,".strlen($data).")";
      break;
    }
    $sql = "select id,name,time,group_id from `task` where user_id='$userid' and  $sqlstr = '$data';";
  }
  else{
    $strcnt = strpos($data,':');
    if($strcnt !== false){
      $sqlstr = "substring(`time`,12,".strlen($data).")";
      $sql = "select id,name,time,group_id from `task` where user_id='$userid' and  $sqlstr = '$data';";
    }
    else{
      $sql = "select id,name,time,group_id from `task` where user_id='$userid' and  (substring(`name`,1,".mb_strlen(mb_convert_encoding($data,'UTF-8')).") = '".mb_convert_encoding($data,'UTF-8')."' or substring(`time`,1,".strlen($data).") = '$data');";
    }
  }
  $stmh = $pdo -> prepare($sql);
  $stmh->execute();
  $count = $stmh->rowCount();
  $datalist = [];

  for ($i = 0;$i < $count;$i++){
    $datalist[] = ($stmh->fetch(PDO::FETCH_ASSOC));
  }
  return $datalist;
}

 ?>
