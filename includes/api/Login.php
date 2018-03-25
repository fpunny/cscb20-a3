<?php

class Login extends API {

  function __construct() {
    parent::__construct();
  }

  function test() {
    $sql = self::$db->query("SELECT * FROM yeet");
    if ($sql) {
      return json_encode(self::buildObject($sql));
    } else {
      echo self::$conn->error;
      return false;
    }
  }

  function checkPassword($utorid, $password) {
    $sql = self::$db->query("SELECT password FROM SYSTEM WHERE utorid='$utorid'");
    if ($sql) {
      $obj = self::buildObject($sql);
      if (sizeof($obj) >= 1 && $obj[0]["password"] == $password) {
        return true;
      }
    }
    return false;
  }

}

$login = new Login();
echo $login->test();
echo ' - ';
echo $login->getUserType("b");
echo ' - ';
echo var_dump($login->checkPassword("b", "0cc175b9c0f1b6a831c399e269772661"));

?>
