<?php
require("connect-db.php");
require("request-db.php");
?>
<?php


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $properties = getAllProperties();
}

?>

<!DOCTYPE html>
<html>
<head>
<title>View all Properties</title>
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
        <div class="col-md-4">
            <button class="btn btn-primary float-right">Map View</button>
        </div>
    </div>
    
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md">
                <?php foreach($properties as $property):?>
                    <h3 class="card-title"><?php echo ($property['name']); ?></h3>
                    <p class="card-text">
                        <strong>Location:</strong> <?php echo ($property['price']); ?> <br>
                    </p>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
 
</div>
<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>