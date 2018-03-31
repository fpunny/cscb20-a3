<?php

class Controller {

  private static $user = NULL;
  protected static $conn;
  protected static $db;

  protected static function getView($viewName) {
    require_once("./includes/views/Navigation.php");
    require_once("./includes/views/$viewName.php");
    require_once("./includes/views/Footer.php");
  }

  public static function isAuth() {
    return !(self::getUser() === NULL);
  }

  protected static function checkSession() {
    if (isset($_SESSION['token'])) {
      self::$db = new Database();
      if (self::validate($_SESSION['token'])) {
        return true;
      }
    }
    return false;
  }

  public static function getUser() {
    return self::$user;
  }

  protected static function validate() {
    self::$conn = self::$db->connect();
    $token = $_SESSION['token'];
    $sql = self::$db->query("SELECT users.*, type from users NATURAL JOIN system where session='$token'");
    if ($sql && sizeof($sql) == 1) {
      self::$user = self::$db->buildObject($sql)[0];
      return true;
    } else {
      return false;
    }
  }
}

?>
