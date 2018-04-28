<?php
	define('TITLE', 'Contact');
	include './templates/header.php';
	require './phpmailer/PHPMailerAutoload.php';
?>

<?php
	if (!isloggedin()) {
		header('Location: index.php');
		ob_end_clean();
		exit();
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (!empty(trim($_POST['email'])) && !empty(trim($_POST['subject'])) && !empty(trim($_POST['message']))) {

			include '../config.php';

			$mail = new PHPMailer;
	    $mail->isSMTP();
	    $mail->SMTPAuth = true;
			$mail->Host = $host;
	    $mail->Username = $username;
	    $mail->Password = $password;
	    $mail->SMTPSecure = 'ssl';
	    $mail->Port = 465;

	    $mail->addAddress($username); // Send to self
	    $mail->FromName = trim(stripslashes($_POST['email']));
	    $mail->Subject = trim(stripslashes($_POST['subject']));
	    $mail->Body    = trim(stripslashes($_POST['message']));

	    if(!$mail->send())
	    {
	        print '<p class="input--error">Something went wrong. Please try again.</p>';
	    }
	    else
	    {
	        print '<p class="input--error">Message Sent</p>';
	    }
		}
		else {
			if (empty($_POST['email'])) {
				print '<p style="color: red;">You must enter an email address</p><br>';
			}
			if (empty($_POST['email'])) {
				print '<p style="color: red;">You must enter a subject</p><br>';
			}
			if (empty($_POST['email'])) {
				print '<p style="color: red;">You must enter a message</p>';
			}
			print '<form action="email.php" method="post" class="form--inline">
				<p>Email Address: <input type="email" name="email" size="20"></p>
				<br>
				<p>Subject: <input type="text" name="subject" size="20"></p><br>
	      <p>Message:</p>
				<p><textarea name="message" rows="10" cols="60"></textarea></p>
				<br><br>
				<p><input type="submit" name="submit" value="Submit" class="button--pill"></p>
						</form>';
		}
	}
	else if (isset($_SESSION['loggedin']) && ($_SERVER['REQUEST_METHOD'] == 'GET')) {
		print '<form action="email.php" method="post" class="form--inline">
			<p>Email Address: <input type="email" name="email" size="20"></p>
			<br>
			<p>Subject: <input type="text" name="subject" size="20"></p><br>
			<p>Message:</p>
			<p><textarea name="message" rows="10" cols="60"></textarea></p>
			<br><br>
			<p><input type="submit" name="submit" value="Submit" class="button--pill"></p>
					</form>';
	}
	else {
		print "<p>You must login to use the email feature.</p></br>";
		print "<p><a href=\"login.php\">Click here</a> to login</p><br>";
		print "<p>Or.. you can jot this address down and send some mail the old-fashioned way:</p></br>";
		print "<p>Brad Grimshaw</br>P.O. Box 123 Hypochondria Ln</br>Detroit, MI 48201</p>";
	}
?>



<?php
	include './templates/footer.php';
