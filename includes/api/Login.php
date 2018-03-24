<?php

require_once("./includes/api/API.php");

class Login extends API {

   public static function hihi() {
     return parent::GET("", "", "");
   }

}

echo Login::hihi();

?>
