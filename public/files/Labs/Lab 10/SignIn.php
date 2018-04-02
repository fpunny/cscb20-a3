<!--CSCB20 Lab 10 Exercise 
	For more information visit: TutorialPoint PHP Session &
	http://php.net/manual/en/reserved.variables.session.php
-->
<?php
   session_start();
?>
<!DOCTYPE html>
<html lang = "en"> 
   <head>
      <title>SignInPage</title>      
   </head>
	
   <body>
		<div class = "containerSignIn">
         
        <?php
			$msg = '';
            // Check if login is not null, and username and password is entered
            if (isset($_POST['login']) && !empty($_POST['username']) 
				&& !empty($_POST['password'])) {
				
				// if username is 'root' and password is 'lab10', if so then validate the session
				// $_POST retrives the entered information from the forum
				if ($_POST['username'] == 'root' && $_POST['password'] == 'lab10') {
					$_SESSION['valid'] = true;
					$_SESSION['timeout'] = time();
					$_SESSION['username'] = 'root';
					// since the credentials are correct, go into SignedIn page
					header("location: SignedIn.php");;
				}else {
					$msg = 'Wrong username or password';
				}
			}
        ?>
		</div>
      
		<div class = "container" align="center">
			<div><b>Login</b></div>
			<form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
                <input type = "text" name = "username" class = "box" placeholder = "username" required autofocus /><br /><br />
                <input type = "password" name = "password" class = "box" placeholder = "password" required /><br/><br />
                <input type = "submit" value = " Login " name="login" /><br />
            </form>
      </div> 
   </body>
</html>