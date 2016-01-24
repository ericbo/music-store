<?php 
session_start();
$USERNAME = "demo@bottazzi.ca";
$PASSWORD = "demo";

if(empty($_SESSION['attempts']))
  $_SESSION['attempts'] = 0;

if(isset($_SESSION['user']))
{
  header('Location: '.$get_base_url() . '/beats.php');
  die();
}
elseif(isset($_POST['email']) && isset($_POST['password']))
{
  echo 'key';
  if($_SESSION['attempts'] <= 5)
    if($_POST['email'] == $USERNAME && $_POST['password'] == PASSWORD)
    {
      $_SESSION['attempts'] = 0;
      $_SESSION['user'] = $USERNAME;
      header('Location: '.$get_base_url() . '/beats.php');
      die();
    }
    else
      $_SESSION['attempts'] += 1;
    else
      echo "nope";
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
        <label for="email" class="sr-only">Email address</label>
        <input type="email" id="email" class="form-control" placeholder="Email address" required autofocus>
        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" class="form-control" placeholder="Password" required>
        <!--<input class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>-->
      </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>