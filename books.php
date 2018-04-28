<?php
	define('TITLE', 'Books');
	include './templates/header.php';

	if (isLoggedIn()) {
		print '<form action="books.php" method="post" class="form--inline">
						<p>Book Title: <input type="text" name="title"></p>
						<p>Book Author: <input type="text" name="author"></p>
						<p><input type="submit" name="submit" value="Submit" class="button--pill"></p>
						</form>';

		print "<h3>My Books</h3>";

		$fileName = '../users/' . $_SESSION['username'] . '/' . 'books.csv';

		$contents = file($fileName);

		print '<ul>';
		foreach ($contents as $key => $value) {
			$line = explode('|', $value);
			print '<li>' . $line[0] . ' by ' . $line[1] . '</li>';
		}
		print '</ul>';
	}

	if (($_SERVER['REQUEST_METHOD'] == 'POST') && isLoggedIn()) {
		if (!empty($_POST['title']) && !empty($_POST['author'])) {

			$data = trim(stripslashes($_POST['title'])) . ' | ' . trim(stripslashes($_POST['author']));

			file_put_contents($fileName, $data . PHP_EOL, FILE_APPEND);
			header('Location: books.php');
			ob_end_clean();
			exit();
		}
		else {
			print "<p class=\"input--error\">You must enter a title and author</p>";
		}
	}

	if (!isLoggedIn()) {
		print '<h2>Example Books</h2>
						<ul>
							<li>The Catcher in the Rye</li>
							<li>Nine Stories</li>
							<li>Franny and Zooey</li>
							<li>Raise High the Roof Beam, Carpenters and Seymour: An Introduction</li>
						</ul>';
	}

	include './templates/footer.php';
