<?php
	define('TITLE', 'Login');
	include './templates/header.php';
?>
<h2>Login Form</h2>
<p>Users that log in can take advantage of more features</p>

<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		//handle form
		if ((!empty($_POST['userName'])) && (!empty($_POST['password']))) {

			include '../mysqli_connect.php';

			$username = $_POST['userName'];
			$password = mysqli_real_escape_string($dbc, stripslashes($_POST['password']));
			$password = password_hash($_POST['password'], DEFAULT_PASSWORD);

			$query = "select * from users where username='$username' and password='$password'";
			$result = mysqli_query($dbc, $query);
			$numRows = mysqli_num_rows($result);
			if ($numRows == 1) {
				$_SESSION['username'] = $_POST['userName'];
				$_SESSION['loggedin'] = time();
				if (isAdmin()) {
					$_SESSION['admin'] = true;
				}
				else {
					$_SESSION['admin'] = false;
				}
				header('Location: index.php');
				mysqli_close($dbc);
				ob_end_clean();
				exit();
			}
			else {
				print '<p class="text--error">The email and password do not match our records</p>';
			}
		}
		else {
			print '<p class="text--error">Please make sure you enter both an email and a password</p>';
		}
	}
	else {
		print '<form action="login.php" method="post" class="form--inline">
			<p><label for="text">Username:</label><input type="text" name="userName" size="20"></p>
			<br><br>
			<p><label for="password">Password:</label><input type="password" name="password" size="20"></p>
			<br><br>
			<p><input type="submit" name="submit" value="Login" class="button--pill"></p>
		</form>';
	}

	include './templates/footer.php';
?>
