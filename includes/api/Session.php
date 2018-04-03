<?php

class Session extends API {

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
    $sql = self::$db->query("SELECT users.*, system.type FROM users NATURAL JOIN system WHERE id=" . $user['id']);
    if ($sql) {
      $obj = self::$db->buildObject($sql);
      self::res_json(200, $obj[0]);
    } else {
      self::res_json(400, self::$db->error());
    }
  }

}

?>
