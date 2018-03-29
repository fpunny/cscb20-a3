<h1>LOGIN</h1>

<?php
  session_start();
  $_SESSION["token"] = "abcd";
  echo "QED";
?>
