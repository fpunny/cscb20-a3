<!DOCTYPE html>
<html>

   <head>
      <title> Welcome </title>
   </head>

   <body>
		<?php session_start(); ?>
		
		<!-- you can see how $_SESSION['username'] gets carried over from the login page! -->
		<h1><?php echo $_SESSION['username']; ?> </h1>
		<h1><?php echo "Hurray! You are In!!!"; ?> </h1>
		<!-- link to SignOut page -->
		<h2><a href = "SignOut.php">Sign Out</a></h2>
   </body>

</html>
