<?php

class Feedback extends Controller {

  public static function CreateView() {
    $status = self::checkSession();
    $query = "?callback=assignment";
    if ($status) {
      if (self::getUser()['type'] != 'Student') {
        header("Location: " . _BASEURL_ . "/login" . $query . "That page is for students only");
        exit();
      } else {
        self::getView("Feedback");
      }
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
