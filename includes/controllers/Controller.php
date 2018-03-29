<?php

class Controller {
  public static function CreateView($viewName) {
    require_once("./includes/views/Navigation.php");
    require_once("./includes/views/$viewName.php");
    require_once("./includes/views/Footer.php");
  }

  public static function CheckSession() {
    if (isset($_SESSION['token'])) {
      
    }
  }
}

?>
