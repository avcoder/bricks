<?php ob_start(); ?>

<?php

require_once 'auth.php';
// for <title> tag
$page_title = 'Edit Admin';
include_once 'header.php';
require_once 'dbconnect.php';

// initialize vars so that fields are clear
$username = "";
$password = "";
$confirm = "";

// get the form inputs
$username = (isset($_POST['username']) ? $_POST['username'] : null);
$password = (isset($_POST['password']) ? $_POST['password'] : null);
$confirm = (isset($_POST['confirm']) ? $_POST['confirm'] : null);

// check the url if admin_id parameter passed; if so, store the value
if (empty($_GET['admin_id']) == false) {
    $admin_id = $_GET['admin_id'];

    // write sql query
    $sql = "SELECT * FROM users WHERE user_id = :admin_id";

    // execute query
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
    $cmd->execute();
    $admin = $cmd->fetch();

    // populate fields
    $username = $admin['username'];

    // disconnect
    $conn = null;
}
?>

<div class="divider"></div>
  <div class="section">

    <div class="container">

        <div class="row">
        <div class="col s6 offset-s4">
            <h1>Edit Admin</h1>
            <form method="post" action="update-admin.php">
                <div class="row">
                    <div class="input-field col s8">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="icon_prefix" type="email" class="validate" name="username" required value="<?php echo $username; ?>">
                    <label for="icon_prefix">Email address</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s8">
                    <i class="material-icons prefix">vpn_key</i>
                    <input id="password" type="password" class="validate" name="password" required>
                    <label for="password">Type new password</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s8">
                    <i class="material-icons prefix">repeat</i>
                    <input id="confirm" type="password" class="validate" name="confirm" required>
                    <label for="confirm">Confirm new password</label>
                    </div>
                </div>     

                <input type="hidden" id="admin_id" name="admin_id" value="<?php echo $admin_id; ?>">

                <div class="row">
                    <button class="btn-large blue darken-4 waves-effect waves-light col s8" type="submit" name="action">Save Changes
                        <i class="material-icons right">send</i>
                    </button>       
                </div>
            </form>
        </div>
        </div>

    </div> <!-- container -->
</div> <!-- section -->


<?php include_once 'footer.php'; ?>
<?php ob_flush(); ?>