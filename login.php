<?php
	define('TITLE', 'Login');
	include './templates/header.php';

	if (isloggedin()) {
		header('Location: index.php');
		ob_end_clean();
		exit();
	}

	print '<h2>Login Form</h2>
				<p>Users that log in can access additional features</p>';

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		if ((!empty($_POST['userName'])) && (!empty($_POST['password']))) {

			include '../mysqli_connect.php';

			$username = $_POST['userName'];
			$password = mysqli_real_escape_string($dbc, stripslashes($_POST['password']));
			$result = mysqli_fetch_array(mysqli_query($dbc, "SELECT password, status FROM users WHERE username='$username'"));
			$hashPass = $result['password'];

			if (password_verify($password, $hashPass)) {
				if ($result['status'] == 'OPEN') {
					$_SESSION['username'] = $_POST['userName'];
					$_SESSION['loggedin'] = time();
					$_SESSION['loginFlag'] = true;
					if (isAdmin()) {
						$_SESSION['admin'] = true;
					}
					else {
						$_SESSION['admin'] = false;
					}
					mysqli_close($dbc);
					header('Location: index.php');
					ob_end_clean();
					exit();
				}
				else {
					print '<p class="input--error">This account has been locked. Please contact an administrator</p>';
				}
			}
			else {
				print '<p class="input--error">The username and password do not match our records</p>';
			}
		}
		else {
			print '<p class="input--error">Please make sure you enter both a username and a password</p>';
		}
	}
	else {
		print '<form action="login.php" method="post" class="form--inline">
					<p><label for="text">Username:</label><input type="text" name="userName" size="20"></p>
					<br>
					<p><label for="password">Password:</label><input type="password" name="password" size="20"></p>
					<br><br>
					<p><input type="submit" name="submit" value="Login" class="button--pill"></p>
						</form>';
	}

	include './templates/footer.php';
?>
