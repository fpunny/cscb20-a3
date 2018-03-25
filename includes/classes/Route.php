<?php

class Route {

  public static $routes = array();

  public static function set($route, $func) {
    self::$routes[] = $route;
    if ($_GET['url'] == $route) {
      $func->__invoke();
    }
  }
}

?>
