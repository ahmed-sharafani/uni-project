<?php
 session_start();
 session_destroy();  //Destrol all session
unset($_SESSION['user-role']);
unset($_SESSION['username']);

header("location:../index.php");  // go to previous page
exit;