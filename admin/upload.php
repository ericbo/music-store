<?php
session_start();

$dir = dirname(__FILE__);
include_once($dir . "/../functions/database_functions.php");
include_once($dir . "/../functions/helper_functions.php");

if(empty($_SESSION['user']))
{
  header('Location: '. get_base_url() . 'admin/index.php');
  die();
}

$success = false;
if(isset($_POST['submit']) && isset($_POST['title']) && isset($_POST['category']) && isset($_FILES['beat']) && isset($_POST['lease']) && isset($_POST['exclusive']))
{
  $uploaddir = $dir . '/../music/';
  $fileName = basename($_FILES['beat']['name'], '.mp3');
      try
      {
        if (isset($_SERVER['CONTENT_LENGTH']) && (int) $_SERVER['CONTENT_LENGTH'] > convert_to_bytes(ini_get('post_max_size'))) {
          throw new Exception('File too large!');
        }
        
        if(!move_uploaded_file($_FILES['beat']['tmp_name'], $uploaddir . $fileName . ".mp3")) {
          throw new Exception("Could not upload file.");
        }
        shell_exec("avconv -i {$uploaddir}{$fileName}.mp3 -c:a libvorbis -q:a 4 {$uploaddir}/{$fileName}.ogg");
        if(!file_exists("{$uploaddir}/{$fileName}.ogg")) {
          throw new Exception("Could not generate ogg file type.");
        }
        add_beat($_POST['title'], $_POST['category'], $fileName, $_POST['lease'], $_POST['exclusive']);
        $success = true;

      } catch (Exception $e) {
        //$error = "Something bad happend, please message the website administrator.";
        $error = $e->getMessage();
      }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Upload a Beat</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/dash.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>

    </style>
  </head>
  <body>
   <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Welcome, Eric!</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo get_base_url() . "admin/beats.php" ?>">Dashboard</a></li>
            <li><a href="<?php echo get_base_url() . "admin/logout.php" ?>">Log Out</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
    <h1 class="page-header">Upload a Beat</h1>

      <form class="form-horizontal" action="upload.php" method="POST" enctype="multipart/form-data">
        <?php 
          if(isset($error))
            echo '<div class="alert alert-danger" role="alert"><strong>Error!</strong> ' . $error . '</div>';
          else
            if($success)
              echo '<div class="alert alert-success" role="alert"><strong> Success!</strong> Beat has been uploaded.</div>';
        ?>
      <fieldset>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="title">Title</label>  
        <div class="col-md-4">
        <input id="title" name="title" placeholder="Beat Name" class="form-control input-md" required="" type="text">
          
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="category">Category</label>  
        <div class="col-md-4">
        <input id="category" name="category" placeholder="Category" class="form-control input-md" required="" type="text">
          
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="category">Lease Price</label>  
        <div class="col-md-4">
        <input id="lease" name="lease" placeholder="Lease Price" class="form-control input-md" required="" type="text">
          
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="category">Exclusive Price</label>  
        <div class="col-md-4">
        <input id="exclusive" name="exclusive" placeholder="Exclusive Price" class="form-control input-md" required="" type="text">
          
        </div>
      </div>

      <!-- File Button --> 
      <div class="form-group">
        <label class="col-md-4 control-label" for="beat">Beat (mp3)</label>
        <div class="col-md-4">
          <input id="beat" name="beat" class="input-file" type="file">
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-4 control-label" for="submit"></label>
        <div class="col-md-4">
          <button id="submit" name="submit" class="btn btn-primary btn-block">Upload</button>
        </div>
      </div>

      </fieldset>
      </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>