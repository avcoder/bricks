<?php ob_start(); ?>

<?php
// for <title> tag
$page_title = null;
$page_title = 'Pages';

require_once 'auth.php';
include_once 'header.php';
require_once 'dbconnect.php';

// clear any page_id in session since we don't need it anymore
$_SESSION['page_id'] = null;

try {

// start table and headings + css framework containers

    echo '<div class="container"><div class="row"><div class="col s12">';
    echo '<h1>Pages</h1>';
    echo '<p class="center-align"><a href="prepage1.php" class="btn-floating btn-large waves-effect waves-light light-green darken-1"><i class="material-icons">add</i></a></p>';
    echo '<table class="table striped highlight bordered">
            <thead>
            <tr>
                <th>Title</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead><tbody>';

// query db for pages
    $sql = 'SELECT * FROM pages';
    $cmd = $conn->prepare($sql);
    $cmd->execute();

    $pages = $cmd->fetchAll();

// display data
    foreach ($pages as $page) {

// print each admin as a new row
        echo '<tr><td>' . $page['nav_heading'] . '</td>
                <td><a href="page.php?page_id=' . $page['page_id'] . '"><i class="material-icons">mode_edit</i></a></td>
                <td><a href="delete-page.php?page_id=' . $page['page_id'] . '" onclick="return confirm(\'Are you sure you want to delete this admin?\');"><i class="material-icons">delete_forever</i></a></td></tr>';

    }


// end table
    echo '</tbody></table>';
    echo '</div></div></div>'; // end css framework

// disconnect
    $conn = null;
}

// if there is an error in the SQL statement, get notification, then redirect page to error.php
catch(Exception $e) {
    //mail('albertvillaruz@gmail.com', 'COMP1006 Web App Error', $e);
    header('location:error.php');
}

echo <<<EOT
<footer class="page-footer teal">
    <div class="container">
        <div class="row">
        <h6 class="center-align">Edit Footer</h6>
        <p class="center-align"><a href="edit-footer.php" class="btn-floating btn-large waves-effect waves-light grey darken-1"><i class="material-icons">settings</i></a></p>
        </div>
    </div>
</footer>
EOT
?>


<?php ob_flush(); ?>