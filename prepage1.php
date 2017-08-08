<?php 
    
    // for <title> tag
    $page_title = 'Add page | Add Nav Heading';
    require_once 'auth.php';
    include_once 'header.php' 
?>

<div class="divider"></div>
    <div class="section">


        <!-- Page Layout here -->
        <div class="row">

            <div class="col s4 offset-s4 grey lighten-2">
                <!-- Grey navigation panel -->
                <h5>Add Page</h5>
                <form method="post" action="save-prepage1.php">
                    <div class="row">
                        <div class="input-field col s12">
                        <i class="material-icons prefix">title</i>
                        <input id="nav_heading" type="text" class="validate" name="nav_heading" required>
                        <label for="nav_heading">Type new menu heading</label>
                        </div>
                    </div>
                    <div class="row">                     
                        <span class="col s4"></span>
                        <button class="btn blue darken-4 waves-effect waves-light col s4" type="submit" name="action">Save
                            <i class="material-icons right">save</i>
                        </button>       
                    </div>
                </form>
            </div>
        </div>

    </div> <!-- section -->

        

<?php include_once 'footer-admin.php' ?>