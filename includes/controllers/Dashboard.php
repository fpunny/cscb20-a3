<?php

class Dashboard extends Controller {

  public static function CreateView() {
    session_start();
    if (self::checkSession()) {
      self::getView("Dashboard");
    }
  }

  public static function getRemarks() {

  }

}

?>
