<?php

Route::set('index.php', function () {
  Home::CreateView('Home');
});

Route::set('home', function () {
  Home::CreateView('Home');
});

Route::set('syllabus', function () {
  Syllabus::CreateView('Syllabus');
});

Route::set('login', function () {
  Login::CreateView('Login');
});

Route::set('dashboard', function () {
  Dashboard::CreateView('Dashboard');
});

Route::set('api', function () {

  if (!isset($_GET["token"])) {
    API::res_json("401", "Missing Token");
    return null;
  }

  $token = $_GET['token'];
  if (isset($_GET["api"])) {
    switch($_GET["api"]) {
      case 'test':
        API::test($token);
        break;
      case 'feedback':
        Feedback::run($token);
        break;
      case 'remarks':
        Remarks::run($token);
        break;
      default:
        API::res_json('403', 'Not found');
        break;
    }
  }
});

?>
