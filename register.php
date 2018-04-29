<?php
	define('TITLE', 'Register');
	include './templates/header.php';

	if (isloggedin()) {
		header('Location: index.php');
		ob_end_clean();
		exit();
	}
?>

<h2>Registration Form</h2>
<p>Register to take advantage of additional features!</p>

<form action="register.php" method="post" class="form--inline">
	<p><label for="firstName">User Name:</label><input type="text" name="userName" size="20"></p>
	<p><label for="password">Password: </label><input type="password" name="password1" size="20"></p>
	<p><label for="password">Confirm Password: </label><input type="password" name="password2" size="20"></p>
	<p><input type="submit" name="submit" value="Register" class="button--pill"></p>
</form>

<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		include './includes/errorMessages.php';

		$problem           = false;
		$alreadyRegistered = false;
		$noUserName        = false;
		$noPassword1			 = false;
		$noPassword2 			 = false;
		$passwordMismatch  = false;

		if (!empty($_POST['userName'])) {
			if (isAlreadyRegistered($_POST['userName'])) {
				$problem = true;
				$alreadyRegistered = true;
			}
		}

		if (empty($_POST['userName'])) {
			$problem = true;
			$noUserName = true;
		}
		if (empty($_POST['password1'])) {
			$problem = true;
			$noPassword1 = true;
		}
		if (empty($_POST['password2'])) {
			$problem = true;
			$noPassword2 = true;
		}
		if (!$noPassword1 && !$noPassword2 && ($_POST['password1'] != $_POST['password2'])) {
			$problem = true;
			$passwordMismatch = true;
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

			print '<p class="input--success">You are now registered<br>';
			print "Thank you, $userName, for registering with the Brad Grimshaw Fan Club<br>";
			print "<a href=\"login.php\">Click here</a> to login</p><br>";

			mysqli_close($dbc);
		}
		else {
			if ($problem) {
				print '<p class="input--error">';
				if ($alreadyRegistered) {print $alreadyRegisteredError . "<br>";}
				if ($noUserName) {print $noUserNameError . "<br>";}
				if ($noPassword1) {print $enterPasswordError . "<br>";}
				if ($noPassword2) {print $confirmPasswordError . "<br>";}
				if ($passwordMismatch) {print $passwordMismatchError . "<br>";}
			}
			else {
				print 'We experienced an unexpected error. Please try again';
			}
			print '</p>';
			$_POST = [];
		}
	}

	include './templates/footer.php';
