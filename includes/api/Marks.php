<?php

class Marks extends API {
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
    $where = "";
    $user = self::getUser();
    if ($user['type'] == 'Student') {
      $where = "WHERE sid=" . $user['id'];
      $sql = self::$db->query("SELECT grades.*, work.name AS wname, work.total, work.type FROM grades INNER JOIN work ON work.id = grades.wid WHERE sid=" . $user['id'] . " ORDER BY work.type");
    } else {
      $sql = self::$db->query("SELECT grades.*, users.name AS sname, work.name AS wname, users.utorid, work.total, work.type FROM (grades INNER JOIN users ON grades.sid = users.id) INNER JOIN work ON work.id = grades.wid ORDER BY work.type");
    }
    if ($sql) {
      echo json_encode(self::$db->buildObject($sql));
    } else {
      self::res_json(400, self::$db->error());
    }
  }

  private function POST() {
    $user = self::getUser();
    $json = json_decode(file_get_contents("php://input"), true);
    $query = "REPLACE INTO grades(id, sid, wid, grade) VALUES (%d, %d, %d, %d)";

    if ($json == null && json_last_error() !== JSON_ERROR_NONE) {
      self::res_json(400, "Invalid JSON");
    } else if ($user['type'] == 'Professor' || $user['type'] == 'TA') {
      if (!isset($_GET['id'])) {
        self::res_json(400, "Error: Missing mark id");
      } else if (!array_key_exists('sid', $json)) {
        self::res_json(400, "Error: Missing student id");
      } else if (!array_key_exists('wid', $json)) {
        self::res_json(400, "Error: Missing work id");
      } else if (!array_key_exists('grade', $json)) {
        self::res_json(400, "Error: Missing grade");
      } else {
        $sql = self::$db->query(
          sprintf($query, $_GET['id'], $json['sid'], $json['wid'], $json['grade'])
        );
        if ($sql) {
          self::res_json(200, "Successfully Posted/Upgrade Mark");
        } else {
          self::res_json(400, self::$db->error());
        }
      }
    } else {
      self::res_json(401, "Restricted Access: Invalid user type");
    }
  }
}

?>
