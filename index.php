<?php

session_start();
date_default_timezone_set("America/Toronto");
require_once('Routes.php');

function __autoload($class_name) {
  if ($_GET["url"] == 'api' && file_exists("./includes/api/$class_name.php")) {
    require_once("./includes/api/$class_name.php");
  } else if (file_exists("./includes/classes/$class_name.php")) {
    require_once("./includes/classes/$class_name.php");
  } else if (file_exists("./includes/controllers/$class_name.php")) {
    require_once("./includes/controllers/$class_name.php");
  }
}

?>
