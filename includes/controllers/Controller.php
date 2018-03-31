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

  public static function getUser() {
    $token = $_GET['token'];
    $db = new Database();
    $conn = $db->connect();
    $sql = $db->query("SELECT users.*, type from users NATURAL JOIN system where token='$token'");
    return $db->buildObject($sql)[0];
  }
}

?>
