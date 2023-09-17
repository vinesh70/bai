<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    @$ShowAlert = false;
    @$ShowError = false;
    @$EmailError = false;
    @$UsernameError = false;

    include 'partials/_db_connect.php';

    $b_name = $_POST["b_name"];
    $b_phoneno = $_POST["b_phoneno"];
    $aadharOrPan = $_POST["aadharOrPan"];
    $aad_pan_input = $_POST["aad_pan_input"];
    $b_gender = $_POST["b_gender"];
    $b_marital_status = $_POST["b_marital_status"];
    $b_age = $_POST["b_age"];
    $b_email = $_POST["b_email"];
    $b_state = $_POST["b_state"];
    $b_city = $_POST["b_city"];
    $b_address = $_POST["b_address"];
    $b_area = $_POST["b_area"];
    $b_landmark = $_POST["b_landmark"];
    $b_pincode = $_POST["b_pincode"];
    $b_username = $_POST["b_username"];
    $b_password = $_POST["b_password"];
    $b_cpassword = $_POST["b_cpassword"];

    // Check if email exists
    $emailQuery = "SELECT * FROM servent_details WHERE b_email='$b_email'";
    $emailResult = mysqli_query($conn, $emailQuery);

    if (mysqli_num_rows($emailResult) > 0) {
        $EmailError = true;
    }

    // Check if username exists
    $usernameQuery = "SELECT * FROM servent_details WHERE b_username='$b_username'";
    $usernameResult = mysqli_query($conn, $usernameQuery);

    if (mysqli_num_rows($usernameResult) > 0) {
        $UsernameError = true;
    }

    if ($b_password != $b_cpassword) {
        @$ShowError = true;
    }

    if ($b_password == $b_cpassword && !$EmailError && !$UsernameError && !$ShowError) {
        $hash = password_hash($b_password, PASSWORD_DEFAULT);

        $insertQuery = "INSERT INTO `servent_details` (`b_name`, `b_phoneno`, `aadharOrPan`, `aad_pan_input`, `b_gender`, 
        `b_marital_status`, `b_age`, `b_email`, `b_state`, `b_city`, `b_address`, `b_area`, `b_landmark`, `b_pincode`, `b_username`, 
        `b_password`, `dt`) VALUES ('$b_name', '$b_phoneno', '$aadharOrPan', '$aad_pan_input', '$b_gender', '$b_marital_status', 
        '$b_age', '$b_email', '$b_state', '$b_city', '$b_address', '$b_area', '$b_landmark', '$b_pincode', '$b_username', '$hash', 
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

<!-- Rest of the HTML and JavaScript code remains the same -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bai Signup</title>
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
    <script>
        function showAadharOrPanInput() {
            var selectedOption = document.getElementById("aadharOrPan").value;
            var aadharInput = document.getElementById("aadharInput");
            var panInput = document.getElementById("panInput");

            if (selectedOption === "aadhar") {
                aadharInput.style.display = "block";
                panInput.style.display = "none";
            } else if (selectedOption === "pan") {
                panInput.style.display = "block";
                aadharInput.style.display = "none";
            } else {
                aadharInput.style.display = "none";
                panInput.style.display = "none";
            }
        }

        function validateAadharLength() {
            var aadharNumber = document.getElementById("aadharNumber").value;
            if (aadharNumber.length > 12) {
                document.getElementById("aadharNumber").value = aadharNumber.slice(0, 12);
            }
        }

        function validatePanLength() {
            var panNumber = document.getElementById("panNumber").value;
            if (panNumber.length > 10) {
                document.getElementById("panNumber").value = panNumber.slice(0, 10);
            }
        }
        
    </script>
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

        <h1 class="text-center mb-4">Hello Bai<br>Signup to our Website!</h1>

        <form method="post">
            
            <!-- Name -->
            <div class="mb-3">
                <label for="bname" class="form-label">Name</label>
                <input type="text" class="form-control" id="b_name" name="b_name" placeholder="Enter your Full Name" aria-describedby="emailHelp" required>
            </div>

            <!-- Mobile Number -->
            <div class="mb-3">
                <label for="bnumber" class="form-label">Contact No.</label>
                <input type="number" class="form-control" id="b_phoneno" name="b_phoneno" placeholder="Enter your 10 digit Mobile Number" aria-describedby="emailHelp" required>
            </div>

            <!-- Aadhar Card or PAN Card option -->
            <div class="mb-3">
                <label for="aadharOrPan" class="form-label">Aadhar Card or PAN Card</label>
                <select class="form-select" id="aadharOrPan" name="aadharOrPan" onchange="showAadharOrPanInput()" required>
                    <option value="" selected disabled>Select an option</option>
                    <option value="aadhar">Aadhar Card</option>
                    <option value="pan">PAN Card</option>
                </select>
            </div>

            <!-- Aadhar Card Input -->
            <div class="mb-3" id="aadharInput" style="display: none;">
                <label for="aadharNumber" class="form-label">Aadhar Card Number</label>
                <input type="text" class="form-control" id="aad_pan_input" name="aad_pan_input" placeholder="Enter Aadhar Card Number" oninput="validateAadharLength()" maxlength="12">
            </div>

            <!-- PAN Card Input -->
            <div class="mb-3" id="panInput" style="display: none;">
                <label for="panNumber" class="form-label">PAN Card Number</label>
                <input type="text" class="form-control" id="aad_pan_input" name="aad_pan_input" placeholder="Enter PAN Card Number" oninput="validatePanLength()" maxlength="10">
            </div>

            <!-- Gender -->
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select" id="b_gender" name="b_gender" required>
                    <option value="" selected disabled>Select your gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <!-- marital status  -->
            <div class="mb-3">
                <label for="marital status " class="form-label">Marital Status </label>
                <select class="form-select" id="b_marital_status" name="b_marital_status" required>
                    <option value="" selected disabled>Select your Marital Status </option>
                    <option value="single">Single</option>
                    <option value="married">Married</option>
                    <option value="engaged">Engaged</option>
                    <option value="widowed">Widowed</option>
                    <option value="divorsed">Divorsed</option>
                </select>
            </div>

            <!-- Age -->
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="b_age" name="b_age" placeholder="Enter your age" required>
            </div>

            <!-- Email ID -->
            <div class="mb-3">
                <label for="bemail" class="form-label">Email ID (Optional)</label>
                <input type="email" class="form-control" id="b_email" name="b_email" placeholder="Enter your existing Email-ID" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <!-- State -->
            <div class="mb-3">
                <label for="state" class="form-label">State</label>
                <select class="form-select" id="b_state" name="b_state" required>
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
                <input type="text" class="form-control" id="b_city" name="b_city" placeholder="Enter your city" aria-describedby="emailHelp" required>
            </div>

            <!-- Address -->
            <div class="mb-3">
                <label for="baddress" class="form-label">Address</label>
                <input type="text" class="form-control" id="b_address" name="b_address" placeholder="Enter your Full Address" aria-describedby="emailHelp" required>
            </div>

            <!-- Area -->
            <div class="mb-3">
                <label for="barea" class="form-label">Area</label>
                <input type="text" class="form-control" id="b_area" name="b_area" placeholder="Enter you Area" aria-describedby="emailHelp" required>
            </div>

            <!-- landmark -->
            <div class="mb-3">
                <label for="blandmark" class="form-label">Landmark (Optional)</label>
                <input type="text" class="form-control" id="b_landmark" name="b_landmark" placeholder="Enter any landmark" aria-describedby="emailHelp" >
            </div>

            <!-- pincode -->
            <div class="mb-3">
                <label for="bpincode" class="form-label">Pincode</label>
                <input type="number" class="form-control" id="b_pincode" name="b_pincode" placeholder="Enter your 7 digit pincode" aria-describedby="emailHelp" required>
            </div>

            <!-- Username -->
            <div class="mb-3">
                <label for="busername" class="form-label">Username</label>
                <input type="text" class="form-control" id="b_username" name="b_username" placeholder="Enter an unique username" aria-describedby="emailHelp" required>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="bpassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="b_password" name="b_password" placeholder="Enter an secure password" required>
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label for="cbpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="b_cpassword" name="b_cpassword" placeholder="Enter an secure password" required>
                <div id="emailHelp" class="form-text">Make sure to type the same password</div>
            </div>

            <div class="mb-3 form-check">

            <input type="checkbox" class="form-check-input" id="exampleCheck1">

            <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
                <button type="reset" class="btn btn-primary mx-2">Reset</button>    
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                <button type="submit" class="btn btn-primary mx-2">Signup</button>

        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>