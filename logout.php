<?php
  session_start();
  if (session_destroy()){
    header("location: http://www-users.cselabs.umn.edu/~hwan0259/login.php");
  }
  exit();
?>
