<?php 

// for <title> tag
  $page_title = 'Blog OS';

  require_once 'dbconnect.php';
  include_once 'header.php'; 
  $page_id = (isset($_GET['page_id']) ? $_GET['page_id'] : null);

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


// only display data if the query came up with at least 1 result, otherwise show nothing
  if (!empty($content_sql['content'])) {

    foreach ($content_obj as $key=>$value) {
      switch ($value->style_id) {
        case 't1':
          include 'brick_t1.php';
          break;
        
        case 'a3':
          include 'brick_a3.php';
          break;
        
        default:
          echo 'Style number ' . $value->style_id . ' was not found. Please choose a navigation link above'; 
          //mail()
          break;
      }
    }
  }
  
?>
<!--
  <div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 class="header center teal-text text-lighten-2">Parallax Template</h1>
        <div class="row center">
          <h5 class="header col s12 light">A modern responsive front-end framework based on Material Design</h5>
        </div>
        <div class="row center">
          <a href="http://materializecss.com/getting-started.html" id="download-button" class="btn-large waves-effect waves-light teal lighten-1">Get Started</a>
        </div>
        <br><br>

      </div>
    </div>
    <div class="parallax"><img src="background1.jpg" alt="Unsplashed background img 1"></div>
  </div>-->


  <!--<div class="container">
    <div class="section">

   
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons">flash_on</i></h2>
            <h5 class="center">Speeds up development</h5>

            <p class="light">We did most of the heavy lifting for you to provide a default stylings that incorporate our custom components. Additionally, we refined animations and transitions to provide a smoother experience for developers.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons">group</i></h2>
            <h5 class="center">User Experience Focused</h5>

            <p class="light">By utilizing elements and principles of Material Design, we were able to create a framework that incorporates components and animations that provide more feedback to users. Additionally, a single underlying responsive system across all platforms allow for a more unified user experience.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons">settings</i></h2>
            <h5 class="center">Easy to work with</h5>

            <p class="light">We have provided detailed documentation as well as specific code examples to help new users get started. We are also always open to feedback and can answer any questions a user may have about Materialize.</p>
          </div>
        </div>
      </div>

    </div>
  </div>-->



<!--
  <div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row center">
          <h5 class="header col s12 light">A modern responsive front-end framework based on Material Design</h5>
        </div>
      </div>
    </div>
    <div class="parallax"><img src="background3.jpg" alt="Unsplashed background img 3"></div>
  </div>-->

<?php include_once 'footer-admin.php'; ?>