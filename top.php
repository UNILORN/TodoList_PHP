<?php
require __DIR__."/function.php";
if(empty($_SESSION["id"])){  header('location:login.php');  exit; }
else{  $id = $_SESSION["id"]; }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <title>mainview</title>
    <?php head(); ?>
  </head>
  <body>

    <?php echo navbar(array("lo"));  ?>

    <ul class="nav nav-tabs">

      <?php
      $active = ' class="active"';


       ?>
      <li role="presentation" class="active"><a href="#">Tab1</a></li>
      <li role="presentation" ><a href="#">Tab2</a></li>
      <li role="presentation" ><a href="#">Tab3</a></li>
    </ul>
    <table class="table table-striped">
      <tr>
        <th>id</th>
        <th>data</th>
        <th>time</th>
      </tr>
      <?php
      $data = selectlistdata($_SESSION["id"],"test");
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
