<?php

class Remarks extends API {

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

  private function GET() {
    $id = "";
    $user = self::getUser();
    if (isset($_GET['id'])) {
      $id = "id=" . $_GET['id'];
    }

    if ($user["type"] == "S") {
      if ($id != "") {
        $id = "AND $id";
      }
      $sql = self::$db->query("SELECT * FROM remarks WHERE sid=" . $user['id'] . " $id");
    } else {
      if ($id != "") {
        $id = "WHERE $id";
      }
      $sql = self::$db->query("SELECT * FROM remarks $id");
    }
    if ($sql) {
      $obj = self::$db->buildObject($sql);
      foreach ($obj as &$item) {
        $sql = self::$db->query("SELECT * FROM messages WHERE rid=" . $item['id']);
        if ($sql) {
          $item["data"] = self::$db->buildObject($sql);
        }
      }
      echo json_encode($obj);
    }
  }

  private function POST() {
    $id = "";
    if (isset($_GET['id'])) {
      $msg = json_decode(file_get_contents("php://input"), true);
      if ($json == null && json_last_error() !== JSON_ERROR_NONE) {
        self::res_json(400, "Invalid JSON");
      } else if (array_key_exists("data", $msg)) {
        self::res_json(400, "Missing data key");
      } else if (strlen($msg["data"]) > 5000) {
        self::res_json(400, "Content too large. Must be within 5000 characters");
      } else {
        $sql = self::$db->query("INSERT INTO messages(rid, sid, data) VALUES ($id, self::getUser()['id'], '$msg')");
        if ($sql) {
          self::res_json(200, "Successfully Posted");
        } else {
          self::res_json(400, self::$db->error());
        }
      }
    } else {
      self::res_json(400, "Missing remark id");
    }
  }

}

?>
