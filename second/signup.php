<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            text-align: center;
            margin-top: 50px; /* Add margin to separate from the navbar */
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .user-or-bai {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }


        
    </style>
</head>
<body>
    <?php require 'partials/_nav.php' ?>
    <br> <br> 
    <h2> <center> Welcome to the Signup Page </center> </h2>
<br> 
    <div class="container">
        <h1>Who Are You?</h1>
        <div class="user-or-bai">
            <label>
                <input type="radio" id="user" name="user-or-bai" value="user">
                User
            </label>
            <label>
                <input type="radio" id="bai" name="user-or-bai" value="bai">
                BAI
            </label>
        </div>
        <button type="button" id="next">Next</button>
    </div>

    <script>
        const userOrBai = document.querySelector(".user-or-bai");
        const nextButton = document.querySelector("#next");

        nextButton.addEventListener("click", () => {
            const userOrBaiValue = userOrBai.querySelector("input:checked").value;

            if (userOrBaiValue === "user") {
                window.location.href = "user_signup.php";
            } else if (userOrBaiValue === "bai") {
                window.location.href = "bai_signup.php";
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>

