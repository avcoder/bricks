<?php ob_start(); ?>

<?php

require_once 'auth.php';
// for <title> tag
$page_title = 'Edit Brickstyle';
include_once 'header.php';


$page_id = (isset($_GET['page_id']) ? $_GET['page_id'] : null);
$style_id = (isset($_GET['style_id']) ? $_GET['style_id'] : null);
// if title is in url, then we will update, otherwise it's insert.
$title = (isset($_GET['title']) ? $_GET['title'] : null); 

// doublecheck to ensure there is a page id sent from previous page
// otherwise redirect
if (empty($page_id)) {
    header('location:pages.php');
    exit;
}


if ($style_id == 'a1') {    
    include_once 'edit_brick_a1.php';
} elseif ($style_id == 'a2') {    
    include_once 'edit_brick_a2.php';
} elseif ($style_id == 'a3') {    
    include_once 'edit_brick_a3.php';
} elseif ($style_id == 'b1') {    
    include_once 'edit_brick_b1.php';
} elseif ($style_id == 'c1') {    
    include_once 'edit_brick_c1.php';
} elseif ($style_id == 'p1') {    
    include_once 'edit_brick_p1.php';
} elseif ($style_id == 't1') {    
    include_once 'edit_brick_t1.php';                        
} else {
    echo 'Style number ' . $style_id . ' was not found. Please choose a navigation link above';
    // mail();
}

?>


<?php include_once 'footer-admin.php'; ?>
<?php ob_flush(); ?>