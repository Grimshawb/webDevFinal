<?php
	define('TITLE', 'Quotes');
	include './templates/header.php';
?>
	<h2>Quotes</h2>

<?php
	//include '../mysqli_connect.php';

	if (isset($_SESSION['loggedin'])) {
		print '<h4><a href="add_quote.php">Add Quote</a></h4><br><br>';
	}

	include '../mysqli_connect.php';

	$query = "SELECT text, author, favorite FROM quotes ORDER BY date_entered DESC";

	if ($result = mysqli_query($dbc, $query)) {
		while ($row = mysqli_fetch_array($result)) {

			print "<div><blockquote>{$row['text']}</blockquote>- <em>{$row['author']}</em>\n";

			if ($row['favorite'] == 1) {
				print ' <strong>Favorite!</strong>';
			}

			if (isAdmin()) {
				print "<p><b>Quote Admin:</b> <a href=\"edit_quote.php?id={$row['id']}\">Edit</a> <->
				<a href=\"delete_quote.php?id={$row['id']}\">Delete</a></p>";
			}

			print "</div><br><br>";

		}
	}
	else {
		print '<p class="text--error">Whoops, we had trouble retrieving the quotes</p>';
	}

	//get quotes add editing/delete links if admin
	mysqli_close($dbc);
?>



<?php
	//mysqli_close($dbc);
	include './templates/footer.php';
