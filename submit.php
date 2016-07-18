<!DOCTYPE html>
<html>
  <head>
    <?php
    require __DIR__."/function.php";
    $err = NULL;

    if(!empty($_POST["addtab"])){
      addgroups($_POST["addtab"],$_SESSION["id"]);
    }

    if(!empty($_POST["deletetab"])){
      if(passwordcheck($_SESSION["id"],$_POST["deletetab"]) == 1){
        if(!empty($_SESSION["group"])){
          removegroups($_SESSION["id"],$_SESSION["group"]);
        }
        else{ $err = "グループがありません"; }
      }
      else{ $err = "パスワードが一致しません"; }
    }

    if(!empty($_POST["addlist"])){
      if(!empty($_POST["adddate"])){
        addlistdata($_SESSION["id"],$_SESSION["group"],$_POST["addlist"],$_POST["adddate"]);
      }
    }

    if(empty($err)){ header('location:top.php'); }
    else { echo '<meta http-equiv="refresh" content="2;URL=top.php"';}
    ?>
    <meta charset="utf-8">
    <title>Submit</title>
  </head>
  <body>
    <?php
    if(!empty($err)){ echo '<p style="color:red;font-size:20px;"><b>'.$err.'</b><p><p>自動的に前のページに戻ります。</p>'; }
     ?>

  </body>
</html>
