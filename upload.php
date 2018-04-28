<?php
	define('TITLE', 'Upload File');
	include './templates/header.php';

	if (!isloggedin()) {
		header('Location: index.php');
		ob_end_clean();
		exit();
	}

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$dirName = '../users/' . $_SESSION['username'] . '/' . $_FILES['fileUpload']['name'];
		$ext  = pathinfo($_FILES['fileUpload']['name'], PATHINFO_EXTENSION);
		$okExts = array('txt', 'doc', 'docx', 'pdf');
		if (!in_array($ext, $okExts)) {
			print "<p class=\"input--error\">Invalid file type. Please upload a file in the allowed formats.</p>";
		}
		else if (move_uploaded_file($_FILES['fileUpload']['tmp_name'], $dirName)){
			print '<p class="input--success">Your file was uploaded successfully</p>';
		}
		else {
			switch ($_FILES['fileUpload']['error']) {
			case 1:
			case 2:
				print '<p class="input--error">The file exceeds the maximum size allowed</p>';
				break;
			case 3:
				print '<p class="input--error">The file was only partially uploaded</p>';
				break;
			case 4:
				print '<p class="input--error">No file uploaded</p>';
				break;
			case 6:
				print '<p class="input--error">The temporary folder does not exist</p>';
				break;
			default:
				print '<p class="input--error">Something unforeseen happened</p>';
				break;
		}
		}
	}
?>

<p>Upload a story file. Must have pdf, doc, docx, or txt file extension.</p>

<form class="form--inline" action="upload.php" enctype="multipart/form-data" method="post">
	<input type="hidden" name="MAX_FILE_SIZE" value="3000000">
	<p><input type="file" name="fileUpload"></p>
	<p><input class="button--pill" type="submit" name="submit" value="Upload"></p>
</form>

<?php
	include './templates/footer.php';
