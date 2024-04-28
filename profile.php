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
        body {
            padding-top: 20px;
        }

        .card {
            margin-bottom: 20px;
        }
    </style>
</head>


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
