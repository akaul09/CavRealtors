<?php
require("connect-db.php");
require("request-db.php");
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    logout();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="landingPage.php">
        <img src="assets/logo.png" alt="CavRealtors Logo" style="height: 40px; margin-right: 10px;">CavRealtors
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent"
            aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarContent">
        <div class="navbar-nav ml-auto">
            <a class="btn btn-bordered" href="viewProperty.php">Browse Listings</a>
        </div>
    </div>
</nav>

<body>
    <b>Username: </b><p id="username"></p>
    <b>Type: </b><p id="type"></p>
    <form method="post" action="profile.php"><button type="submit">Logout</button></form>
    <script>
    username = localStorage.getItem("username");
    type = localStorage.getItem("type")
    document.getElementById('username').textContent = username;
    document.getElementById('type').textContent = type;
</script>
</body>
