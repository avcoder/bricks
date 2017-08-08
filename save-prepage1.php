<?php
ob_start();
session_start(); // to store page_id once registration is sucessful

$page_title = 'Saving Title for Add Page';

include_once 'header.php';
require_once 'dbconnect.php';


// get the form inputs
$nav_heading = (isset($_POST['nav_heading']) ? $_POST['nav_heading'] : null);

$is_FormOK = true;

// accumulate error messages here, if any
$errors = null;  

// validate inputs
if (empty($nav_heading)) {
    $errors .= '<p class="orange darken-4">Title is required<p>';
    $is_FormOK = false;
}


// don't disconnect $conn yet, we'll still need it
//$conn = null;

if (!$is_FormOK) {

echo <<<EOT

    <div class="container">
      <div class="row">
        <div class="col s6 offset-s3 center-align">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">Error</span>
              $errors
            </div>
            <div class="card-action">
              <a href="prepage1.php">Try again</a>
            </div>
          </div>
        </div>
      </div>
    </div>
EOT;

}


// save title
if ($is_FormOK == true) {

    // set up and execute query
    $sql = "INSERT INTO pages (nav_heading) VALUES (:nav_heading)";

    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':nav_heading', $nav_heading, PDO::PARAM_STR, 50);
    $cmd->execute();

    // save success, store page_id as session var
    $_SESSION['page_id'] = $conn->lastInsertId();

    // disconnect
    $conn = null;


    header('location:prepage2.php?page_id='. $_SESSION['page_id']);
}
?>


<?php include_once 'footer-admin.php'; ?>
<?php ob_flush(); ?>