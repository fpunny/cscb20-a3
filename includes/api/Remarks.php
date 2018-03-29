<?php

class Remarks extends API {

  static function run($token) {
    if (self::connect($token)) {
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
    if (isset($_GET['id'])) {
      $id = "id=" . $_GET['id'];
    }

    if (self::getUser()["type"] == "S") {
      if ($id != "") {
        $id = "AND $id";
      }
      $sql = self::$db->query("SELECT * FROM remarks WHERE sid=" . self::getUser()['id'] . " $id");
    } else {
      if ($id != "") {
        $id = "WHERE $id";
      }
      $sql = self::$db->query("SELECT * FROM remarks $id");
    }
    if ($sql) {
      $obj = self::buildObject($sql);
      foreach ($obj as &$item) {
        $sql = self::$db->query("SELECT * FROM messages WHERE rid=" . $item['id']);
        if ($sql) {
          $item["data"] = self::buildObject($sql);
        }
      }
      echo json_encode($obj);
    }
  }

  private function POST() {
    $id = "";
    if (isset($_GET['id'])) {
      $msg = file_get_contents("php://input");
      if ($msg == '') {
        self::res_json(400, "Missing Content");
      } else if (strlen($msg) > 5000) {
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
