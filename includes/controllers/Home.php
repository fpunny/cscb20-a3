<?php

class Home extends Controller {

  public static function CreateView() {
    $status = self::checkSession();
    $query = "?callback=home";
    if ($status) {
      self::getView("Home");
    } else if ($status == NULL) {
      if (isset($_SESSION['token'])) {
        $query = $query . "&alert=You have timed out, please login again";
      }
      header("Location: " . _BASEURL_ . "/login" . $query);
      exit();
    }
  }

}

?>
