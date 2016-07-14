<?php
require __DIR__."/function.php";


$groups = -1;


if(empty($_SESSION["id"])){
  header('location:login.php');
  exit;
}
else{
  $id = $_SESSION["id"];
}

 ?>

<!DOCTYPE html>
<html>
  <head>
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <title>mainview</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </head>
  <body>
    <a href="logout.php">logout</a>
    <ul class="nav nav-tabs">
      <li role="presentation" class="active"><a href="#">Tab1</a></li>
      <li role="presentation" ><a href="#">Tab2</a></li>
      <li role="presentation" ><a href="#">Tab3</a></li>
    </ul>
    <table class="table table-striped">
      <tr>
        <td>id</td>
        <td>data</td>
        <td>time</td>
      </tr>
      <tr>
        <td>-1</td>
        <td>testdata</td>
        <td>2000/00/00</td>
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
