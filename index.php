<?php
  session_start();
  $dir = dirname(__FILE__);
  include_once($dir . "/functions/database_functions.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/audio-player.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <audio id="music-player"></audio>

    <div class="container">
      <div class="page-header">
      <h1>Music Player <small>Slogan</small></h1>
      </div>
      <div class="list-group">
      <!--Cart-->
      <div class="list-group-item ignore text-right">
        <a href="cart.php">Shopping Cart(<?php echo (isset($_SESSON['cart']) ? count($_SESSION['cart']) : 0); ?>)</a>
      </div>
        <!--LIST OF MUSIC-->
      <?php
        try {
          $beats = array();
          $beats = get_beats_for_sale();
        } catch (Exception $e) {
          echo '        
        <div class="panel panel-danger">
          <div class="panel-heading">
            <h3 class="panel-title">Warning!</h3> 
          </div>
          <div class="panel-body">We are currently undergoing maintenance, please come back later.</div>
        </div>';
          die();
        }

        if(count($beats))
          foreach($beats as $beat)
          {
            echo "        
        <div class=\"list-group-item\" src=\"{$beat['fileName']}\">
          <div class=\"pull-right\">
            <button class=\"btn btn-default pull-right\" onClick=\"showPrices({$beat['beatID']})\">Add To Cart</button>
          </div>

          <p>{$beat['title']}</p> 
          <small>{$beat['category']}</small>
        </div>
        <div id=\"{$beat['beatID']}\" class=\"list-group-item ignore hidden\" style=\"background:#3c3c3c;\">
          <button class=\"btn btn-sm btn-primary\">Lease ($699.25)</button> 
          <button class=\"btn btn-sm btn-primary\">Exclusice ($1099.99)</button>
        </div>
        ";
          }
        else{
          echo '
        <div class="panel panel-warning">
          <div class="panel-heading">
            <h3 class="panel-title">Notice!</h3>
          </div> 
          <div class="panel-body">The website owner has yet to upload any beats, please come back later.</div>
        </div>';
        }
        
      ?>

        <!--CONTROLLS-->
        <div id="controls" class="list-group-item ignore text-center">
          <div class="btn-group" role="group" aria-label="Player Buttons">
            <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-fast-backward"></span></button>
            <button type="button" class="btn btn-default play-pause"><span class="glyphicon glyphicon-play"></span></button>
            <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-fast-forward"></span></button>
          </div>
          <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
              <span class="sr-only">60% Complete</span>
            </div>
          </div>
        </div>
      </div>
    </div>
      <!--ALTERNATIVE CONTROLLS-->
      <footer class="text-center hidden">
        <div class="btn-group" role="group" aria-label="Player Buttons">
            <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-fast-backward"></span></button>
            <button type="button" class="btn btn-default play-pause"><span class="glyphicon glyphicon-play"></span></button>
            <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-fast-forward"></span></button>
          </div>
          <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
              <span class="sr-only">60% Complete</span>
            </div>
          </div>
      </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/audio-player.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>