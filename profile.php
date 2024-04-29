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
        body,
        html {
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
            min-height: 400px;
            /* Adjust this value based on your needs */
        }
        .logout-button {
        background-color: #dc3545; 
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        transition: background-color 0.3s ease;
        }
        .logout-button:hover {
        background-color: #c82333; 
        }
    </style>
</head>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="landingPage.php">
        <img src="assets/logo.png" alt="CavRealtors Logo" style="height: 40px; margin-right: 10px;">CavRealtors
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarContent">
        <div class="navbar-nav ml-auto">
            <a class="btn btn-bordered" href="viewProperty.php">Browse Listings</a>
        </div>
    </div>
</nav>

<body>
    <button type="button" name="update" id="update" class="btn btn-primary" onclick="openUpdateModal()">Update</button>
        <br>
        <br>
    <b>Username: </b>
    <p id="username"></p>
    <b>Type: </b>
    <p id="type"></p>
    <b>First Name: </b>
    <p id="fname"></p>
    <b>Last Name: </b>
    <p id="lname"></p>
    <form method="post" action="profile.php"><button type="submit">Logout</button></form>

    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="modalfname">First Name:</label>
                            <input type="text" class="form-control" id="modalfname" name="fname" required>
                        </div>
                        <div class="form-group">
                            <label for="modallname">Last Name:</label>
                            <input type="text" class="form-control" id="modallname" name="lname" required>
                        </div>
                        <div class="form-group">
                            <label for="modalusername">Username:</label>
                            <input type="text" class="form-control" id="modalusername" name="username" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="update" id="update" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        username = localStorage.getItem("username");
        type = localStorage.getItem("type")
        fname = localStorage.getItem("fname")
        lname = localStorage.getItem("lname")

        function openUpdateModal() {
            $('#modalfname').val(fname);
            $('#modallname').val(lname);
            $('#modalusername').val(username);
            $('#updateModal').modal('show');

        }
        document.getElementById('username').textContent = username;
        document.getElementById('type').textContent = type;
        document.getElementById('fname').textContent = fname;
        document.getElementById('lname').textContent = lname;
    </script>
</body>