<?php
	session_start();
	ob_start();
	include './includes/functions.php';
	//error_reporting(0);			//Turn on before Submission
?><!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge, chrome=1">
	<meta name="viewport" content="width-device-width, initial-scale=1.0">
	<meta name="Handheld Friendly" content="True">
	<title>
		<?
			if (defined('TITLE')) {
				print TITLE;
			}
			else {
				print 'Raise High the Roof Beam';
			}
		?>
	</title>
	<link rel="stylesheet" type="text/css" media="screen" href="css/concise.min.css">
	<link rel="stylesheet" type="text/css" media="screen" href="css/masthead.css">
</head>
<body>

	<header container class="siteHeader">
		<div row>
			<h1 column=4 class="logo"><a href="index.php">Brad Grimshaw's Page</a></h1>
			<nav column="8" class="nav">
				<ul>
					<li><a href="books.php">Books</a></li>
					<li><a href="quotes.php">Quotes</a></li>
					<li><a href="register.php">Register</a></li>
					<?php
					if (!isset($_SESSION['loggedin'])) {
						print "<li><a href=\"login.php\">Login</a></li>";
					}
					if (isset($_SESSION['isAdmin'])) {
						print "<li><a href=\"admin.php\">Admin</a></li>";
					}
					if (isset($_SESSION['loggedin'])) {
						print "<li><a href=\"stories.php\">Stories</a></li>";
						print "<li><a href=\"upload.php\">Uploads</a></li>";
						print "<li><a href=\"email.php\">Contact</a></li>";
						print "<li><a href=\"logout.php\">Logout</a></li>";
					}
					?>
				</ul>
			</nav>
		</div>
	</header>

	<main container class="siteContent">
