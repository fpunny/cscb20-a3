<?php

class Remarks extends API {

  static function run() {
    if (self::connect()) {
      if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        self::GET();
      } else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET["id"])) {
        self::POST_MESSAGE();
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

    if ($user["type"] == "Student") {
      if ($id != "") {
        $id = "AND $id";
      }
      $sql = self::$db->query("SELECT remarks.*, work.name AS wName, users.name AS name FROM (remarks INNER JOIN work ON remarks.wid=work.id) INNER JOIN users ON users.id=remarks.sid WHERE sid=" . $user['id'] . " $id");
    } else {
      if ($id != "") {
        $id = "WHERE $id";
      }
      $sql = self::$db->query("SELECT remarks.*, work.name AS wName, users.name AS name FROM (remarks INNER JOIN work ON remarks.wid=work.id) INNER JOIN users ON users.id=remarks.sid $id");
    }
    if ($sql) {
      $obj = self::$db->buildObject($sql);
      foreach ($obj as &$item) {
        $sql = self::$db->query("SELECT messages.*, name FROM messages INNER JOIN users ON messages.sid=users.id WHERE rid=" . $item['id']);
        if ($sql) {
          $item["data"] = self::$db->buildObject($sql);
        }
      }
      echo json_encode($obj);
    }
  }

  private function POST_MESSAGE() {
    $id = "";
    if (isset($_GET['id'])) {
      $msg = json_decode(file_get_contents("php://input"), true);
      if ($json == null && json_last_error() !== JSON_ERROR_NONE) {
        self::res_json(400, "Invalid JSON");
      } else if (!array_key_exists("data", $msg)) {
        self::res_json(400, "Missing data key");
      } else if (strlen($msg["data"]) > 5000) {
        self::res_json(400, "Content too large. Must be within 5000 characters");
      } else {
        $sql = self::$db->query(sprintf("INSERT INTO messages(rid, sid, data) VALUES (%s, %s, '%s')", $id, self::getUser()['id'], $msg));
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

  private function POST() {
    $json = json_decode(file_get_contents("php://input"), true);
    if ($json == null && json_last_error() !== JSON_ERROR_NONE) {
      self::res_json(400, "Invalid JSON");
    } else if (!array_key_exists("wid", $json)) {
      self::res_json(400, "Missing wid");
    } else if (!array_key_exists("data", $json)) {
      self::res_json(400, "Missing data key");
    } else if (strlen($json["data"]) > 5000) {
      self::res_json(400, "Content too large. Must be within 5000 characters");
    } else {
      $sql = self::$db->query(sprintf("INSERT INTO remarks(sid, wid) VALUES (%s, %s)", self::getUser()['id'], $json['wid']));
      if ($sql) {
        $id = self::$conn->insert_id;
        $sql = self::$db->query(sprintf("INSERT INTO messages(rid, sid, data) VALUES (%s, %s, '%s')", $id, self::getUser()['id'], $json['data']));
        if ($sql) {
          self::res_json(200, "Remark Request Sent");
        } else {
          self::res_json(400, self::$db->error());
        }
      } else {
        self::res_json(400, self::$db->error());
      }
    }
  }

}

?>
