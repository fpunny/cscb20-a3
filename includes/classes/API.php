<?php

header("content-type: application/json;odata=verbose");

class Database {

  protected static $connection;

  public function connect() {
    $config = parse_ini_file('./config.ini');
    self::$connection = new mysqli($config['server'], $config['username'], $config['password'], $config['dbname']);

    if (self::$connection === false) {
      printf("Connect Failed: %s", self::$connection->connect_error);
      return false;
    }

    return self::$connection;
  }

  public function query($query) {
    $connection = $this->connect();
    $result = $connection->query($query);
    return $result;
  }

  public function error() {
    $connection = $this->connect();
    return $connection->error;
  }
}

class API {

  protected static $db;
  protected static $conn;

  function __construct() {
    self::$db = new DataBase();
    self::$conn = self::$db->connect();
  }

  function buildObject($res) {
    $json = array();
    while ($i = $res->fetch_assoc()) {
      $json[] = $i;
    }
    $res->close();
    self::$conn->next_result();

    return $json;
  }

  function getUserType($utorid) {
    $sql = self::$db->query("SELECT type FROM USERS WHERE utorid='$utorid'");
    if ($sql) {
      $obj = self::buildObject($sql);
      if (sizeof($obj) >= 1) {
        return $obj[0]["type"];
      }
    } else {
      echo self::$conn->error;
    }
    return false;
  }

}

?>
