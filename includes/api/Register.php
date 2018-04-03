<?php

class Register extends API {

  public static function run() {
    self::$db = new Database();
    self::$conn = self::$db->connect();
    $query1 = "INSERT INTO system(password, token, session, type) VALUES ('%s', '%s', '%s', '%s')";
    $query2 = "INSERT INTO user(id, utorid, name, email)"
    $msg = json_decode(file_get_contents("php://input"), true);
    if ($json == null && json_last_error() !== JSON_ERROR_NONE) {
      self::res_json(400, "Invalid JSON");
    } else if (array_key_exists("name", $msg) && array_key_exists("utorid", $msg) && array_key_exists("password", $msg) && array_key_exists("email", $msg) && array_key_exists("type", $msg)) {
      $session = md5($msg['name']);
      $sql = self::$db->query(
        sprintf($query1, md5($msg['password']), md5($msg['utorid'] + $msg['type']), md5($msg['name']), $msg["type"]);
      );
      if ($sql) {
        $id = self::$conn->last_id;
        $sql = self::$db->query(
          sprintf($query2, $id, $msg['utorid'], $msg['name'], $msg['email']);
        );
        if ($sql) {
          $_SESSION["token"] = $session;
          self::res_json(200, "Registration Successful");
        } else {
          self::res_json(400, self::$db->error());
        }
      } else {
        self::res_json(400, self::$db->error());
      }
    }
    // Keep ambiguous for security
    self::res_json(401, "Registration Rejected");
  }

}

?>
