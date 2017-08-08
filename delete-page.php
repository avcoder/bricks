<?php
    // access current session
    require_once 'auth.php';
    require_once 'dbconnect.php';

    $page_id = (isset($_GET['page_id']) ? $_GET['page_id'] : null);

    // set the query command
    $sql = "DELETE FROM pages WHERE page_id = :page_id";

    // pass the input vars to the sql command
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);

    // execute sql
    $cmd->execute();

    // disconnect
    $conn = null;

    // redirect user to another page
    header('location:pages.php');

?>




