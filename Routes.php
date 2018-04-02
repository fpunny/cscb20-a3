<?php

Route::set('index.php', function () {
  Home::CreateView();
});

Route::set('home', function () {
  Home::CreateView();
});

Route::set('syllabus', function () {
  Syllabus::CreateView();
});

Route::set('assignment', function () {
  Assignment::CreateView();
});

Route::set('feedback',function(){
  Feedback::CreateView();
});

Route::set('lab',function(){
  Lab::CreateView();
});

Route::set('team',function(){
  Team::CreateView();
});

Route::set('login', function () {
  Login::CreateView();
});

Route::set('dashboard', function () {
  Dashboard::CreateView();
});

Route::set('marks', function () {
  Marks::CreateView();
});

Route::set('_api', function () {
  if (isset($_GET["sys"])) {
    session_start();
    switch ($_GET["sys"]) {
      case "sessiontotoken":
        API::session_to_token();
        break;
      case "login":
        API::login();
        break;
      default:
        API::res_json('403', 'Not found');
        break;
    }
  }
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
      case 'marks':
        Marks::run($token);
        break;
      case 'users':
        Users::run($token);
        break;
      case 'work':
        Work::run($token);
        break;
      default:
        API::res_json('403', 'Not found');
        break;
    }
  }
});

?>
