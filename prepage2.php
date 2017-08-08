<?php 
    // for <title> tag
    $page_title = 'Add page';
    require_once 'auth.php';
    include_once 'header.php'; 
    require_once 'dbconnect.php';

    $page_id = (isset($_GET['page_id']) ? $_GET['page_id'] : null);
    //echo 'page id is ' . $page_id;


    // doublecheck to ensure there is a page id sent from previous page
    // otherwise redirect
    $page_id = (isset($_GET['page_id']) ? $_GET['page_id'] : null);
    if (empty($page_id)) {
        header('location:pages.php');
    }


    // query db for admins
    $sql = 'SELECT * FROM styles';
    $cmd = $conn->prepare($sql);
    $cmd->execute();

    $styles = $cmd->fetchAll();

?>

<h3>Add a Brickstyle</h3>
<main style="display: flex; flex-wrap: wrap; justify-content: space-around;">

<?php 
foreach ($styles as $style) {
        
    echo '<div class="card" style="width: 300px;">';
        echo '<div class="card-image">';
            echo '<img src="images/' . $style['sample_image']. '">';
            echo '<span class="teal darken-1 white-text">' . $style['call_num'] . '</span>';
            echo '<a href="edit-style.php?page_id=' . $page_id . '&style_id=' . $style['call_num'] . '" class="btn-floating halfway-fab waves-effect waves-light green accent-3"><i class="material-icons">add</i></a>';
        echo '</div>';
    echo '</div>';
}
?>

</main>
<br />

        

<?php include_once 'footer-admin.php' ?>