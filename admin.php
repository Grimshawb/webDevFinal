<?php
	define('TITLE', 'Administration');
	include './templates/header.php';

	if (!isloggedin() && !isAdmin()) {
		header('Location: index.php');
		ob_end_clean();
		exit();
	}

	include '../mysqli_connect.php';

	$query = 'SELECT username FROM users';
	if ($result = mysqli_query($dbc, $query)) {
		print '<form class="form--inline" action="status.php" method="post">
						<p>Username: <select name="choice">';
		while ($row = mysqli_fetch_array($result)) {
			if ($row['username'] != $_SESSION['username']) {
				print "<option value=\"{$row['username']}\">{$row['username']}</option>";
			}
		}

		print '</select></p>
					<input class="button--pill" type="submit" name="sub" value="Submit">
					</form>';
	}

	mysqli_close($dbc);
?>

<?php
	include './templates/footer.php';
