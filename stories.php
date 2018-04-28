<?php
	define('TITLE', 'Stories');
	include './templates/header.php';

	if (!isloggedin()) {
		header('Location: index.php');
		ob_end_clean();
		exit();
	}

	$dirName = '../users/' . $_SESSION['username'] . '/';
	$contents = scandir($dirName);

	print "<h2>Stories Uploaded</h2>
					<br>
					<table>
					<tr><th>Name</th>
					<th>Last Modified</th></tr>";

	foreach ($contents as $file) {
		if ($file != 'books.csv' &&  (substr($file, 0, 1) != '.')) {

			$lm = date('F j, Y', filemtime($dirName . '/' . $file));

			print "<tr>
						<td>$file</td>
						<td>$lm</td>
						</tr>\n";
		}
	}

	print "</table>";
?>


<?php
	include './templates/footer.php';
