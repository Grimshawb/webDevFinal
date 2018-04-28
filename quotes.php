<?php
	define('TITLE', 'Quotes');
	include './templates/header.php';

	print '<h2>Quotes</h2>';

	if (isset($_SESSION['loggedin'])) {
		print '<h4><a href="add_quote.php">Add Quote</a></h4><br><br>';
	}

	include '../mysqli_connect.php';

	$query = "SELECT id, text, author, favorite FROM quotes ORDER BY date_entered DESC";

	if ($result = mysqli_query($dbc, $query)) {
		while ($row = mysqli_fetch_array($result)) {

			print "<div><blockquote>{$row['text']}</blockquote>- <em>{$row['author']}";

			if ($row['favorite'] == 'Y') {
				print ' <span style="color:red;">Favorite!</span><br>';
			}

			if (isLoggedIn()) {
				print "</em><p><b><a href=\"update_quote.php?id={$row['id']}\">Edit</a>
					<a href=\"delete_quote.php?id={$row['id']}\">Delete</a></p>";
			}

			print "</div><br><br>";
		}
	}
	else {
		print '<p class="input--error">Whoops, we had trouble retrieving the quotes</p>';
	}

	mysqli_close($dbc);

	include './templates/footer.php';
