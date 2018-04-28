<?php
  function isAdmin() {
    if (!empty($_SESSION['username']) && !empty($_SESSION['loggedin'])) {
      $username = $_SESSION['username'];

      include '../mysqli_connect.php';

      $query = "SELECT admin FROM users WHERE username='$username'";

      if ($result = mysqli_query($dbc, $query)) {
        $isAdmin = mysqli_fetch_array($result);
        if ($isAdmin['admin'] == 'Y') {
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
    include '../mysqli_connect.php';

    $query = "SELECT * FROM users WHERE username='$userName'";
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

  function isLoggedIn() {
    if (isset($_SESSION['username']) && isset($_SESSION['loggedin'])) {
      return true;
    }
    else {
      return false;
    }
  }

  function deleteUserDir($dir) {

    $contents = scandir($dir);

    foreach ($contents as $item) {
      if ($item != '.' && $item != '..') {
        if (is_file($dir . '/' . $item)) {
          try {
            unlink($dir . '/' . $item);
          } catch (\Exception $e) {
            print 'Exception: ' . $e;
          }
        }
        else {
          deleteUserDir(realpath($item));
        }
      }
    }

    rmdir($dir);
  }
?>
