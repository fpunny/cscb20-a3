<?php

class API {

  private static $servername  = "mathlab.utsc.utoronto.ca:3306";
  private static $username = "punfrede";
  private static $password = "punfrede";
  private static $dbname = "cscb20w18_punfrede";
  protected

  function __construct() {
    connect();
  }

  public static function connect() {
    $conn = new mysqli(self::$servername, self::$username, self::$password, self::$dbname);

    if ($conn->connect_error) {
      die("Connection failed: $conn->connect_error");
    }
    return $conn;
  }

  public static function GET($from, $select, $where) {
    $conn = self::connect();
    if ($sql = $conn->query("SELECT * FROM yeet")) {
      $res = self::SQLtoJSON($sql);
      $sql->free();
    }
    $conn->close();
    return $res;
  }

  public static function SQLtoJSON($sql) {
    $json = array();
    while ($i = $sql->fetch_assoc()) {
      $json[] = $i;
    }
    return json_encode($json);
  }
} 

?>
