<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    @$ShowAlert = false;
    @$ShowError = false;
    @$EmailError = false;
    @$UsernameError = false;

    include 'partials/_db_connect.php';

    $name = $_POST["name"];
    $phoneno = $_POST["phoneno"];
    $u_state = $_POST["ustate"];
    $u_city = $_POST["u_city"];
    $u_address = $_POST["u_address"];
    $u_area = $_POST["u_area"];
    $u_landmark = $_POST["u_landmark"];
    $u_pincode = $_POST["u_pincode"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    // Check if email exists
    $emailQuery = "SELECT * FROM users_details WHERE email='$email'";
    $emailResult = mysqli_query($conn, $emailQuery);

    if (mysqli_num_rows($emailResult) > 0) {
        $EmailError = true;
    }

    // Check if username exists
    $usernameQuery = "SELECT * FROM users_details WHERE username='$username'";
    $usernameResult = mysqli_query($conn, $usernameQuery);

    if (mysqli_num_rows($usernameResult) > 0) {
        $UsernameError = true;
    }

    if ($password != $cpassword) {
        @$ShowError = true;
    }

    if ($password == $cpassword && $EmailError == false && $UsernameError == false && $ShowError == false) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $insertQuery = "INSERT INTO `users_details` (`name`, `phoneno`, `u_state`, `u_city`, `u_area`, `u_landmark`, 
        `u_address`, `u_pincode`, `email`, `username`, `password`, `dt`) VALUES ('$name', '$phoneno', '$u_state', 
        '$u_city', '$u_area', '$u_landmark', '$u_address', '$u_pincode', '$email', '$username', '$hash', 
        current_timestamp())";

        $result = mysqli_query($conn, $insertQuery);

        if ($result) {
            $ShowAlert = true;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Signup</title>
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
    if(@$ShowAlert)
    {
      echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> Your account is now created and you can login now.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div> ';
    }

    if(@$ShowError)
    {
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> Passwords do not match.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div> ';
    }

    if(@$EmailError)
    {
      echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Email Error!</strong> Email is being used previously.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div> ';
    }

    if(@$UsernameError)
    {
      echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Username Error!</strong> This username is being taken.<br> Please choose any another username.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div> ';
    }
  ?>
    
     <div class="container my-4">

        <h1 class="text-center">Hello User<br>Signup to our Website!</h1>

            <form method="post">

              <!-- Name -->
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your Full Name" aria-describedby="emailHelp" required>
              </div>

              <!-- phone number -->
              <div class="mb-3">
                <label for="number" class="form-label">Contact No.</label>
                <input type="number" class="form-control" id="phoneno" name="phoneno" placeholder="Enter your 10 Digit Mobile Number" aria-describedby="emailHelp" required>
              </div>

              <!-- State -->
            <div class="mb-3">
                <label for="state" class="form-label">State</label>
                <select class="form-select" id="u_state" name="ustate" required>
                    <option value="" selected disabled>Select your State </option>
                    <option value="maharashtra">Maharashtra</option>
                    <option value="gujarat">Gujarat</option>
                    <option value="rajasthan">Rajasthan</option>
                    <option value="andra_pradesh">Andra Pradesh</option>
                    <option value="karnataka">Karnataka</option>
                    <option value="telangana">Telangana</option>
                    <option value="tamil_nadu">Tamil Nadu</option>
                    <option value="west_bengal">West Bengal</option>
                    <option value="madhya_pradesh">Madhya Pradesh</option>
                    <option value="punjab">Punjab</option>
                    <option value="bihar">Bihar</option>
                </select>
            </div>

            <!-- City -->
            <div class="mb-3">
                <label for="bcity" class="form-label">City</label>
                <input type="text" class="form-control" id="u_city" name="u_city" placeholder="Enter your city" aria-describedby="emailHelp" required>
            </div>

            <!-- Address -->
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="u_address" name="u_address" placeholder="Enter your Full Address" aria-describedby="emailHelp" required>
              </div>

              <!-- Area -->
            <div class="mb-3">
                <label for="area" class="form-label">Area</label>
                <input type="text" class="form-control" id="u_area" name="u_area" placeholder="Enter your Area Name" aria-describedby="emailHelp" required>
              </div>

              <!-- Landmark -->
            <div class="mb-3">
                <label for="landmark" class="form-label">Landmark (Optional)</label>
                <input type="text" class="form-control" id="u_landmark" name="u_landmark" placeholder="Enter landmark if any" aria-describedby="emailHelp" >
              </div>

             <!-- pincode -->
             <div class="mb-3">
                <label for="pincode" class="form-label">PinCode</label>
                <input type="number" class="form-control" id="u_pincode" name="u_pincode" placeholder="Enter your 7 digit pincode" aria-describedby="emailHelp" required>
              </div>

              <!-- Email -->
              <div class="mb-3">
                <label for="email" class="form-label">Email ID</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your existing Email-ID" aria-describedby="emailHelp" required>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
              </div>

              <!-- Username -->
              <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Enter an unique username" aria-describedby="emailHelp" required>
              </div>

              <!-- Password -->
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter a secure password" required>
              </div>

              <!-- Confirm Password -->
              <div class="mb-3">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Enter a secure password" required>
                <div id="emailHelp" class="form-text">Make sure to type the same password</div>
            </div>

            <div class="mb-3 form-check">

            <input type="checkbox" class="form-check-input" id="exampleCheck1">

            <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="reset" class="btn btn-primary">Reset</button>
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            &nbsp; 
            <button type="submit" class="btn btn-primary">Signup</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>
</body>
</html>