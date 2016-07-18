<?php
require __DIR__."/function.php";


 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <title>toppage</title>
    <?php head(); ?>
  </head>
  <body>
    <?php echo navbar(array("s","li"));  ?>
    <img class="top-img" style="-webkit-filter:blur(2px);" src="dsc_0199.jpg" />
    <div class="toptext">
      <h1>TOPPAGE</h1>
    </div>
  </body>
</html>
