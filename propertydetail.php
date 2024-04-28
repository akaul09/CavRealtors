<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Detail</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var type = localStorage.getItem("type");
        if (type === "Admin") {
            document.getElementById("delete").style.display = 'block';
            document.getElementById("update2").style.display = 'block';
        } else {
            document.getElementById("delete").style.display = 'none';
            document.getElementById("update2").style.display = 'none';
        }
    });
</script>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">
            <img src="assets/logo.png" alt="CavRealtors Logo" style="height: 40px; margin-right: 10px;">CavRealtors
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <a class="btn btn-bordered" href="viewProperty.php">Browse Listings</a>
            <a class="btn btn-bordered" href="addProperty.php">Add Property</a>
            <form method="post" action="profile.php">
                <button type="submit" class="logout-button">Logout</button>
            </form>
        </div>
    </nav>
    <?php require("connect-db.php"); ?>
    <?php require("request-db.php"); ?>

    <?php
    if (isset($_GET['pid'])) {
        $pid = $_GET['pid'];
        $details = getPropertyById($pid);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
        echo "pid: " . intval($details[0]['pid']) . "\n";
        echo "title: " . $details[0]['title'] . "\n";
        echo "address: " . $details[0]['name'] . "\n";
        UpdatePropertyById(intval($details[0]['pid']), $details[0]['housestyle'], $_POST['status'],  $details[0]['title'], floatval($_POST['bath']), intval($_POST['bed']), intval($_POST['sqft']), $details[0]['name'], $details[0]['locality'],  $details[0]['state'], intval($_POST['price']));
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
        $pidToDelete = $_POST['pid'];
        deletePropertyById($pidToDelete);
    }
    ?>

    <?php foreach ($details as $property) : ?>
        <div class="card-body">
            <h3 class="card-title"><?php echo htmlspecialchars($property['name']); ?></h3>
            <p class="card-text">
                <strong>Price:</strong> <?php echo htmlspecialchars($property['price']); ?><br>
                <strong>Square Feet:</strong> <?php echo htmlspecialchars($property['sqft']); ?><br>
                <strong>Beds:</strong> <?php echo htmlspecialchars($property['bed']); ?><br>
                <strong>Bathrooms:</strong> <?php echo htmlspecialchars($property['bath']); ?><br>
                <strong>Status:</strong> <?php echo htmlspecialchars($property['status']); ?><br>
            </p>

            <button type="button" name="update2" id="update2" class="btn btn-primary" onclick="openUpdateModal(<?php echo htmlspecialchars(json_encode($property)); ?>)">Update</button>
            <form method="POST" action="">
                <input type="hidden" name="pid" value="<?php echo $property['pid']; ?>">
                <button type="submit" name="delete" id="delete" style="display: none;">Delete</button>

            </form>
        </div>
    <?php endforeach; ?>
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Property</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="">
                    <div class="modal-body">
                        <input type="hidden" id="modalPid" name="pid" value=<?php $details[0]["pid"] ?>>
                        <div class="form-group">
                            <label for="modalPrice">Price:</label>
                            <input type="text" class="form-control" id="modalPrice" name="price" value="<?php echo $details[0]["price"]; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="modalSqft">Square Feet:</label>
                            <input type="text" class="form-control" id="modalSqft" name="sqft" value="<?php echo $details[0]["sqft"]; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="modalBeds">Beds:</label>
                            <input type="number" class="form-control" id="modalBeds" name="bed" value="<?php echo $details[0]["bed"]; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="modalBaths">Bathrooms:</label>
                            <input type="float" class="form-control" id="modalBaths" name="bath" value="<?php echo $details[0]["bath"]; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="status" class="form-label">Status: </label>
                            <select class="form-select" id="status" name="status" required>
                                <option disabled>Choose...</option>
                                <option value="for_sale" <?php echo ($details[0]["status"] == 'for_sale') ? 'selected' : ''; ?>>For Sale</option>
                                <option value="sold" <?php echo ($details[0]["status"] == 'sold') ? 'selected' : ''; ?>>Sold</option>
                                <option value="pending" <?php echo ($details[0]["status"] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                                <option value="Coming Soon" <?php echo ($details[0]["status"] == 'Coming Soon') ? 'selected' : ''; ?>>Coming Soon</option>
                                <option value="Contigent" <?php echo ($details[0]["status"] == 'Contigent') ? 'selected' : ''; ?>>Contigent</option>
                                <option value="Foreclosure" <?php echo ($details[0]["status"] == 'Foreclosure') ? 'selected' : ''; ?>>Foreclosure</option>
                                <option value="sale" <?php echo ($details[0]["status"] == 'sale') ? 'selected' : ''; ?>>Sale</option>
                            </select>
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
        function openUpdateModal(property) {
            // $('#modalPid').val(property.pid);
            // $('#modalPrice').val(property.price);
            // $('#modalSqft').val(property.sqft);
            // $('#modalBeds').val(property.bed);
            // $('#modalBaths').val(property.bath);
            $('#updateModal').modal('show');
        }
    </script>
</body>

</html>