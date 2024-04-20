<?php
require("connect-db.php");
require("request-db.php");
?>


<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['price'])) {
        addProperty($_POST["housestyle"], $_POST["price"]);
        $_POST["address"], $_POST["brokername"], $_POST["bathrooms"], $_POST["bedrooms"], $_POST["squarefeet"], $_POST["state"], $_POST["county"], $_POST["status"]);
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Add Property</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 20px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: bold;
        }

        .required::after {
            content: '*';
            color: red;
        }

        .form-control {
            margin-bottom: 10px;
        }

        .btn-primary {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }

        @media (max-width: 768px) {
            .form-control {
                margin-bottom: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Add Property</h2>
        <form class="addProp" method="post" action="addProperty.php">
            <div class="mb-3">
                <label for="housestyle" class="form-label required">House Style</label>
                <input type="text" class="form-control" id="housestyle" name="housestyle" required placeholder="e.g., Victorian">
            </div>

            <div class="mb-3">
                <label for="price" class="form-label required">Price</label>
                <input type="number" class="form-control" id="price" name="price" required placeholder="e.g., 350000">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label required">Address</label>
                <input type="text" class="form-control" id="address" name="address" required placeholder="123 Main St">
            </div>

            <div class="mb-3">
                <label for="state" class="form-label required">State</label>
                <input type="text" class="form-control" id="state" name="state" required placeholder="e.g., California">
            </div>

            <div class="mb-3">
                <label for="city" class="form-label required">City</label>
                <input type="text" class="form-control" id="city" name="city" required placeholder="e.g., San Francisco">
            </div>

            <div class="mb-3">
                <label for="county" class="form-label">County</label>
                <input type="text" class="form-control" id="county" name="county" placeholder="e.g., Orange County">
            </div>

            <div class="mb-3">
                <label for="status" class="form-label required">Status of Property</label>
                <select class="form-select" id="status" name="status" required>
                    <option selected disabled value="">Choose...</option>
                    <option value="for_sale">For Sale</option>
                    <option value="sold">Sold</option>
                    <option value="pending">Pending</option>
                    <option value="not_available">Not Available</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="bedrooms" class="form-label required">No. of Bedrooms</label>
                <input type="number" class="form-control" id="bedrooms" name="bedrooms" required placeholder="e.g., 3">
            </div>

            <div class="mb-3">
                <label for="bathrooms" class="form-label required">No. of Bathrooms</label>
                <input type="number" class="form-control" id="bathrooms" name="bathrooms" required placeholder="e.g., 2">
            </div>

            <div class="mb-3">
                <label for="squareFeet" class="form-label required">Square Feet</label>
                <input type="number" class="form-control" id="squareFeet" name="squareFeet" required placeholder="e.g., 1500">
            </div>

            <button class="btn btn-primary" type="submit">Submit Form</button>
        </form>
    </div>

    <script src="https://cdn
