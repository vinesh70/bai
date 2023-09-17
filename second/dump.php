<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    @$login = false;
    @$ShowError = false;
    @$EmailError = false;

    include 'partials/_db_connect.php';

    $emailOrUsername = $_POST["emailOrUsername"];
    $password = $_POST["password"];

    // Check if the input is a valid email
    if (filter_var($emailOrUsername, FILTER_VALIDATE_EMAIL)) {
        // If it's an email, search in both user and servant tables
        $user_sql = "SELECT * FROM users_details WHERE email = '$emailOrUsername'";
        $servant_sql = "SELECT * FROM servent_details WHERE b_email = '$emailOrUsername'";
    } else {
        // If it's not an email, search in both user and servant tables
        $user_sql = "SELECT * FROM users_details WHERE username = '$emailOrUsername'";
        $servant_sql = "SELECT * FROM servent_details WHERE b_username = '$emailOrUsername'";
    }

    // Attempt to log in as a user
    $user_result = mysqli_query($conn, $user_sql);
    $user_num = mysqli_num_rows($user_result);

    if ($user_num == 1) {
        $user_row = mysqli_fetch_assoc($user_result);
        if (password_verify($password, $user_row['password'])) {
            $login = true;

            $name = $user_row['name'];

            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $user_row['email'];
            $_SESSION['name'] = $name;

            header("location: welcome.php");
        } else {
            $ShowError = true;
        }
    } else {
        // Attempt to log in as a servant
        $servant_result = mysqli_query($conn, $servant_sql);
        $servant_num = mysqli_num_rows($servant_result);

        if ($servant_num == 1) {
            $servant_row = mysqli_fetch_assoc($servant_result);
            if (password_verify($password, $servant_row['b_password'])) {
                $login = true;

                $b_name = $servant_row['b_name'];

                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['b_email'] = $servant_row['b_email'];
                $_SESSION['b_name'] = $b_name;

                header("location: welcome_bai.php");
            } else {
                $ShowError = true;
            }
        } else {
            $ShowError = true;
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        body {
            background-color: #f3f7fb;
        }
        .container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }
        .form-label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #ff6b6b;
            border-color: #ff6b6b;
        }
        .btn-primary:hover {
            background-color: #ff4141;
            border-color: #ff4141;
        }
    </style>

</head>
<body>
    <?php require 'partials/_nav.php' ?>

    <?php

        if(@$login)
        {
          echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> You are Logged in.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> ';
        }

        if(@$ShowError)
        {
          echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> Invalid Credentials
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> ';
        }
    ?>

    <div class="container my-4">
        <h1 class="text-center mb-4">Hello welcome back,<br>Login to our Website!</h1>
        <form method="post">

            <!-- Email or Username -->
            <div class="mb-3">
                <label for="emailOrUsername" class="form-label">Email ID or Username</label>
                <input type="text" class="form-control" id="emailOrUsername" name="emailOrUsername" placeholder="Enter your Email-ID or Username" required>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter a secure password" required>
            </div>

            <button type="reset" class="btn btn-primary">Reset</button>

            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            <button type="submit" class="btn btn-primary">Login</button>

        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
