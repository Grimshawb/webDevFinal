<?php
	define('TITLE', 'Add a Quote');
	include './templates/header.php';
?>

<?php
	if (!isloggedin()) {
		header('Location: index.php');
		ob_end_clean();
		exit();
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (!empty($_POST['quotation']) && !empty($_POST['author'])) {
			include('../mysqli_connect.php');
			$quote = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['quotation'])));
			$author = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['author'])));

			if (isset($_POST['favorite'])) {
				$favorite = 'Y';
			}
			else {
				$favorite = 'N';
			}

			$query = "INSERT INTO quotes (text, author, favorite, date_entered) VALUES
								('$quote', '$author', '$favorite', NOW())";
	    mysqli_query($dbc, $query);

			if (mysqli_affected_rows($dbc) == 1) {
	      print "<p class=\"input--success\">Your quotation has been stored.</p>";
	    }
	    else {
	      print "<p class=\"input--error\">An unknown error prevented us from storing your quote</p>";
	    }

			mysqli_close($dbc);
		}
		else {
			print "<p class=\"input--error\">You must enter author and quote</p>";
		}
	}
?>

<form class="form--inline" action="add_quote.php" method="post">
	<p>Author: <input type="text" name="author" value=""></p>
	<p>Quote Text: <br></p>
	<textarea name="quotation" rows="15" cols="60"></textarea><br><br>
  <p><input type="checkbox" name="favorite" value="yes"> Check to add as favorite</p><br><br>
	<input type="submit" name="submit" value="Submit" class="button--pill">
</form>

<?php
	include './templates/footer.php';
