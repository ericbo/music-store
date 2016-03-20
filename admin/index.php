<?php
session_start();
//Includes
$dir = dirname(__FILE__);
include_once($dir . "/../functions/helper_functions.php");

//Creds
$USERNAME = "demo@bottazzi.ca";
$PASSWORD = '$2y$10$YpK65MbfVwV4K3WimmNiK.xxgfCiSfhtbpriyBH6EQogbbn49g3RS';
//echo password_hash("demo", PASSWORD_DEFAULT);

if(empty($_SESSION['attempts']))
  $_SESSION['attempts'] = 0;

if(isset($_SESSION['user']))
{
  header('Location: '. get_base_url() . 'admin/beats.php');
  die();
}
elseif(isset($_POST['email']) && isset($_POST['password']))
{
  if($_SESSION['attempts'] <= 5) {
    if($_POST['email'] == $USERNAME && password_verify($_POST['password'], $PASSWORD))
    {
      $_SESSION['attempts'] = 0;
      $_SESSION['user'] = $USERNAME;
      header('Location: '. get_base_url() . 'admin/beats.php');
      die();
    } else {
      $_SESSION['attempts'] += 1;
      $error = "Invalid email or password.";
    }
  } else {
    $error = "To many login attempts, try again later.";
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
    <title>Bootstrap 101 Template</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/login.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>

    </style>
  </head>
  <body>
    <div class="container">
      <form class="form-signin" method="POST" action="index.php">
        <h2 class="form-signin-heading">Please sign in</h2>
        <?php 
          if(isset($error))
            echo '<div class="alert alert-danger" role="alert"><strong>Error!</strong> ' . $error . '</div>';
        ?>
        <label for="email" class="sr-only">Email address</label>
        <input type="email" id="email" class="form-control" placeholder="Email address" name="email" required autofocus>
        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Sign in">
      </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>