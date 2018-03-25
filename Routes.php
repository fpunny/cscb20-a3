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

Route::set('api', function () {
  require_once("./includes/classes/API.php");
  echo $_GET['url'];
  echo $_GET['api'];
  echo $_GET['id'];
  echo $_GET['uid'];
  require_once('./includes/api/Login.php');
});

?>
