<?php
	define('TITLE', 'Logout');
	include './templates/header.php';
	$name = $_SESSION['username'];
	$_POST = [];
	$_SESSION = [];
	session_destroy();

	print '<h3>Thank you for visiting, ' . $name .'</h3>
				<h4>You have been logged out. Plase visit us again soon!</h4>';

	header("Refresh: 5; url=index.php");

	include './templates/footer.php';
