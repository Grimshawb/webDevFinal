<?php
	define('TITLE', 'Logout');
	include './templates/header.php';
	$_POST = [];
	$_SESSION = [];
	session_destroy();
	ob_end_clean();
	header('Location: index.php');
?>

	<p>You have been logged out.</p>

<?php
	include './templates/footer.php';
