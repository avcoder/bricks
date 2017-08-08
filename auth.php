<?php
session_start();
// check if there is a user identity stored in session var
if (empty($_SESSION['user_id'])) {

// since user didn't login yet, we'll redirect them
header('location:login.php');
exit();
}

?>