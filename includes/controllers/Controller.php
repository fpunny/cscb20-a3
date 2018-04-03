<?php

class Controller {

  protected static function getView($viewName) {
    require_once("./includes/views/Navigation.php");
    require_once("./includes/views/$viewName.php");
    require_once("./includes/views/Footer.php");
  }

  protected static function checkSession() {
    return API::connect();
  }

  public static function getUser() {
    return API::getUser();
  }
}

?>
