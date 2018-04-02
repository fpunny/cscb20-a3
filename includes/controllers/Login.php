<?php

class Login extends Controller {

  public static function CreateView() {
    $viewName = "Login";
    require_once("./includes/views/$viewName.php");
  }

}

?>
