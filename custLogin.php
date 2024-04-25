<?php
require("connect-db.php");
require("request-db.php");
?>


<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['username']) && $_POST["password"]) {
        custLogin($_POST["username"], $_POST["password"]);
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
    <title>Customer Login</title>
</head>
</body>
<div class="form">
    <form method="post" action="custLogin.php">
        <h1>Customer login</h1>
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

        <button type="submit" class="btn btn-primary" style="background-color: #00848a">
            Sign In
        </button>
    </form>
</div>
</body>