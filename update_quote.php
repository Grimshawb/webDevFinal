<?php
	define('TITLE', 'Update Quote');
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
		$query = "SELECT id, text, author, favorite FROM quotes WHERE id={$_GET['id']}";
		if ($result = mysqli_query($dbc, $query)) {
			$row = mysqli_fetch_array($result);

			print '<form class="form--inline" action="update_quote.php" method="post">
						<p><label>Source <input type="text" name="author" value="' .
								htmlentities($row['author']) . '"></label></p>
						<p><label>Quote <br><textarea name="quotation" rows="15" cols="60">' .
								htmlentities($row['text']) . '</textarea></label></p>
						<p><label>Favorite? <input type="checkbox" name="favorite" value="yes"';

			if ($row['favorite'] == 'Y') {
				print ' checked="checked"';
			}

			print '></label></p>
							<input type="hidden" name="id" value="' . $_GET['id'] . '">
							<p><input type="submit" name="submit" value="Update Quote" class="button--pill"></p>
							</form>';
		}
		else {
			print '<p class="input--error">Could not retrieve quote</p>';
		}
	}

	elseif (isset($_POST['id']) && is_numeric($_POST['id']) && ($_POST['id'] > 0)) {
		$problem = FALSE;

		if ( !empty($_POST['quotation']) && !empty($_POST['author']) ) {

			$quote = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['quotation'])));
			$author = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['author'])));

			if (isset($_POST['favorite'])) {
				$favorite = 'Y';
			}
			else {
				$favorite = 'N';
			}

		}
		else {
			print '<p class="input--success">You must enter author and quote</p>';
			$problem = TRUE;
		}

		if (!$problem) {
			$query = "UPDATE quotes SET text='$quote', author='$author', favorite='$favorite'
								WHERE id={$_POST['id']}";
			if ($result = mysqli_query($dbc, $query)) {
				print '<p class="input--success">The quotation has been updated.</p>';
			}
			else {
				print '<p class="input--error">Could not update the quotation<br></p>';
			}
		}

	}
	else {
		print '<p class="input--error">This page has been accessed in error.</p>';
	}

	mysqli_close($dbc);
?>

<?php
	include './templates/footer.php';
