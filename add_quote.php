<?php
	define('TITLE', 'Add a Quote');
	include './templates/header.php';
?>

<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (!empty($_POST['quotation']) && !empty($_POST['quoteAuthor'])) {
			include('../mysqli_connect.php');
			$quote = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['quotation'])));
			$author = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['quoteAuthor'])));

			if (isset($_POST['favorite'])) {
				$favorite = 1;
			}
			else {
				$favorite = 0;
			}

			$query = "insert into quotes (text, author, favorite, date_entered) values
								('$quote', '$author', '$favorite', NOW())";
	    mysqli_query($dbc, $query);

			if (mysqli_affected_rows($dbc) == 1) {
	      print "<p class=\"text--success\">Your quotation has been stored.</p>";
	    }
	    else {
	      print "<p class=\"text--error\">An unknown error prevented us from storing your quote</p>";
	    }

			mysqli_close($dbc);
		}
		else {
			print "<p class=\"text--error\">You must enter author and quote</p>";
		}
	}
?>

<form class="form--inline" action="add_quote.php" method="post">
	<p>Author: <input type="text" name="quoteAuthor" value=""></p>
	<p>Quote Text: <br></p>
	<textarea name="quotation" rows="15" cols="60"></textarea><br><br>
  <p><input type="checkbox" name="favorite" value="yes"> Check to add as favorite</p><br><br>
	<input type="submit" name="submit" value="Submit" class="button--pill">
</form>

<?php
	include './templates/footer.php';
