<?php 
    // for <title> tag
    $page_title = 'Add page';
    require_once 'auth.php';
    require_once 'dbconnect.php';
    include_once 'header.php' ;

    // doublecheck to ensure there is a page id sent from previous page
    // otherwise redirect
    $page_id = (isset($_GET['page_id']) ? $_GET['page_id'] : null);
    if (empty($page_id)) {
        header('location:pages.php');
    }


    // fetch content for page 
    $sql = 'SELECT * FROM pages WHERE page_id = :page_id';
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
    $cmd->execute();

    $content_sql = $cmd->fetch(PDO::FETCH_ASSOC);
    $content_obj = json_decode($content_sql['content']);
    // to access data use php object notation $content_obj->keyname;

    // disconnect
    $conn = null;

?>

<div class="divider"></div>

<div class="section">
    <!-- Page Layout here -->
    <div class="row">
        <div class="col s3 grey lighten-2">
            <!-- Grey navigation panel -->
            <h5>Edit menu title</h5>
            
            <form method="post" action="save-page.php">
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">title</i>
                        <input id="nav_heading" type="text" class="validate" name="nav_heading" required value="<?php echo $content_sql['nav_heading']; ?>">
                        <label for="nav_heading">Navigation Heading</label>
                    </div>
                </div>

                <input type="hidden" id="page_id" name="page_id" value="<?php echo $page_id; ?>">      

                <div class="row">
                    <a href="default.php?page_id=<?php echo $page_id; ?>" target="_blank" class="purple darken-4 waves-effect waves-light btn col s4">Preview</a>                   
                    <span class="col s4"></span>
                    <button class="btn blue darken-4 waves-effect waves-light col s4" type="submit" name="action">Save
                        <i class="material-icons right">save</i>
                    </button>       
                </div>
            </form>
        </div>
        <div class="col s9">

<?php
try {

// start table and headings + css framework containers

    echo '<div class="container"><div class="row"><div class="col s12">';
    echo '<h5>Bricks added to this page</h5>';
    echo '<p class="center-align"><a href="prepage2.php?page_id=' . 
                $page_id . 
            '" class="btn-floating btn-large waves-effect waves-light light-green darken-1"><i class="material-icons">add</i></a></p>';
    echo '<table class="table striped highlight bordered">
            <thead>
            <tr>
                <th>Brick</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead><tbody>';

// only display data if the query came up with at least 1 result, otherwise show nothing
if (!empty($content_sql['content'])) {

// display data, must do a double forloop to iterate the array of objects
    foreach ($content_obj as $key=>$value) {

// print each title as a row, must filter only titles first using if statement    
        echo '<tr><td>' . $value->title . '</td>
                <td><a href="edit-style.php?page_id=' . $page_id . '&style_id=' . $value->style_id . '&title=' . $value->title . '"><i class="material-icons">mode_edit</i></a></td>
                <td><a href="delete-style.php?page_id=' . $page_id . '&style_id=' . $value->style_id . '&title=' . $value->title .  '" onclick="return confirm(\'Are you sure you want to delete this admin?\');"><i class="material-icons">delete_forever</i></a></td></tr>';
    }
}

// end table
    echo '</tbody></table>';
    echo '</div></div></div>'; // end css framework


}

// if there is an error in the SQL statement, get notification, then redirect page to error.php
catch(Exception $e) {
    //mail('albertvillaruz@gmail.com', 'COMP1006 Web App Error', $e);
    header('location:error.php');
}

?>


    </div> <!-- row -->
</div> <!-- section -->

        

<?php include_once 'footer-admin.php' ?>