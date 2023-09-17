<?php

    session_start();

    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
    {
      header("location: login.php");
      exit;
    }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
      Welcome - Admin
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    <?php require 'partials/_nav.php' ?>
    <br> <br> &nbsp; &nbsp; &nbsp; 
    Welcome Back, Admin!
<br> <br>
    <div class="container my-4">

      <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Welcome Back, Admin></h4>
        <p>Hey how are you doing? <br> Welcome back to BaiHome. What you Wanna Do ? </p>
        <hr>
        <p class="mb-0">Whenever you need to logout make sure to <a href="/second/logout.php"> click this link. </a></p>
      </div>
      I am the Admin

      <a href="bai_signup.php" class="btn btn-primary">Click here to add a new servant</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>
