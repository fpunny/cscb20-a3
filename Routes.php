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

Route::set('api', function () {
  switch($_GET["api"]) {
    case 'session':
      Session::run();
      break;
    case 'feedback':
      Feedback::run();
      break;
    case 'remarks':
      Remarks::run();
      break;
    case 'marks':
      Marks::run();
      break;
    case 'users':
      Users::run();
      break;
    case 'work':
      Work::run();
      break;
    case "login":
      Login::run();
      break;
    case "register":
      Register::run();
      break;
    default:
      API::res_json('403', 'Not found');
      break;
  }
});

?>
