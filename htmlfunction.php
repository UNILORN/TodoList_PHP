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
  foreach ($data as $value) {
    switch ($value) {
      case "s":
        $html .= $s;
        break;
      case "li":
        $html .= $li;
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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css" media="screen" title="no title" charset="utf-8">';
}
 ?>
