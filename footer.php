<?php
require 'dbconnect.php';

$styleblock1 = array(
                "style_to_use"=>1,
                "left_title"=>"Company Bio",
                "left_para"=>"We are a team of college students working on this project like it\'s our full time job. Any amount would help support and continue development on this project and is greatly appreciated.",
                "mid_title"=>"Settings",
                "mid_list"=>["Link 1", "Link 2", "Link 3", "Link 4"],
                "right_title"=>"Connect",
                "right_list"=>["Link 1", "Link 2", "Link 3", "Link 4"],
                "copyright"=>"Hand-coded by Albert Villaruz &copy; 2017"
               );

$content_json1 = json_encode($styleblock1);



$sql = 'UPDATE pages SET content = (:content_json1) WHERE page_id = 1';
$cmd = $conn->prepare($sql);
$cmd->bindParam(':content_json1', $content_json1, PDO::PARAM_STR, 65536);
$cmd->execute();

// fetch content for page 
$sql = 'SELECT content FROM pages WHERE page_id = 1';
$cmd = $conn->prepare($sql);
$cmd->execute();

$content_sql = $cmd->fetch(PDO::FETCH_ASSOC);
$styleblock2 = json_decode($content_sql['content']);
// to access data use php object notation $styleblock2->left_title;

$conn = null;

?>

  <footer class="page-footer teal">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text"><?php echo $styleblock2->left_title; ?></h5>
          <p class="grey-text text-lighten-4"><?php echo $styleblock2->left_para; ?></p>


        </div>
        <div class="col l3 s12">
          <h5 class="white-text"><?php echo $styleblock2->mid_title; ?></h5>
          <ul>
            <?php
              foreach ($styleblock2->mid_list as $item) {
                echo '<li><a class="white-text" href="#!">' . $item . '</a></li>';
              }
            ?>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text"><?php echo $styleblock2->right_title; ?></h5>
          <ul>
            <?php
              foreach ($styleblock2->right_list as $item) {
                echo '<li><a class="white-text" href="#!">' . $item . '</a></li>';
              }
            ?>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      <?php echo $styleblock2->copyright; ?>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
