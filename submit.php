<!DOCTYPE html>
<html>
  <head>
    <?php
    require __DIR__."/function.php";
    $err = NULL;

    if(!empty($_POST["addtab"])){
      mb_regex_encoding("UTF-8");
      if(!preg_match("/^[a-zA-Z0-9ぁ-んァ-ヶー一-龠\ \_]+$/u",$_POST["addtab"])){
        $err =  "入力不可文字が入力されています";
      }
      else { $err = addgroups($_POST["addtab"],$_SESSION["id"]); }
    }

    if(!empty($_POST["deletetab"])){
      if(passwordcheck($_SESSION["id"],$_POST["deletetab"]) == 1){
        if(!empty($_SESSION["group"])){
          removegroups($_SESSION["id"],$_SESSION["group"]);
          $_SESSION["group"] = NULL;
        }
        else{ $err = "グループがありません"; }
      }
      else{ $err = "パスワードが一致しません"; }
    }

    if(!empty($_POST["addlist"])){
      mb_regex_encoding("UTF-8");
      if(!preg_match("/^[a-zA-Z0-9ぁ-んァ-ヶー一-龠\ \_]+$/u",$_POST["addlist"])){
        $err =  "入力不可文字が入力されています";
      }
      else { addlistdata($_SESSION["id"],$_SESSION["group"],$_POST["addlist"],$_POST["adddate"]); }
    }

    if(!empty($_GET["delete"])){
      deletelistdata($_GET["delete"]);
    }

    if(!empty($_POST["editlist"])){
      if(!preg_match("/^[a-zA-Z0-9\ \_]+$/",$_POST["addlist"])){
        $err =  "入力不可文字が入力されています";
      }
      else { editlistdata($_POST["editid"],$_POST["editlist"],$_POST["editdate"],$_SESSION["id"]); }
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
