<?php
//
// navbar
//
//  li  = Login
//  lo  = Logout
//  s   = Signup
//

function navbar($data){
  $li = '<li style="float:left;"><a href="login.php">login</a></li>';
  $lo = '<li style="float:left;"><a href="logout.php">logout</a></li>';
  $s  = '<li style="float:left;"><a href="signup.php">signup</a></li>';
  $html = ' <nav class="nav navber navbar-inverse navbar-fixed-top">
              <div class="container-fluid">
                <ul class="nav navber-nav navbar-left">
                  <li><a href="index.php">TOPpage</a></li>
                </ul>
                <ul class="nav navber-nav navbar-right">';
  if(!empty($_SESSION["id"])){
    $html .= '<li style="float:left;"><a href="top.php">name : '.$_SESSION["id"].'</a></li>';
  }
  foreach ($data as $value) {
    switch ($value) {
      case "s":
        $html .= $s;
        break;
      case "li":
        if(empty($_SESSION["id"])){
          $html .= $li;
        }
        break;
      case "lo":
        $html .= $lo;
        break;
      default:
        break;
    }
  }
  $html .= '    </ul>

              </div>
            </nav>';
return $html;
}

function head(){
  echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css" media="screen" title="no title" charset="utf-8">';
}

function Edithtml($id){
  echo '
  <div class="modal fade" id="EditlistModal'.$id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Edit List Data</h4>
        </div>
        <form action="submit.php" method="post">
        <input type="hidden" name="editid" value="'.$id.'">
          <div class="modal-body">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon2">Enter the name</span>
              <input required type="text" class="form-control" name="editlist" value="">
            </div>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon2">Date Time</span>
              <input type="datetime-local" class="form-control" name="editdate" value="">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" value="Editlist">
          </div>
        </form>
      </div>
    </div>
  </div>
  ';
}

 ?>
