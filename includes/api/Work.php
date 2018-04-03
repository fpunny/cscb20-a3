<?php

class Work extends API {
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
    $sql = self::$db->query("SELECT * FROM work");
    if ($sql) {
      echo json_encode(self::$db->buildObject($sql));
    } else {
      self::res_json(400, self::$db->error());
    }
  }

}

?>
