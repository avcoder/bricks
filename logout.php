<?php ob_start();

session_start();

// remove session variables
session_unset();

// end session
session_destroy();

// redirect
header('location:login.php');

ob_flush();
?>