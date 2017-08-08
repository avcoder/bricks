<?php

require_once 'auth.php';
require_once 'dbconnect.php';

$page_id = (isset($_GET['page_id']) ? $_GET['page_id'] : null);
$style_id = (isset($_GET['style_id']) ? $_GET['style_id'] : null);
$title = (isset($_GET['title']) ? $_GET['title'] : null);
 
// fetch content, if any, for page and append new blockstyle
$sql = 'SELECT * FROM pages WHERE page_id = :page_id';
$cmd = $conn->prepare($sql);
$cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
$cmd->execute();

$content_sql = $cmd->fetch(PDO::FETCH_ASSOC);
$content_obj = json_decode($content_sql['content']);
// to access data use php object notation $content_obj->keyname;



// remove key value pairs for this blockstyle.  
// no unique id # used.  Just use style_id and title combo-key
$found = false;
foreach($content_obj as $key => $value) {
    if ($value->title == $title && $value->style_id == $style_id) {
        echo 'key is ' . $key . '<br>';
        $found = true;
        break;
    }
}

if ($found) {
    echo 'splicing<br>';
    array_splice($content_obj, $key, 1);
}
print_r($content_obj);


$content_json = json_encode($content_obj);

// update record
$sql = "UPDATE pages SET content = :content WHERE page_id = :page_id";

$cmd = $conn->prepare($sql);
$cmd->bindParam(':content', $content_json, PDO::PARAM_STR, 2048);
$cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
$cmd->execute();



// disconnect
$conn = null;



// redirect user to another page
header('location:page.php?page_id=' . $page_id);

?>