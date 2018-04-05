<?php

class Marks extends Controller {

  public static function CreateView() {
    $status = self::checkSession();
    $query = "?callback=marks";
    if ($status) {
      self::getView("Marks");
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
