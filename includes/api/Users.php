<?php

class Users extends API {

  static function run() {
    if (self::connect()) {
      if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        self::GET();
      } else {
        self::res_json(403, "Invalid Method");
      }
    }
  }

  private function GET() {
    $user = self::getUser();

    if (!isset($_GET['id'])) {
      if ($user['type'] == 'S') {
        $sql = self::$db->query("SELECT users.id, name, email, system.type FROM users NATURAL JOIN system WHERE type='T' OR type='P'");
      } else {
        $sql = self::$db->query("SELECT users.*, system.type FROM users NATURAL JOIN system");
      }
    } else {
      if ($user['type'] == 'S') {
        if ($_GET['id'] != $user['id']) {
          $sql = self::$db->query("SELECT users.id, name, email, system.type FROM users NATURAL JOIN system WHERE id='" . $_GET['id'] . "' AND (type='T' OR type='P')");
        } else {
          $sql = self::$db->query("SELECT users.*, system.type FROM users NATURAL JOIN system WHERE id='" . $_GET['id'] . "'");
        }
      } else {
        $sql = self::$db->query("SELECT users.*, system.type FROM users NATURAL JOIN system WHERE id='" . $_GET['id'] . "'");
      }
    }

    if ($sql) {
      $obj = self::$db->buildObject($sql);
      if (sizeof($obj) == 0) {
        self::res_json(400, "User not found, or permission denied");
      } else {
        echo json_encode($obj);
      }
    } else {
      self::res_json(400, self::$db->error());
    }
  }
}

?>
