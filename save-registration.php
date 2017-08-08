<?php
ob_start();
session_start(); // to store user_id once registration is sucessful

$page_title = 'Registering';

include_once 'header.php';
require_once 'dbconnect.php';


// get the form inputs
$username = (isset($_POST['username']) ? $_POST['username'] : null);
$password = (isset($_POST['password']) ? $_POST['password'] : null);
$confirm = (isset($_POST['confirm']) ? $_POST['confirm'] : null);


$is_PasswordOK = true;

// accumulate error messages here, if any
$errors = null;  

// validate inputs
if (empty($username)) {
    $errors .= '<p class="orange darken-4">Username is required<p>';
    $is_PasswordOK = false;
}

if (empty($password)) {
    $errors .= '<p class="orange darken-4">Password is required<p>';
    $is_PasswordOK = false;
}

if ($password != $confirm) {
    $errors .= '<p class="orange darken-4">Passwords do not match<p>';
    $is_PasswordOK = false;
}

// check if user already exists
  $sql = "SELECT * FROM users WHERE username = :username";

  $cmd = $conn->prepare($sql);
  $cmd->bindParam('username', $username, PDO::PARAM_STR, 50);
  $cmd->execute();
  $user = $cmd->fetch();

// if user exists, then error
  if ($user) {
    $errors .= '<p class="orange darken-4">Username already exists</p>';
    $is_PasswordOK = false;
  }

// don't disconnect $conn yet, we'll still need it
//$conn = null;


if (!$is_PasswordOK) {

echo <<<EOT

    <div class="container">
      <div class="row">
        <div class="col s6 offset-s3 center-align">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">Registration Error</span>
              
              $errors
            </div>
            <div class="card-action">
              <a href="register.php">Try Registering Again</a>
            </div>
          </div>
        </div>
      </div>
    </div>
EOT;

}


// hash pwd
if ($is_PasswordOK == true) {
    $password = password_hash($password, PASSWORD_DEFAULT);

    // set up and execute query
    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";

    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->bindParam(':password', $password, PDO::PARAM_STR, 256);
    $cmd->execute();

    // disconnect
    $conn = null;

    // show msg to user
    // echo 'Registration successful';

    // registration success, store session var then redirect
    $_SESSION['user_id'] = $username;
    header('location:admins.php');
}
?>





<?php include_once 'footer.php'; ?>
<?php ob_flush(); ?>