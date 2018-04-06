<?php

class Login extends API {

  static function run() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      self::POST();
    } else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
      self::DELETE();
    } else {
      self::res_json(403, "Invalid Method");
    }
  }

  private function POST() {
    self::$db = new Database();
    self::$conn = self::$db->connect();
    $msg = json_decode(file_get_contents("php://input"), true);
    if ($msg == null && json_last_error() !== JSON_ERROR_NONE) {
      self::res_json(400, "Invalid JSON");
    } else if (array_key_exists("e", $msg) && array_key_exists("w", $msg)) {
      $sql = self::$db->query("SELECT id, session FROM users NATURAL JOIN system WHERE email='" . $msg['e'] . "' AND password='" . md5($msg["w"]) . "'");
      if ($sql) {
        $obj = self::$db->buildObject($sql);
        if (sizeof($obj) == 1) {
          self::update_session($obj[0]["id"]);
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

  private function DELETE() {
    self::$db = new Database();
    self::$conn = self::$db->connect();
    if (session_status() == PHP_SESSION_ACTIVE) {
      session_destroy();
      self::res_json(200, "Successfully Logged out");
    } else {
      self::res_json(400, "No session found :c");
    }
  }
}

?>
