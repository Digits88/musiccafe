<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Music Cafe</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo BASE_URI; ?>templates/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo BASE_URI; ?>templates/css/custom.css" rel="stylesheet">
    <?php
      if(!isset($title)){
        $title = SITE_TITLE;
      }
     ?>

     <!-- Bootstrap core JavaScript
     ================================================== -->
     <!-- Placed at the end of the document so the pages load faster -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
     <script>window.jQuery || document.write('<script src="<?php echo BASE_URI; ?>templates/js/jquery.min.js"><\/script>')</script>
     <script src="<?php echo BASE_URI; ?>templates/js/bootstrap.min.js"></script>
     <script src="<?php echo BASE_URI; ?>templates/js/ckeditor/ckeditor.js"></script>
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Music Cafe</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse navbar-right">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
            <?php if(!isLoggedIn()): ?>
              <li><a href="register.php">Create an Account</a></li>
            <?php else: ?>
              <li><a href="create.php">Create a Topic</a></li>
            <?php endif; ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="main-col">
            <div class="block">
              <h1 class="pull-left"><?php echo $title; ?></h1>
              <h4 class="pull-right">A simple PHP Forum Engine</h4>
              <div class="clearfix"></div>
              <hr>
              <?php displayMessage(); ?>
