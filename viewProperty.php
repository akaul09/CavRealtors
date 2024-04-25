<?php
require("connect-db.php");
require("request-db.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $properties = getAllProperties();
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
        body { padding-top: 20px; }
        .card { margin-bottom: 20px; }
    </style>
</head>
<body>
<div class="container">
    <div class="text-center">
        <h1>CavRealtors</h1>
        <h2>Real Estate Listings</h2>
    </div>
    
    <div class="row mb-3">
        <div class="col-md-8">
            <input class="form-control" type="search" placeholder="Search properties">
        </div>
    </div>
    
    <?php foreach ($properties as $property): ?>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="card-title"><?php echo htmlspecialchars($property['name']); ?></h3>
                    <p class="card-text">
                        <strong>Price:</strong> <?php echo htmlspecialchars($property['price']); ?> <br>
                        <strong>Squarefeet:</strong> <?php echo htmlspecialchars($property['sqft']); ?> <br>
                        <strong>Beds:</strong> <?php echo htmlspecialchars($property['bed']); ?> <br>
                        <strong>Bathrooms:</strong> <?php echo htmlspecialchars($property['bath']); ?> <br>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
 
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
