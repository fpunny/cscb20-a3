<?php

class Feedback extends API {

  static function run() {
    if (self::connect()) {
      if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        self::GET();
      } else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['id'])) {
        self::VIEWED();
      } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        self::POST();
      } else {
        self::res_json(403, "Invalid Method");
      }
    }
  }

  private function GET() {
    $user = self::getUser();
    if ($user['type'] == 'Professor') {
      $sql = self::$db->query("SELECT feedback.* FROM feedback WHERE sid='" . $user['id'] . "' ORDER BY viewed, date");
      if ($sql) {
        $obj = self::$db->buildObject($sql);
        $res = array();
        foreach ($obj as $value) {
          $data = array(
            "id" => $value["id"],
            "sid" => $value["sid"],
            "date" => $value["date"],
            "data" => array(
              "q1" => $value["q1"],
              "q2" => $value["q2"],
              "q3" => $value["q3"],
              "q4" => $value["q4"],
              "q5" => $value["q5"]
            )
          );
          array_push($res, $data);
        }
        echo json_encode($res);
      }
    }
  }

  private function VIEWED() {
    $user = self::getUser();
    $id = htmlspecialchars($_GET['id']);
    if ($user['type'] == "Professor") {
      $sql = self::$db->query("SELECT sid FROM feedback WHERE id=" . $id);
      if ($sql && $sql->num_rows) {
        $obj = self::$db->buildObject($sql);
        if ($obj[0]['sid'] == $user['id']) {
          $sql = self::$db->query("UPDATE feedback SET viewed=true WHERE id=" . $id);
          if ($sql) {
            self::res_json(200, "Feedback Viewed");
          } else {
            self::res_json(400, self::$conn->error());
          }
        } else {
          self::res_json(400, "Permission Denied");
        }
      } else {
        self::res_json(400, "Invalid feedback");
      }
    } else {
      self::res_json(400, "Permission Denied");
    }
  }

  private function POST() {
    $msg = json_decode(file_get_contents("php://input"), true);

    if (self::getUser()['type'] == 'Student') {
      if ($msg == null && json_last_error() !== JSON_ERROR_NONE) {
        self::res_json(400, "Invalid JSON");
      } else if (!array_key_exists("sid", $msg)) {
        self::res_json(400, "Missing Professor id");
      } else if (!array_key_exists("data", $msg)) {
        self::res_json(400, "Missing data");
      } else if (!array_key_exists("q1", $msg["data"]) || !array_key_exists("q2", $msg["data"]) || !array_key_exists("q3", $msg["data"]) || !array_key_exists("q4", $msg["data"]) || !array_key_exists("q5", $msg["data"])) {
        self::res_json(400, "Invalid data");
      } else {
        foreach ($msg["data"] as $key => $value) {
          if (strlen($value) > 2000) {
            self::res_json(400, $key . " is too long!");
            return null;
          }
        }
        $type = self::getType($msg["sid"]);
        if ($type == 'Professor') {
          $query = "INSERT INTO feedback(sid, q1, q2, q3, q4, q5) VALUES (%s, '%s', '%s', '%s', '%s', '%s')";
          $sql = self::$db->query(sprintf($query, htmlspecialchars($msg["sid"]), htmlspecialchars($msg["data"]["q1"]), htmlspecialchars($msg["data"]["q2"]), htmlspecialchars($msg["data"]["q3"]), htmlspecialchars($msg["data"]["q4"]), htmlspecialchars($msg["data"]["q5"])));
          if ($sql) {
            self::res_json(200, "Successfully Posted");
          } else {
            self::res_json(400, self::$db->error());
          }
        } else {
          self::res_json(400, 'Invalid professor id');
        }
      }
    } else {
      self::res_json(400, 'Access Denied. Students only');
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
