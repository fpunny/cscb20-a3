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
  if ($_GET['api']) {
    echo $_GET['api'];
  }

  if ($_GET['id']) {
    echo $_GET['id'];
  }

  if ($_GET['uid']) {
    echo $_GET['uid'];
  }

  $login = new Login();
  echo $login->test();
  echo ' - ';
  echo $login->getUserType("b");
  echo ' - ';
  echo var_dump($login->checkPassword("b", "0cc175b9c0f1b6a831c399e269772661"));
});

?>
