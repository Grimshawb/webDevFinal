<?php
	define('TITLE', 'Register');
	include './templates/header.php';
?>

<h2>Registration Form</h2>
<p>Register to take advantage of additional features!</p>

<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$problem = false;

		if (!empty($_POST['userName'])) {
			if (isAlreadyRegistered($_POST['userName'])) {
				$problem = true;
				print '<p class="text--error">This username is already registered.</p>';
				print "<p><a href=\"login.php\">Click here</a> to login</p><br>";
			}
		}

		if (empty($_POST['userName'])) {
			$problem = true;
			print '<p class="text--error">Please enter a user name</p>';
		}
		if (empty($_POST['password1'])) {
			$problem = true;
			print '<p class="text--error">Please enter a password</p>';
		}
		if (empty($_POST['password2'])) {
			$problem = true;
			print '<p class="text--error">Please confirm your password</p>';
		}
		if ($_POST['password1'] != $_POST['password2']) {
			$problem = true;
			print '<p class="text--error">Your passwords do not match</p>';
		}
		if (!$problem) {
			include '../mysqli_connect.php';

			$userName = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['userName'])));
			$password = mysqli_real_escape_string($dbc, stripslashes($_POST['password']));
			$password = password_hash($_POST['password'], DEFAULT_PASSWORD);

			$query = "insert into users (username, password, status, admin) values
								('$userName', '$password', 'open', 'N')";
			mysqli_query($dbc, $query);

			if (mysqli_affected_rows($dbc) == 1) {
				$dirName = './users/' . $userName;
				mkdir('$dirName');
				touch()
			}

			$_POST = array();	// Wipe variables after successful registration

			print '<p class="text--success">You are now registered.<br>Sort of</p>';
			print "Thank you, {$_POST['userName']}, for registering with the J.D. Salinger Fan Club";

			mysqli_close($dbc);
		}
		else {
			print '<p class="text--error">Please try again</p>';
		}
	}
?>
<form action="register.php" method="post" class="form--inline">
	<p><label for="firstName">User Name:</label><input type="text" name="userName" size="20"
		value="<?if (isset($_POST['userName'])){ print htmlspecialchars($_POST['userName']); }?>""></p>
	<p><label for="password">Password: </label><input type="password" name="password1" size="20"
		value="<?if (isset($_POST['password1'])){ print htmlspecialchars($_POST['password1']); }?>"></p>
	<p><label for="password">Confirm Password: </label><input type="password" name="password2" size="20"
		value="<?if (isset($_POST['password2'])){ print htmlspecialchars($_POST['password2']); }?>"></p>
	<p><input type="submit" name="submit" value="Submit" class="button--pill"></p>
</form>

<?php
	include './templates/footer.php';
