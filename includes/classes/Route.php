<?php

class Route {

  public static $routes = array();
  public static $found = false;

  public static function set($route, $func) {
    self::$routes[] = $route;
    if ($_GET['url'] == $route) {
      self::$found = true;
      $func->__invoke();
    }
  }
}

?>
