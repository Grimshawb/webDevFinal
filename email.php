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
	        print '<p class="input--success">Message Sent</p>';
	    }
		}
		else {
			include './includes/errorMessages.php';
			print '<p class="input--error">';
			if (empty($_POST['email'])) {print $emptyEmailError . '<br>';}
			if (empty($_POST['subject'])) {print $emptySubjectError . '<br>';}
			if (empty($_POST['message'])) {print $emptyMessageError . '<br>';}
			print '</p>';
			print '<form action="email.php" method="post" class="form--inline">
				<p>Email Address: <input type="email" name="email" size="20" value="' .
				$_POST['email'] . '"></p>
				<br>
				<p>Subject: <input type="text" name="subject" size="20" value="' .
				$_POST['subject'] . '"></p><br>
	      <p>Message:</p>
				<p><textarea name="message" rows="10" cols="60">' . $_POST['message'] .'</textarea></p>
				<br><br>
				<p><input type="submit" name="submit" value="Submit" class="button--pill"></p>
						</form>';
		}
	}
	else {
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
	include './templates/footer.php';
