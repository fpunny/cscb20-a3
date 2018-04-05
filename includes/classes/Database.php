<?php

class Database {

  protected static $connection;

  public function connect() {
    $config = parse_ini_file('../../config.ini');
    self::$connection = new mysqli($config['server'], $config['username'], $config['password'], $config['dbname']);

    if (self::$connection === false) {
      printf("Connect Failed: %s", self::$connection->connect_error);
      return false;
    }

    return self::$connection;
  }

  public function query($query) {
    $result = self::$connection->query($query);
    return $result;
  }

  public function error() {
    return self::$connection->error;
  }

  public function buildObject($res) {
    $json = array();
    while ($i = $res->fetch_assoc()) {
      $json[] = $i;
    }
    $res->close();
    self::$connection->next_result();

    return $json;
  }

  public function close() {
    self::$connection->close();
  }
}

?>
