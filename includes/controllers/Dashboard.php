<?php

class Dashboard extends Controller {

  public static function CreateView() {
    $status = self::checkSession();
    $query = "?callback=/dashboard";
    if ($status) {
      self::getView("Dashboard");
    } else if ($status == NULL) {
      $query = $query . "&alert=You have timed out, please login again";
    }
    header('Location: /login' . $query);
    exit();
  }
}

?>
