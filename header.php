<?php
  require_once 'dbconnect.php';
// query db for pages
  $sql = 'SELECT * FROM pages';
  $cmd = $conn->prepare($sql);
  $cmd->execute();

  $pages = $cmd->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>
    <?php 
// page title defined in parent php file
      $page_title = (isset($page_title) ? $page_title : "Blog OS");
      echo $page_title;
    ?>
  </title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>

  <nav class="white" role="navigation">
    <div class="nav-wrapper container">
      

<?php if (!empty($_SESSION['user_id'])) {       ?>
      <a id="logo-container" href="index.php" class="brand-logo">Logo</a>

      <ul class="right hide-on-med-and-down">
        <li><a href="admins.php">Administrators</a></li>
        <li><a href="pages.php">Pages</a></li>
        <li><a href="logo.php">Logo</a></li>
        <li><a href="index.php">Public Site</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a href="admins.php">Administrators</a></li>
        <li><a href="pages.php">Pages</a></li>
        <li><a href="logo.php">Logo</a></li>
        <li><a href="index.php">Public Site</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>

<?php } else { ?>
      <a id="logo-container" href="index.php" class="brand-logo center">Logo</a>

      <!-- Dropdown Structure hidden until user selects this -->
      <ul id="dropdown1" class="dropdown-content">
<?php // display data
        foreach ($pages as $page) {
          echo '<li><a href="index.php?page_id=' . $page['page_id']. '">' . $page['nav_heading'] . '</a></li>';
        }
?>
   
      </ul>

      <ul class="left hide-on-med-and-down">
        <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Site Map<i class="material-icons right">arrow_drop_down</i></a></li>
      </ul>
      
      <ul class="right hide-on-med-and-down">
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a href="default.php?page_id=1">Home</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
      </ul>

<?php } ?>

      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
