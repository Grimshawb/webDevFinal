<?php
	define('TITLE', 'Register');
	include './templates/header.php';

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$name = $_FILES['fileUpload']['name'];
		$ext  = pathinfo($name, PATHINFO_EXTENSION);
		$okExts = array('txt', 'doc', 'docx', 'pdf');
		if (!in_array($ext, $okExts)) {
			print "<p>Invalid file type. Please upload a file in the allowed formats.</p>";
		}
		else {
			// do something
		}
	}
?>

<p>Upload a story file. Must have pdf, doc, docx, or txt file extension.</p>

<form class="form--inline" action="quotes.php" enctype="multipart/form-data" method="post">
	<input type="hidden" name="MAX_FILE_SIZE" value="300000">
	<p><input type="file" name="fileUpload"></p>
	<p><input class="button--pill" type="submit" name="submit" value="Upload"></p>
</form>

<?php
	include './templates/footer.php';
