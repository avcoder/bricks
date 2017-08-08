<?php
    // access current session
    require_once 'auth.php';
    require_once 'dbconnect.php';

    $admin_id = (isset($_GET['admin_id']) ? $_GET['admin_id'] : null);

    // set the query command
    $sql = "DELETE FROM users WHERE user_id = :admin_id";

    // pass the input vars to the sql command
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);

    // execute sql
    $cmd->execute();

    // disconnect
    $conn = null;

    // redirect user to another page
    header('location:admins.php');

?>




