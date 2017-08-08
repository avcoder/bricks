<?php ob_start(); ?>
<?php
session_start();
include_once 'header.php';
require_once 'dbconnect.php';

$username = (isset($_POST['username']) ? $_POST['username'] : null);
$password = (isset($_POST['password']) ? $_POST['password'] : null);

// set up sql and execute
$sql = "SELECT * FROM users WHERE username = :username";

$cmd = $conn->prepare($sql);
$cmd->bindParam('username', $username, PDO::PARAM_STR, 50);
$cmd->execute();
$user = $cmd->fetch();

// echo "password is " . $password;
// echo "hashed password is " . $user['password'];
// echo "password_verify is " . password_verify($password, $user['password']);

// if count is 1 then we found a matching username in db.  Check pwd.
if (password_verify($password, $user['password'])) {

    // user found, store session var then redirect
    $_SESSION['user_id'] = $user['user_id'];
    header('location:pages.php');

} else {

    // user not found
    header('location:login.php?invalid=true');
    exit();
}

// disconnect
$conn = null;

?>

<?php include_once 'footer.php'; ?>

<?php ob_flush(); ?>
