<?php
	// This file demonstrates how to make a sticky form
	// which is a form that remembers previously entered data
	// To preselect a checkbox use checked="checked"
	// To preselect a a pull-down use selected="selected"
	define('TITLE', 'Register');
	include './templates/header.php';
	include './mysqli_connect.php';
?>

<h2>Registration Form</h2>
<p>Register to take advantage of additional features!</p>

<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$problem = false;

		if (!empty($_POST['firstName'])) {
			if (isAlreadyRegistered($_POST['firstName'])) {
				print '<p class="text--error">You are already registered.</p>';
				print "<p><a href=\"login.php\">Click here</a> to login</p><br>";
			}
		}




		if (empty($_POST['firstName'])) {
			$problem = true;
			print '<p class="text--error">Please enter your first name</p>';
		}
		if (empty($_POST['lastName'])) {
			$problem = true;
			print '<p class="text--error">Please enter your last name</p>';
		}
		if (empty($_POST['email']) || (substr_count($_POST['email'], '@') != 1)) {
			$problem = true;
			print '<p class="text--error">Please enter your email</p>';
		}
		if (empty($_POST['password'])) {
			$problem = true;
			print '<p class="text--error">Please enter your password</p>';
		}
		if (!$problem) {
			print '<p class="text--success">You are now registered.<br>Sort of</p>';
			$body = "Thank you, {$_POST['firstName']}, for registering with the J.D. Salinger Fan Club";
			mail($_POST['email'], 'Registration Confirmation', $body, 'From: admin@example.com');
			$_POST = [];	// Wipe variables after successful registration
		}
		else {
			print '<p class="text--error">Please try again</p>';
		}
	}
?>
<form action="register.php" method="post" class="form--inline">
	<p><label for="firstName">First Name:</label><input type="text" name="firstName" size="20"
		value="<?if (isset($_POST['firstName'])){ print htmlspecialchars($_POST['firstName']); }?>""></p>
	<p><label for="lastName">Last Name:</label><input type="text" name="lastName" size="20"
		value="<?if (isset($_POST['lastName'])){ print htmlspecialchars($_POST['lastName']); }?>"></p>
	<p><label for="email">Email:</label><input type="email" name="email" size="20"
		value="<?if (isset($_POST['email'])){ print htmlspecialchars($_POST['email']); }?>"></p>
	<p><label for="password">Password:</label><input type="password" name="password" size="20"
		value="<?if (isset($_POST['password'])){ print htmlspecialchars($_POST['password']); }?>"></p>
	<p><input type="submit" name="submit" value="Submit"></p>
</form>

<?php
	include './templates/footer.php';
