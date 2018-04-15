<?php
	define('TITLE', 'Contact');
	include './templates/header.php';
	require './phpmailer/PHPMailerAutoload.php';
?>

<?php
	if (!empty($_SESSION['loggedin']) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {
		if (!empty(trim($_POST['email'])) && !empty(trim($_POST['subject'])) && !empty(trim($_POST['message']))) {
			print '<h3 style="color: green;">Email Sent Successfully</h3>';
			// $mail = new PHPMailer;
	    // $mail->isSMTP();
	    // $mail->SMTPAuth = true;
	    // //$mail->SMTPDebug = 1;   // debug set to 1, 2, or 3 to show more or less details for error messages
			//
			// $mail->Host = 'smtp.gmail.com';       // host name for email service
	    // $mail->Username = '';                 // username for email account you can have the @ extension or leave it off
	    // $mail->Password = '';                 // password for email account
	    // $mail->Sender = '';                   // Email address of the sending email
	    // $mail->SMTPSecure = 'ssl';
	    // $mail->Port = 465;
			//
	    // $mail->addAddress('');                // Add a recipient
	    // $mail->FromName = 'Chris';            // the name you want to appear
	    // $mail->Subject = 'Test';              // Subject
	    // $mail->Body    = 'Testing';           // Message
			//
	    // if(!$mail->send())
	    // {
	    //     print '<p><h3 style="color: red;">ERROR! Unable to send Email<h3></p>';
	    // }
	    // else
	    // {
	    //     print '<h3 style="color: green;">Email Sent Successfully</h3>';
	    // }
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
			printEmailForm();
		}
	}
	else if (isset($_SESSION['loggedin']) && ($_SERVER['REQUEST_METHOD'] == 'GET')) {
		printEmailForm();
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
