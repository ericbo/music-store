<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Dashboard</title>
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
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Log Out</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 col-md-12 main">

          <h2 class="sub-header">Current Beats <small><a href="upload.php">Add a Beat</a></small></h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Title (Category)</th>
                  <th>Listens</th>
                  <th>Listens*</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><span class="glyphicon glyphicon-bookmark"></span> <a href="#">It's Snowing - LawnReality (Cinematic Song)</a></td>
                  <td>14</td>
                  <td>2</td>
                  <td>
                    <button class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-menu-down"></span></button>
                    <button class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-menu-up"></span></button>
                    <button class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
                  </td>
                </tr>
                <tr>
                  <td><a href="#">It's Snowing - LawnReality (Cinematic Song)</a></td>
                  <td>0</td>
                  <td>0</td>
                  <td>
                    <button class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-menu-down"></span></button>
                    <button class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-menu-up"></span></button>
                    <button class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>