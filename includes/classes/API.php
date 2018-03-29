<?php

header("Content-Type: application/json; charset=UTF-8");

class API {

  protected static $db;
  protected static $conn;
  private static $isAuth = false;
  private static $user;

  function connect($token) {
    self::$db = new Database();
    self::$conn = self::$db->connect();
    self::authenticate($token);

    if (self::isAuth()) {
      return true;
    }
    self::$conn->close();
    self::res_json(401, "Invalid token, Permission denied");
    return false;
  }

  static function test($token) {
    if (self::connect($token)) {
      echo json_encode(self::getUser());
    } else {
      self::res_json('201', 'rip');
    }
  }

  static function getHeader($key) {
    $headers = getallheaders();
    if (isset($headers[$key])) {
      return $headers[$key];
    }
    return false;
  }

  static function buildObject($res) {
    $json = array();
    while ($i = $res->fetch_assoc()) {
      $json[] = $i;
    }
    $res->close();
    self::$conn->next_result();

    return $json;
  }

  static function isAuth() {
    return self::$isAuth;
  }

  static function res_json($status, $err) {
    http_response_code($status);

    // Build json and return
    $obj["status"] = $status;
    $obj["error"] = $err;
    echo json_encode($obj);
  }

  private static function authenticate($token) {
    $sql = self::$db->query("SELECT id,type FROM SYSTEM WHERE token='$token'");
    if ($sql) {
      $obj = self::buildObject($sql);
      if (sizeof($obj) == 1) {
        self::$isAuth = true;
        self::$user = $obj[0];
      }
    } else {
      echo self::$conn->error;
    }
    return false;
  }

  static function getUser() {
    if (self::isAuth()) {
      return self::$user;
    }
    return false;
  }
}

?>
