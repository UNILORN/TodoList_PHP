<?php
session_start();
$_SESSION["id"] = 0;
$_SESSION["group"] = NULL;
header('location:index.php');
 ?>
