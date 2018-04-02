<?php

header("Content-Type: application/json; charset=UTF-8");

class API {

  protected static $db;
  protected static $conn;
  private static $isAuth = false;
  private static $user;

  static function connect($token) {
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

  static function getHeader($key) {
    $headers = getallheaders();
    if (isset($headers[$key])) {
      return $headers[$key];
    }
    return false;
  }

  static function buildObject($res) {
    return self::$db->buildObject($res);
  }

  static function isAuth() {
    return self::$isAuth;
  }

  static function res_json($status, $data) {
    http_response_code($status);

    // Build json and return
    $obj["status"] = $status;

    // Only status we would be dealing with
    if ($status < 300) {
      $obj["data"] = $data;
    } else if ($status >= 400) {
      $obj["error"] = $data;
    }
    echo json_encode($obj);
  }

  private static function authenticate($token) {
    $sql = self::$db->query("SELECT id,type FROM system WHERE token='$token'");
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

  private function checkSession($session) {
    $sql = self::$db->query("SELECT id, token, session, date FROM system WHERE session='$session'");
    if ($sql) {
      $res = self::$db->buildObject($sql)[0];
      $now = new DateTime("now");
      $diff = $now->diff(new DateTime($res["date"]));

      $hours = ($diff->days * 24) + ($diff->h);
      if ($hours > 1) {
        echo json_encode($res);
        return true;
      }
    } else {
      self::res_json(401, self::$db->error());
    }
    return false;
  }

  static function session_to_token() {
    if (isset($_SESSION['token'])) {
      self::$db = new Database();
      self::$conn = self::$db->connect();
      if (!self::checkSession($_SESSION['token'])) {
        self::res_json(401, "Invalid Session. Access Denied");
      }
      self::$conn->close();
    }
  }

  static function login() {
    self::$db = new Database();
    self::$conn = self::$db->connect();

    $msg = json_decode(file_get_contents("php://input"), true);
    if ($msg == null && json_last_error() !== JSON_ERROR_NONE) {
      self::res_json(400, "Invalid JSON");
    } else if (array_key_exists("e", $msg) && array_key_exists("w", $msg) && array_key_exists("k", $msg)) {
      self::$db->query("SELECT session FROM users NATURAL JOIN system WHERE email='" . $msg['e'] . "' AND password='" . $msg["w"] . "' AND type='" . $msg["t"] . "'");
      if ($sql) {
        $obj = self::$db->buildObject($sql);
        if (sizeof($obj) == 1) {
          $_SESSION['token'] = $obj[0]["session"];
          self::res_json(200, "Login Successful");
        } else {
          self::res_json(401, "Access Denied");
        }
      } else {
        self::res_json(400, self::$db->error());
      }
    } else {
      self::res_json(401, "Access Denied");
    }
    self::$conn->close();
  }
}

?>
