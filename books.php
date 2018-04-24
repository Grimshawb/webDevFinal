<?php
	define('TITLE', 'Books');
	include './templates/header.php';
?>

<form action="books.php" method="post" class="form--inline">
	<p>Book Title: <input type="text" name="bookTitle" value=""></p>
	<p>Book Author: <input type="text" name="bookAuthor" value=""></p>
	<p><input type="submit" name="submit" value="Submit" class="button--pill"></p>
</form>

<?php
	//Scan directory for user's folder
	//get csv file, read and list books from the user
	//if ($_SESSION['userName'] == )
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		//append user's book to the file
	}
?>


<?php
	include './templates/footer.php';
