<?php

// fetch content, if any, for page and append new blockstyle
$sql = 'SELECT * FROM pages WHERE page_id = :page_id';
$cmd = $conn->prepare($sql);
$cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
$cmd->execute();

$content_sql = $cmd->fetch(PDO::FETCH_ASSOC);
$content_obj = json_decode($content_sql['content']);
// to access data use php object notation $content_obj->keyname;

// disconnect
$conn = null;



// no unique id # used.  Just use style_id and title combo-key
$found = -1;  // had to use negatives since using null was buggy
if (!empty($content_obj)) {
    foreach($content_obj as $key => $value) {
        if ($value->title == $title && $value->style_id == $style_id) {
            $found = $key;
            break;
        }
    }
}

echo (null >= 0);

?>

<div class="divider"></div>
  <div class="section">

    <div class="container">

        <div class="row">
            <div class="col s12 " >
                
                <h1>Add/Edit Brickstyle</h1>
                <form method="post" action="update-style.php">
                    <div class="row">
                        <div class="input-field col s6 offset-s3">
                            <i class="material-icons prefix">title</i>
<?php if ($found >= 0) {  ?>
                            <input id="icon_prefix" type="text" class="validate" name="title" required value="<?php echo $content_obj[$found]->title; ?>">
<?php } else { ?>
                            <input id="icon_prefix" type="text" class="validate" name="title" required>
<?php } ?>                            
                            <label for="icon_prefix">Title</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
<?php if ($found >= 0) { ?>                        
                        <textarea id="content" class="materialize-textarea" name="content"><?php echo $content_obj[$found]->content; ?></textarea>
<?php } else { ?>
                        <textarea id="content" class="materialize-textarea" name="content"></textarea>
<?php } ?>                        
                        <label for="content">Content</label>
                    </div>
    
                    <input type="hidden" id="page_id" name="page_id" value="<?php echo $page_id; ?>">
                    <input type="hidden" id="style_id" name="style_id" value="<?php echo $style_id; ?>">
<?php if ($found >= 0) {?>
                    <input type="hidden" id="found" name="found" value="<?php echo $found; ?>">
<?php } ?>                  

                    <div class="row">
                        <button class="btn-large blue darken-4 waves-effect waves-light col s3 offset-s4" type="submit" name="action">Save Changes
                            <i class="material-icons right">save</i>
                        </button>       
                    </div>
                </form>
                
            </div>
        </div>

    </div> <!-- container -->
</div> <!-- section -->