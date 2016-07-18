<?php
require __DIR__."/function.php";
if (empty($_SESSION["id"])){  header('location:login.php');  exit; }
else {  $id = $_SESSION["id"]; }
if (empty($_SESSION["group"])){ $groupname = firstgroup($id);}
else {  $groupname = $_SESSION["group"]; }
if(!empty($_GET["tname"])){
  $groupname = $_GET["tname"];
  $_SESSION["group"] = $groupname;
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <title>Mainview</title>
    <?php head(); ?>
  </head>
  <body>

    <?php echo navbar(array("lo"));  ?>

    <div class="nav nav-tabs container-fluid">

      <ul class="nav nav-tabs navbar-left">
        <?php
        $gropudata = selectgroupdata($id);
        foreach ($gropudata as $key => $value) {
          if($value["name"] == $groupname){
            echo '<li role="presentation" class="active"><a href="top.php?tname='.$value["name"].'">'.$value["name"].'</a></li>';
          }
          else{
            echo '<li role="presentation"><a href="top.php?tname='.$value["name"].'">'.$value["name"].'</a></li>';
          }
        }
        ?>

      </ul>

      <ul class="nav nav-tabs navbar-right">
        <li role="presentation" class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            TabMenu<span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
              <li><a href="submit.php?tab=0">Addtab</a></li>
              <li><a href="#">Deletetab</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">Delete data</a></li>
          </ul>
        </li>
      </ul>
    </div>

    <table class="table table-striped">
      <tr>
        <th>id</th>
        <th>data</th>
        <th>time</th>
      </tr>

      <?php
      $data = selectlistdata($_SESSION["id"],$_SESSION["group"]);
      foreach ($data as $key => $value) {
        echo "<tr>";
        foreach ($data[$key] as $key2 => $value2) {
          echo "<td>$value2</td>";
          if ($key2 >= 3) { break; }
        }
        echo "</tr>";
      }
       ?>
    </table>
  </body>
</html>
