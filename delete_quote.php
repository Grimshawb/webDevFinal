<?php
	define('TITLE', 'Delete Quote');
	include './templates/header.php';
?>

<?php
	if (!isloggedin()) {
		header('Location: index.php');
		ob_end_clean();
		exit();
	}

	include '../mysqli_connect.php';

	if (isset($_GET['id']) && is_numeric($_GET['id']) && ($_GET['id'] > 0)) {

		$query = "SELECT text, author, favorite FROM quotes WHERE id={$_GET['id']}";
		if ($result = mysqli_query($dbc, $query)) {

			$row = mysqli_fetch_array($result);

			print '<form class="form--inline" action="delete_quote.php" method="post">
						<p>Are you sure you want to delete this quote?</p>
						<div><blockquote>' . $row['text'] . '</blockquote><em>- ' . $row['author'];

			if ($row['favorite'] == 'Y') {
				print ' <span style="color:red;">Favorite!</span><br>';
			}

			print '</em></div><br><input type="hidden" name="id" value="' . $_GET['id'] . '">
						<p><input type="submit" name="submit" value="Delete Quote" class="button--pill"></p>
						</form>';

		}
		else {
			print '<p class="input--error">Could not retrieve the quote<br></p>';
		}
	}
	elseif (isset($_POST['id']) && is_numeric($_POST['id']) && ($_POST['id'] > 0) ) {

		$query = "DELETE FROM quotes WHERE id={$_POST['id']} LIMIT 1";
		$result = mysqli_query($dbc, $query);

		if (mysqli_affected_rows($dbc) == 1) {
			print '<p class="input--success">The quote entry has been deleted.</p>';
		}
		else {
			print '<p class="error">Could not delete the blog entry because:<br>' . mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
		}

	}
	else {
		print '<p class="error">This page has been accessed in error.</p>';
	}

	mysqli_close($dbc);
?>

<?php
	include './templates/footer.php';
