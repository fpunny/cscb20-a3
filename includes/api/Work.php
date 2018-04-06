<?php

class Work extends API {
  static function run() {
    if (self::connect()) {
      if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        self::GET();
      } else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['id'])) {
        self::UPDATE();
      } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        self::POST();
      } else {
        self::res_json(403, "Invalid Method");
      }
    }
  }

  private function GET() {
    $sql = self::$db->query("SELECT * FROM work ORDER BY name");
    if ($sql) {
      echo json_encode(self::$db->buildObject($sql));
    } else {
      self::res_json(400, self::$db->error());
    }
  }

  // name, total, type
  private function POST() {
    $json = json_decode(file_get_contents("php://input"), true);
    if ($json == null && json_last_error() !== JSON_ERROR_NONE) {
      self::res_json(400, "Invalid JSON");
    } else if (!array_key_exists("name", $json)) {
      self::res_json(400, "Missing name");
    } else if (!array_key_exists("total", $json)) {
      self::res_json(400, "Missing total");
    } else if (!array_key_exists("type", $json)) {
      self::res_json(400, "Missing type");
    } else {
      $query = "INSERT INTO work(name, total, type) VALUES ('%s', %s, '%s')";
      $sql = self::$db->query(sprintf($query, $json['name'], $json['total'], $json['type']));
      if ($sql && self::init_grades(self::$conn->insert_id)) {
        self::res_json(200, "New work successfully added");
      } else {
        self::res_json(400, self::$db->error());
      }
    }
  }

  private function UPDATE() {
    $json = json_decode(file_get_contents("php://input"), true);
    if ($json == null && json_last_error() !== JSON_ERROR_NONE) {
      self::res_json(400, "Invalid JSON");
    } else {
      $query = "UPDATE work SET %s WHERE id=" . $_GET['id'];
      $set = "";
      foreach($json as $key => $value) {
        $set = $set . $key . "=" . "$value" . ", ";
      }
      $set = substr($set, 0, -2);
      $sql = self::$db->query(sprintf($query, $set));
      if ($sql) {
        self::res_json(200, "Successfully Updated");
      } else {
        self::res_json(400, self::$db->error());
      }
    }
  }

  private function init_grades($wid) {
    $sql = self::$db->query("SELECT id FROM system WHERE type='Student';");
    if ($sql) {
      $users = self::$db->buildObject($sql);
      $query = "INSERT INTO grades(wid, sid, grade) VALUES %s";
      $set = "(%s, %s, %s), ";
      $values = "";
      foreach ($users as $user) {
        $values = $values . sprintf($set, $wid, $user['id'], 0);
      }
      $values = substr($values, 0, -2);

      $sql = self::$db->query(sprintf($query, $values));
      if ($sql) {
        return true;
      }
    }
    return false;
  }

}

?>
