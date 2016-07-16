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

      <div class="dropdown">
        <a class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          <i class="material-icons">list</i>
          <span class="caret"></span>
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
          <li><a href="#"><button type="button" class="btn btn-danger" name="button">Clear the current tab</button></a></li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li role="separator" class="divider"></li>
          <li><a href="#">Separated link</a></li>
        </ul>
      </div>

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
