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
    if (!empty($_SESSION['username']) && !empty($_SESSION['password'])) {
      $username = $_SESSION['username'];
      $password = $_SESSION['passord'];

      include '../mysqli_connect.php';

      $query = "select admin from users where username='$username'
                and password='$password'";

      if ($result = mysqli_query($dbc, $query)) {
        if ($result == 'Y') {
          return true;
          mysqli_close($dbc);
        }
      }
    }
    else {
      return false;
    }
  }

  function isAlreadyRegistered($userName) {
    //query db for userName
    include '../mysqli_connect.php';

    $query = "select * from users where username='$username'";
    $result = mysqli_query($dbc, $query);
    $numRows = mysqli_num_rows($result);
    if ($numRows == 1) {
      return true;
    }
    else {
      return false;
    }

    mysqli_close($dbc);
  }
?>
