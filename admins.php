<?php ob_start(); ?>

<?php
// for <title> tag
$page_title = null;
$page_title = 'Administrators';

require_once 'auth.php';
include_once 'header.php';
require_once 'dbconnect.php';


try {

// start table and headings + css framework containers

    echo '<div class="container"><div class="row"><div class="col s12">';
    echo '<h1>Administrators</h1>';
    echo '<table class="table striped highlight bordered">
            <thead>
            <tr>
                <th>Username/Email</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead><tbody>';

// query db for admins
    $sql = 'SELECT * FROM users';
    $cmd = $conn->prepare($sql);
    $cmd->execute();

    $admins = $cmd->fetchAll();

// display data
    foreach ($admins as $admin) {

// print each admin as a new row
        echo '<tr><td>' . $admin['username'] . '</td>
                <td><a href="edit-admin.php?admin_id=' . $admin['user_id'] . '"><i class="material-icons">mode_edit</i></a></td>
                <td><a href="delete-admin.php?admin_id=' . $admin['user_id'] . '" onclick="return confirm(\'Are you sure you want to delete this admin?\');"><i class="material-icons">delete_forever</i></a></td></tr>';

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
?>


<?php include_once 'footer-admin.php'; ?>
<?php ob_flush(); ?>