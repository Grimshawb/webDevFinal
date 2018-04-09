<?php
  function printEmailForm() {
    print '<form action="email.php" method="post" class="form--inline">
			<p><label for="email">Email Address:</label><input type="email" name="email" size="20"></p>
			<br><br>
			<p><label for="subject">Subject:</label><input type="text" name="subject" size="20"></p><br><br>
      <p>Message:</p>
			<p><textarea name="message" rows="10" cols="60"></textarea></p>
			<br><br>
			<p><input type="submit" name="submit" value="Submit" class="button--pill"></p>
		</form>';
  }
?>
