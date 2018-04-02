<?php
   session_start();
   // clear the session
   unset($_SESSION["username"]);
   unset($_SESSION["password"]);
   // go back to SignIn page
   header('Refresh: 0; URL = SignIn.php');
?>