<?php
require("connect-db.php");
require("request-db.php");

if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    $details = getPropertyById($pid);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $pidToDelete = $_POST['pid'];
    deletePropertyById($pidToDelete);
}
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Detail</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var type = localStorage.getItem("type");
        if (type === "Admin") {
            document.getElementById("delete").style.display = 'block';
        } else {
            document.getElementById("delete").style.display = 'none';
        }
    });
</script>

<body>
    <?php foreach ($details as $property) : ?>
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

        <form method="POST" action="">
            <input type="hidden" name="pid" value="<?php echo $property['pid']; ?>">
            <button type="submit" name="delete" id="delete" style="display: none;">Delete</button>

        </form>
    <?php endforeach; ?>
</body>