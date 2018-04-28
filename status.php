<?php
	define('TITLE', 'Account Status');
	include './templates/header.php';

	if (!isloggedin() && !isAdmin()) {
		header('Location: index.php');
		ob_end_clean();
		exit();
	}

	print '<h2>Administration Functions</h2>';

	include '../mysqli_connect.php';
	$username = isset($_POST['choice']) ? $_POST['choice'] : $_POST['user'];
	print '<p>Username: <span style="font-weight:bolder;">' . $username . '</span></p>';

	if (isset($_POST['sub'])) {
		$query = "SELECT status, admin FROM users WHERE username='$username'";

		if ($result = mysqli_query($dbc, $query)) {
			$status = mysqli_fetch_array($result);
			print '<h3>Account Options:</h3>
							<form class="form--inline" action="status.php" method="post">
							<input type="radio" name="selection" value="openAccount"';
							if ($status['status'] == 'OPEN') {
								print 'checked';
							}
							print '> Open <br>';
							print '<input type="radio" name="selection" value="lockAccount"';
							if ($status['status'] == 'LOCKED') {
								print 'checked';
							}
							print '> Locked <br>';
							if ($status['admin'] == 'Y') {
								print '<input type="radio" name="selection" value="revokeAdmin"> Revoke administrator role <br>';
							}
							else {
								print '<input type="radio" name="selection" value="grantAdmin"> Grant administrator role <br>';
							}
							print '<input type="radio" name="selection" value="deleteAccount"> Delete account <br>
										<input type="hidden" name="user" value="' . $username . '">
										<input class="button--pill" type="submit" name="submit" value="Submit Changes">
										</form>';
		}
	}


	if (isset($_POST['submit'])) {

		$user = $_POST['user'];

		if ($_POST['selection'] == 'openAccount') {
			$query = "UPDATE users SET status='OPEN' WHERE username='$user'";
			if (mysqli_query($dbc, $query)) {
				print '<p class="input--success">' . $user . '\'s account is opened</p>';
				header("Refresh: 3; url=admin.php");
			}
			else {
				print '<p class="input--error">An error occurred. Please try again</p>';
			}
		}
		if ($_POST['selection'] == 'lockAccount') {
			$query = "UPDATE users SET status='LOCKED' WHERE username='$user'";
			if (mysqli_query($dbc, $query)) {
				print '<p class="input--success">' . $user . '\'s account is locked</p>';
				header("Refresh: 3; url=admin.php");
			}
			else {
				print '<p class="input--error">An error occurred. Please try again</p>';
			}
		}
		if ($_POST['selection'] == 'revokeAdmin') {
			$query = "UPDATE users SET admin='N' WHERE username='$user'";
			if (mysqli_query($dbc, $query)) {
				print '<p class="input--success">' . $user . '\'s administrator role has been revoked</p>';
				header("Refresh: 3; url=admin.php");
			}
			else {
				print '<p class="input--error">An error occurred. Please try again</p>';
			}
		}
		if ($_POST['selection'] == 'grantAdmin') {
			$query = "UPDATE users SET admin='Y' WHERE username='$user'";
			if (mysqli_query($dbc, $query)) {
				print '<p class="input--success">' . $user . ' has been granted administrator role</p>';
				header("Refresh: 3; url=admin.php");
			}
			else {
				print '<p class="input--error">An error occurred. Please try again</p>';
			}
		}
		if ($_POST['selection'] == 'deleteAccount') {
			$query = "DELETE FROM users WHERE username='$user' LIMIT 1";
			if (mysqli_query($dbc, $query)) {
				$dirName = '../users/' . $user;
				deleteUserDir(realpath($dirName));
				print '<p class="input--success">' . $user . '\'s account has been deleted</p>';
				header("Refresh: 4; url=admin.php");
			}
			else {
				print '<p class="input--error">An error occurred. Please try again</p>';
			}
		}
	}

	mysqli_close($dbc);
?>

<?php
	include './templates/footer.php';
