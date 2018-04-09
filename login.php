<?php
	define('TITLE', 'Login');
	include './templates/header.php';
?>
<h2>Login Form</h2>
<p>Users that log in can take advantage of more features</p>

<?php
	// This is an example of one page that handles display and form submission
	// This tests whether the form has been submitted
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		//handle form
		if ( (!empty($_POST['email'])) && (!empty($_POST['password']))) {
			if ( (strtolower($_POST['email']) == 'test@example.com') && ( ($_POST['password']) == 'testuser')) {
				$_SESSION['loggedin'] = time();
				ob_end_clean();		// Destroys page buffer
				header('Location: email.php');	// Sends user to new page
				exit();		// Terminates execution of remainder of script
			}
			else {
				print '<p class="text--error">The submitted email and password do not match our records</p>';
			}
		}
		else {
			print '<p class="text--error">Please make sure you enter both an email and a password</p>';
		}
	}
	else {
		print '<form action="login.php" method="post" class="form--inline">
			<p><label for="email">Email Address:</label><input type="email" name="email" size="20"></p>
			<br><br>
			<p><label for="password">Password:</label><input type="password" name="password" size="20"></p>
			<br><br>
			<p><input type="submit" name="submit" value="Login" class="button--pill"></p>
		</form>';
	}

	include './templates/footer.php';
?>
