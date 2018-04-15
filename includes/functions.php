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

  function isAdmin() {
    //Query db for admin
  }

  function isAlreadyRegistered($userName) {
    try {
			$search_dir = './users';
			$contents = scandir($search_dir);

			foreach ($contents as $item) {
        if ( (is_dir($search_dir . '/' . $item)) && (substr($item, 0, 1) != '.') ) {
          if (strtok($item, '.') == $userName) {
            return true;
          }
          else {
            return false;
          }
        }
      }
		} catch (\Exception $e) {

		}
  }
?>
