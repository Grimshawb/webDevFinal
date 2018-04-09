<?php
	// constants & variables declared before the include or require are available to the
	// included document - see books.php
	include('./templates/header.php');
	// or include 'header.html';
	// Directory above this one:  	'../file.php'
?>
<p>
	<h1>Brad Grimshaw Fan Club</h1>
	<p>Number of members: You and Brad Grimshaw</p>
	<p>If you were actually looking for Brad Grimshaw's fan club page, you're in luck! You've found it! This is the most exclusive fan club you will ever find as you and Brad Grimshaw are the only people aware of this website.</p>
	<p>Otherwise, you're probably in the wrong place. You have no idea who Brad Grimshaw is do you?</p>
	<p>You have no business here. Get out of here.</p>
</p>
<?php
	include('./templates/footer.php');
	// final php tag not necessary, some say it runs faster without it
