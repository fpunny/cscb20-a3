<?php

class API {

  protected static $db;
  protected static $conn;
  private static $isAuth = false;
  private static $user;

  static function connect() {
    self::$db = new Database();
    self::$conn = self::$db->connect();

    if (isset($_SESSION['token'])) {
      $status = self::authenticate($_SESSION['token']);
      if ($status) {
        self::$isAuth = true;
        return true;
      } else if ($status === null) {
        return null;
      }
      self::res_json(401, "Invalid Session");

    } else {
      self::res_json(400, "Missing Session. Please login first");
    }
    self::$conn->close();
    return false;
  }

  static function getHeader($key) {
    $headers = getallheaders();
    if (isset($headers[$key])) {
      return $headers[$key];
    }
    return false;
  }

  static function isAuth() {
    return self::$isAuth;
  }

  private function setUser($id) {
    $sql = self::$db->query("SELECT id, type, users.name FROM system NATURAL JOIN users WHERE id=$id");
    if ($sql) {
      self::$user = self::$db->buildObject($sql)[0];
    } else {
      self::res_json(400, self::$db->error());
    }
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

  private static function authenticate($session) {
    $sql = self::$db->query("SELECT id, date FROM system WHERE session='$session'");
    if ($sql && $sql->num_rows != 0) {
      $res = self::$db->buildObject($sql)[0];
      $now = new DateTime("now");
      $then = new DateTime($res["date"]);
      $diff = $now->diff($then);

      $mins = ($diff->days * 24 * 60) + ($diff->h * 60) + ($diff->i);
      if ($mins <= 60) {
        self::setUser($res["id"]);
        return true;
      } else {
        session_destroy();
        self::res_json(400, "You have timed out. Please sign in again.");
        return null;
      }
    } else {
      self::res_json(401, self::$db->error());
    }
    return false;
  }

  static function update_session($id) {
    $sql = self::$db->query("UPDATE system SET date=now() WHERE id=$id");
    if (!$sql) {
      self::res_json(400, self::$db->error());
    }
  }

  static function getUser() {
    if (self::isAuth()) {
      return self::$user;
    }
    return false;
  }
}

?>
