<?php

class Register extends API {

  public static function run() {
    self::$db = new Database();
    self::$conn = self::$db->connect();
    $query1 = "INSERT INTO system(password, session, type) VALUES ('%s', '%s', '%s')";
    $query2 = "INSERT INTO users(id, utorid, name, email) VALUES (%d, '%s', '%s', '%s')";
    $msg = json_decode(file_get_contents("php://input"), true);

    if ($msg == null && json_last_error() !== JSON_ERROR_NONE) {
      self::res_json(400, "Invalid JSON");
    } else if (array_key_exists("name", $msg) && array_key_exists("utorid", $msg) && array_key_exists("password", $msg) && array_key_exists("email", $msg) && array_key_exists("type", $msg)) {
      $session = md5($msg['utorid'] . $msg['name'] . $msg['password']);
      $query = sprintf($query1, md5($msg['password']), $session, $msg["type"]);
      $sql = self::$db->query($query);

      if ($sql) {
        $id = self::$conn->insert_id;
        $query = sprintf($query2, $id, $msg['utorid'], $msg['name'], $msg['email']);
        $sql = self::$db->query($query);

        $res = true;
        if ($msg["type"] == "Student") {
          $res = self::init_marks($id);
        }

        if ($sql && $res) {
          $_SESSION["token"] = $session;
          self::res_json(200, "Registration Successful");
        } else {
          self::res_json(400, self::$db->error());
        }
      } else {
        self::res_json(400, self::$db->error());
      }
    } else {
      // Keep ambiguous for security
      self::res_json(401, "Registration Rejected");
    }
  }

  private function init_marks($id) {
    $sql = self::$db->query("SELECT id from work");
    if ($sql) {
      $obj = self::$db->buildObject($sql);
      $query = "INSERT INTO grades(sid, wid, grade) VALUES ";
      foreach ($obj as $item) {
        $wid = $item['id'];
        $query = $query . "($id, $wid, 0), ";
      }
      $query = substr($query, 0, -2);
      $sql = self::$db->query($query);
      if ($sql) {
        return true;
      }
    }
    return false;
  }

}

?>
