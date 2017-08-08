<?php
ob_start();
session_start(); 
include_once 'header.php';
require_once 'dbconnect.php';

// get the form inputs
$nav_heading = (isset($_POST['nav_heading']) ? $_POST['nav_heading'] : null);
$page_id = (isset($_POST['page_id']) ? $_POST['page_id'] : null);



if (empty(trim($nav_heading))) {
    // if nothing was given, don't change any records
    // do nothing
}

else {
    // set up and execute query
    $sql = "UPDATE pages SET nav_heading = :nav_heading WHERE page_id = :page_id";

    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':nav_heading', $nav_heading, PDO::PARAM_STR, 50);
    $cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
    $cmd->execute();

    // disconnect
    $conn = null;

}

header('location:page.php?page_id=' . $page_id);
include_once 'footer-admin.php';
ob_flush();
?>

