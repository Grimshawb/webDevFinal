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
				$_POST = [];
				print '<p class="input--error">This username is already registered.</p>';
				print "<p><a href=\"login.php\">Click here</a> to login</p><br>";
			}
		}

		if (empty($_POST['userName']) && !$problem) {
			$problem = true;
			$_POST = [];
			print '<p class="input--error">Please enter a user name</p>';
		}
		if (empty($_POST['password1']) && !$problem) {
			$problem = true;
			$_POST = [];
			print '<p class="input--error">Please enter a password</p>';
		}
		if (empty($_POST['password2']) && !$problem) {
			$problem = true;
			$_POST = [];
			print '<p class="input--error">Please confirm your password</p>';
		}
		if (($_POST['password1'] != $_POST['password2']) && !$problem) {
			$problem = true;
			$_POST = [];
			print '<p class="input--error">Your passwords do not match</p>';
		}

		if (!$problem) {
			include '../mysqli_connect.php';

			$userName = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['userName'])));
			$password = mysqli_real_escape_string($dbc, stripslashes($_POST['password1']));
			$password = password_hash($password, PASSWORD_DEFAULT);

			$query = "INSERT INTO users (username, password, user_dir, status, admin) VALUES
								('$userName', '$password', '$userName', 'OPEN', 'N')";
			mysqli_query($dbc, $query);

			if (mysqli_affected_rows($dbc) == 1) {
				if (!file_exists('../users/')) {
					mkdir('../users/');
				}
				$dirName = '../users/' . $userName . '/';
				mkdir($dirName, 0777);
				$fileName = $dirName . 'books.csv';
				touch($fileName);
				chmod($fileName, 0777);
			}

			$_POST = [];

			print '<p class="input--success">You are now registered<br></p>';
			print "<p>Thank you, $userName, for registering with the Brad Grimshaw Fan Club</p>";
			print "<p><a href=\"login.php\">Click here</a> to login</p><br>";

			mysqli_close($dbc);
		}
		else {
			print '<p class="input--error">Please try again</p>';
		}
	}
?>
<form action="register.php" method="post" class="form--inline">
	<p><label for="firstName">User Name:</label><input type="text" name="userName" size="20"></p>
	<p><label for="password">Password: </label><input type="password" name="password1" size="20"></p>
	<p><label for="password">Confirm Password: </label><input type="password" name="password2" size="20"></p>
	<p><input type="submit" name="submit" value="Register" class="button--pill"></p>
</form>

<?php
	include './templates/footer.php';
