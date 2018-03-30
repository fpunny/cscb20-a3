<?php

class Students extends API {

  static function run($token) {
    if (self::connect($token)) {
      if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        self::GET();
      } else {
        self::res_json(403, "Invalid Method");
      }
    }
  }
}

?>
