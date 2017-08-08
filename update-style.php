<?php
ob_start();
require_once 'auth.php'; // to store user_id once registration is sucessful
$page_title = 'Updating Admin';
include_once 'header.php';
require_once 'dbconnect.php';


// get the form inputs
$title = (isset($_POST['title']) ? $_POST['title'] : "");
$content = (isset($_POST['content']) ? $_POST['content'] : "");
$page_id = (isset($_POST['page_id']) ? $_POST['page_id'] : null);
$style_id = (isset($_POST['style_id']) ? $_POST['style_id'] : null);

// this value will be used later to know whether to UPDATE or INSERT
// $found is the index of the object that we want to update
$found = (isset($_POST['found']) ? $_POST['found'] : -1);
 

// transform above text content into json, starting with array, then json encode
$content_json = json_encode(array(
                    'style_id'=>$style_id,
                    'title'=>$title, 
                    'content'=>$content
                ));



// fetch content, if any, for page and append new blockstyle
$sql = 'SELECT * FROM pages WHERE page_id = :page_id';
$cmd = $conn->prepare($sql);
$cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
$cmd->execute();

$content_sql = $cmd->fetch(PDO::FETCH_ASSOC);
$content_obj = json_decode($content_sql['content']);
// to access data use php object notation $content_obj->keyname;



// update object with new blockstyle
$content_new = array('style_id'=>$style_id,
                'title'=>$title, 
                'content'=>$content);

// test if previous entry was found, in which case we need to update
if ($found == -1) {
    echo "found is -1 <br>";
    // if there was previous content, then append, else create new content
    if (!empty($content_obj)) {
        array_push($content_obj, $content_new);
    } else {    
        $content_obj = array($content_new);
    }
} elseif ($found >= 0) {
    echo "entered elseif <Br>";
    echo "title is " . $content_obj[$found]->title . "<Br>";
    echo "content is " . $content_obj[$found]->content;
    $content_obj[$found]->title = $title;
    $content_obj[$found]->content = $content;
}

$content_json = json_encode($content_obj);

// update record
$sql = "UPDATE pages SET content = :content WHERE page_id = :page_id";

$cmd = $conn->prepare($sql);
$cmd->bindParam(':content', $content_json, PDO::PARAM_STR, 2048);
$cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
$cmd->execute();

// disconnect
$conn = null;


// redirect
header('location:page.php?page_id=' . $page_id);

?>





<?php ob_flush(); ?>