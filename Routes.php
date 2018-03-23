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

?>
