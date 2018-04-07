<?php

class Syllabus extends Controller {

  public static function CreateView() {
    $status = self::checkSession();
    $query = "?callback=syllabus";
    if ($status) {
      self::getView("Syllabus");
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
