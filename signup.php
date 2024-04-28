<?php
require("connect-db.php");
require("request-db.php");
?>


<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['username']) && $_POST["password"] === $_POST["confirmpassword"] && $_POST["adminpassword"]==="partylife") {
        signupAdmin($_POST["fname"],$_POST["lname"],$_POST["username"], $_POST["password"]);
    }
    else if (!empty($_POST['username']) && $_POST["password"] === $_POST["confirmpassword"]) {
        signupNormal($_POST["fname"],$_POST["lname"],$_POST["username"], $_POST["password"]);
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/[email protected]/dist/css/bootstrap.min.css" integrity="sha256-" crossorigin="anonymous">

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/[email protected]/dist/js/bootstrap.bundle.min.js" integrity="sha256-gOQJIa9+K/" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="landing.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #f5f5f5;
        }
        .footer a {
            margin: 0 10px;
        }
        .full-height-image {
            background-image: url('assets/homeImage.jpg');
            background-size: cover;
            background-position: center;
            min-height: 400px; /* Adjust this value based on your needs */
        }
    </style>
</head>
</body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="landingPage.php">
        <img src="assets/logo.png" alt="CavRealtors Logo" style="height: 40px; margin-right: 10px;">CavRealtors
    </a>
        <a href="signup.php" class="btn btn-bordered" role="button">Sign Up</a>
        <a class="btn btn-bordered" href="adminLogin.php">Admin Login</a>
        <a class="btn btn-bordered" href="custLogin.php">Customer Login</a>
    </div>
</nav>
<div class="form">
    <form method="post" action="signup.php">
    <div class="form-group">
            <!-- <label for="exampleInputName1" class="text">Name</label> -->
            <input type="name" class="form-control" id="exampleInputName1" placeholder="Enter first name" name="fname">
        </div>
        <br><div class="form-group">
            <!-- <label for="exampleInputName1" class="text">Name</label> -->
            <input type="name" class="form-control" id="exampleInputName1" placeholder="Enter last name" name="lname">
        </div>
        <br>
        <div class="form-group">
            <!-- <label for="exampleInputName1" class="text">Name</label> -->
            <input type="name" class="form-control" id="exampleInputName1" placeholder="Enter username" name="username">
        </div>
        <br>
        <div class="form-group">
            <!-- <label for="exampleInputEmail1" class="text">Email address</label> -->
            <input type="password" class="form-control" id="exampleInputEmail1" placeholder="Enter Password" name="password">
        </div>
        <br>
        <div class="form-group">
            <!-- <label for="exampleInputEmail1" class="text">Email address</label> -->
            <input type="password" class="form-control" id="exampleInputEmail1" placeholder="Confirm Password" name="confirmpassword">
        </div>
        <br>
        <div class="form-group">
            <!-- <label for="exampleInputEmail1" class="text">Email address</label> -->
            <input type="password" class="form-control" id="exampleInputEmail1" placeholder="Admin Password (Leave blank if signing up as normal user)" name="adminpassword">
        </div>
        <br>
        <button type="submit" class="btn btn-primary" style="background-color: #00848a">
            Sign Up
        </button>
    </form>
</div>
</body>