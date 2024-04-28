<?php
require("connect-db.php");
require("request-db.php");
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['housestyle'])) {
        addProperty($_POST["housestyle"], $_POST["price"],$_POST["name"],$_POST["address"], $_POST["brokername"], $_POST["bathrooms"], $_POST["bedrooms"], $_POST["squareFeet"], $_POST["state"], $_POST["county"], $_POST["status"]);
    }

}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/[email protected]/dist/css/bootstrap.min.css" integrity="sha256-" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/[email protected]/dist/js/bootstrap.bundle.min.js" integrity="sha256-gOQJIa9+K/" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row g-3 mt-2">
            <div class="col">
                <h2>Add Property</h2>
            </div>
        </div>
        <hr />
        <div class="container">

            <form class="addProp" method="post" action="addProperty.php">
                <div class="mb-3">

            <div class="mb-3">
                    <label for="houseStyle" class="form-label">House Style</label>
                    <input type="text" class="form-control" id="housestyle" name="housestyle" required>
                    <div class="invalid-feedback">
                        Please provide the style of the house.
                    </div>
                </div>
                <br><br>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price" required>
                    <div class="invalid-feedback">
                        Please provide the Price of the house.
                    </div>
                </div>
                <br><br>
                
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                    <div class="invalid-feedback">
                        Please provide the address.
                    </div>
                </div>
                <br><br>
                <div class="mb-3">
                    <label for="brokerName" class="form-label">Broker Name</label>
                    <input type="text" class="form-control" id="brokerName" name="brokerName" required>
                    <div class="invalid-feedback">
                        Please provide the name of the broker.
                    </div>
                </div>
                <br><br>
                <div class="mb-3">
                    <label for="bathrooms" class="form-label">No. of Bathrooms</label>
                    <input type="number" class="form-control" id="bathrooms" name="bathrooms" required>
                    <div class="invalid-feedback">
                        Please provide the number of bathrooms.
                    </div>
                </div>
                <br><br>
                <div class="mb-3">
                    <label for="bedrooms" class="form-label">No. of Bedrooms</label>
                    <input type="number" class="form-control" id="bedrooms" name="bedrooms" required>
                    <div class="invalid-feedback">
                        Please provide the number of bedrooms.
                    </div>
                </div>
                <br><br>
                <div class="mb-3">
                    <label for="squareFeet" class="form-label">Sq ft.</label>
                    <input type="number" class="form-control" id="squareFeet" name="squareFeet" required>
                    <div class="invalid-feedback">
                        Please provide the square footage.
                    </div>
                </div>
                <br><br>
                <div class="mb-3">
                    <label for="state" class="form-label">State</label>
                    <input type="text" class="form-control" id="state" name="state" required>
                    <div class="invalid-feedback">
                        Location Information (State)
                    </div>
                </div>
                <br><br>
                <div class="mb-3">
                    <label for="county" class="form-label">County</label>
                    <input type="text" class="form-control" id="county" id="county" required>
                    <div class="invalid-feedback">
                        Please provide the county.
                    </div>
                </div>
                <br><br>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option selected disabled value="">Choose...</option>
                        <option value="for_sale">For Sale</option>
                        <option value="sold">Sold</option>
                        <option value="pending">Pending</option>
                        <option value="not_available">Not Available</option>
                    </select>
                    <div class="invalid-feedback">
                        Please select the status of the house.
                    </div>
                </div>
                <br><br>
                <br><br>
                <button class="btn btn-primary" type="submit">Submit form</button>
            </form>
        </div>
        <br /><br />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>