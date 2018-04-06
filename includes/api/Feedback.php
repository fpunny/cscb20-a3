<?php

class Feedback extends API {

  static function run() {
    if (self::connect()) {
      if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        self::GET();
      } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        self::POST();
      } else {
        self::res_json(403, "Invalid Method");
      }
    }
  }

  private static function GET() {
    $user = self::getUser();
    if ($user['type'] == 'Professor') {
      $sql = self::$db->query("SELECT feedback.* FROM feedback WHERE sid='" . $user['id'] . "'");
      if ($sql) {
        echo json_encode(self::$db->buildObject($sql));
      }
    }
  }

  private static function POST() {
    $sid = self::getHeader("id");
    $msg = file_get_contents("php://input");

    if (!$sid) {
      self::res_json(400, "Missing id of professor");
    } else if ($msg == '') {
      self::res_json(400, "Missing Content");
    } else if (strlen($msg) > 5000) {
      self::res_json(400, "Content too large, must be within 5000 characters");
    } else {
      $type = self::getType($sid);
      if ($type == 'Professor') {
        $sql = self::$db->query("INSERT INTO feedback(sid, data) VALUES ($sid, '$msg')");
        if ($sql) {
          self::res_json(200, "Successfully Posted");
        } else {
          self::res_json(400, self::$db->error());
        }
      } else {
        self::res_json(400, 'Invalid professor id');
      }
    }
  }

  private static function getType($sid) {
    $sql = self::$db->query("SELECT type FROM system WHERE id='$sid'");
    if ($sql) {
      $obj = self::$db->buildObject($sql);
      return $obj[0]['type'];
    } else {
      return false;
    }
  }

}

?>
