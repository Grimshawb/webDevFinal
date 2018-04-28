<?php
	include('./templates/header.php');

	if ($_SESSION['loginFlag']) {
		print '<p class="input--success">You are now logged in</p>';
		$_SESSION['loginFlag'] = false;
	}

?>

<p>
	<h1>Brad Grimshaw Fan Club</h1>
	<p>Number of members: You and Brad Grimshaw</p>
	<p>If you were actually looking for Brad Grimshaw's fan club page, you're in luck! You've found it! This is the most exclusive fan club you will ever find as you and Brad Grimshaw are the only people aware of this website.</p>
	<p>Otherwise, you're probably in the wrong place. You have no idea who Brad Grimshaw is do you?</p>
</p>

<?php
	include('./templates/footer.php');
