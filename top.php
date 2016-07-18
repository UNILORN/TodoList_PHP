<?php
require __DIR__."/function.php";
if (empty($_SESSION["id"])){  header('location:login.php');  exit; }
else {  $id = $_SESSION["id"]; }
if (empty($_SESSION["group"])){ $groupname = firstgroup($id);}
else {  $groupname = $_SESSION["group"]; }
// groupの有無（ NULL = 無し）
if(!empty($groupname)){
  if(!empty($_GET["tname"])){
    $groupname = $_GET["tname"];
  }
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
        // groupが存在するとき
        if(!empty($groupname)){
          $gropudata = selectgroupdata($id);
          foreach ($gropudata as $key => $value) {
            if($value["name"] == $groupname){
              echo '<li role="presentation" class="active"><a href="top.php?tname='.$value["name"].'">'.$value["name"].'</a></li>';
            }
            else{
              echo '<li role="presentation"><a href="top.php?tname='.$value["name"].'">'.$value["name"].'</a></li>';
            }
          }
        }
        ?>

      </ul>

      <ul class="nav nav-tabs navbar-right">
        <li role="presentation" class="dropdown"  style="float:right;">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            TabMenu<span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
              <li><button style="width:100%;" type="button" class="btn btn-success" data-toggle="modal" data-target="#AddModal">Add Tab</button></li>
              <li><button style="width:100%;" type="button" class="btn btn-warning" data-toggle="modal" data-target="#DeleteModal">Delete Tab</button></li>
              <li role="separator" class="divider"></li>
              <li><button style="width:100%;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#DeletedataModal">Delete Tab in All Data</button></li>
          </ul>
        </li>
      </ul>
    </div>

    <button style="width:100%;" type="button" class="btn btn-success" data-toggle="modal" data-target="#AddlistModal">Add list</button>
    <!-- Modal Window -->
    <!-- Add Modal -->
    <div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add Tab</h4>
          </div>
          <form action="submit.php" method="post">
            <div class="modal-body">
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon2">Enter the name</span>
                <input required type="text" class="form-control" name="addtab" value="">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary" value="Create tabs">
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Delete Modal -->
    <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Delete Tab in All Delete</h4>
          </div>
          <form action="submit.php" method="post">
            <div class="modal-body">
              <p style="color:red">Warning : Erase the data stored in the tab all</p>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon2">Password check</span>
                <input required type="password" class="form-control" name="deletetab" value="">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-danger" value="Delete tabs">
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Delete Data Modal -->
    <div class="modal fade" id="DeletedataModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Delete Tab in All Data</h4>
          </div>
          <form action="submit.php" method="post">
            <div class="modal-body">
              <p style="color:red">Warning : Erase the data stored in the tab all</p>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon2">Password check</span>
                <input required type="password" class="form-control" name="deletedatatab" value="">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-danger" value="Delete tabs">
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Add list Modal -->
    <div class="modal fade" id="AddlistModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add List Data</h4>
          </div>
          <form action="submit.php" method="post">
            <div class="modal-body">
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon2">Enter the name</span>
                <input required type="text" class="form-control" name="addlist" value="">
              </div>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon2">Date Time</span>
                <input type="datetime-local" class="form-control" name="adddate" value="">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary" value="Add list">
            </div>
          </form>
        </div>
      </div>
    </div>


    <table class="table table-striped">
      <tr>
        <th style="width:40px;">id</th>
        <th>data</th>
        <th style="width:300px;">time</th>
        <th style="width:100px;">Del</th>
      </tr>

      <?php
      if(empty($groupname)){
        echo "<tr><td></td><td>###グループが存在しません　グループを作成してください###</td><td></td><td></td></tr>";
      }
      else{
        $data = selectlistdata($_SESSION["id"],$_SESSION["group"]);
        foreach ($data as $key => $value) {
          echo "<tr>";
          foreach ($data[$key] as $key2 => $value2) {
            echo "<td>$value2</td>";
            if ($key2 >= 3) { break; }
          }
          echo '<td></td>';
          echo "</tr>";
        }
      }
       ?>
    </table>
  </body>
</html>
