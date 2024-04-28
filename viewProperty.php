<?php
require("connect-db.php");
require("request-db.php");

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$propertiesPerPage = 10;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $properties = getAllProperties($page, $propertiesPerPage);
}
if($_SERVER['REQUEST_METHOD']=='POST'){
    exportJson();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Estate Listings</title>
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
            min-height: 400px; 
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
<body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var type = localStorage.getItem("type");
        var navbarAdmin = document.getElementById("navbarAdmin");
        var navbarUser = document.getElementById("navbarUser");

        if (type === "Admin") {
            navbarAdmin.style.display = "block";
            navbarUser.style.display = "none";
        } else {
            navbarAdmin.style.display = "none";
            navbarUser.style.display = "block";
        }
    });
</script>
<!-- Admin Navigation Bar -->
<nav id="navbarAdmin" class="navbar navbar-expand-lg navbar-light bg-light" style="display: none;">
    <div class="container-fluid"> 
        <a class="navbar-brand" href="landingPage.php">
            <img src="assets/logo.png" alt="CavRealtors Logo" style="height: 40px; margin-right: 10px;">CavRealtors
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <div class="navbar-nav">
                <a class="btn btn-bordered" href="viewProperty.php">Browse Listings</a>
                <a class="btn btn-bordered" href="addProperty.php">Add Property</a>
                <form method="post" action="profile.php">
                    <button type="submit" class="logout-button">Logout</button>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- User Navigation Bar -->
<nav id="navbarUser" class="navbar navbar-expand-lg navbar-light bg-light" style="display: none;">
    <div class="container-fluid"> 
        <a class="navbar-brand" href="landingPage.php">
            <img src="assets/logo.png" alt="CavRealtors Logo" style="height: 40px; margin-right: 10px;">CavRealtors
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <div class="navbar-nav">
                <a class="btn btn-bordered" href="viewProperty.php">Browse Listings</a>
                <form method="post" action="profile.php">
                    <button type="submit" class="logout-button">Logout</button>
                </form>
            </div>
        </div>
    </div>
</nav>

<div class="container">    
    <div class="row mb-3">
        <div class="col-md-8">
            <input class="form-control" type="search" placeholder="Search properties">
        </div>
    </div>
    <form class="exportProp" method="post" action="viewProperty.php">
        <button type="submit">Export Data as JSON</button>
    </form>
    <?php foreach ($properties as $property): ?>
    <div class="card">
        <a href="propertydetail.php?pid=<?php echo urlencode($property['pid']); ?>" style="text-decoration: none; color: inherit;">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title"><?php echo htmlspecialchars($property['name']); ?></h3>
                        <p class="card-text">
                            <strong>Price:</strong> <?php echo htmlspecialchars($property['price']); ?><br>
                        </p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <?php endforeach; ?>

    <nav>
    <ul class="pagination">
        <?php
        $countQuery = $db->query("SELECT COUNT(*) FROM Property");
        $totalProperties = $countQuery->fetchColumn();
        $totalPages = ceil($totalProperties / $propertiesPerPage);
        $range = 2; 

        if ($page > 1) {
            echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">Previous</a></li>';
        }

        for ($i = 1; $i <= min(2, $totalPages); $i++) {
            echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '">';
            echo '<a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
        }

        if ($page > $range + 3) {
            echo '<li class="page-item"><span class="page-link">...</span></li>';
        }

        for ($i = max($page - $range, 3); $i <= min($page + $range, $totalPages - 2); $i++) {
            echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '">';
            echo '<a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
        }

        if ($page < $totalPages - ($range + 2)) {
            echo '<li class="page-item"><span class="page-link">...</span></li>';
        }

        for ($i = max($totalPages - 1, $page + $range + 1); $i <= $totalPages; $i++) {
            echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '">';
            echo '<a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
        }

        if ($page < $totalPages) {
            echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">Next</a></li>';
        }
        ?>
    </ul>
</nav>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>