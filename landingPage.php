<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CavRealtors - Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
      body, html {
        height: 100%; 
        margin: 0; 
      }
      .page-content {
        padding-bottom: 70px; 
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
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light w-100">
    <a class="navbar-brand" href="index.php">CavRealtors</a>
    <a href="signup.php" class="btn btn-outline-primary my-2 my-lg-0" role="button">Sign In</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">
            <a class="nav-item nav-link active" href="viewProperty.php">Search <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="viewProperty.php">Browse Listings</a>
        </div>
    </div>
</nav>

<div class="container-fluid page-content">
    <div class="row my-4">
        <div class="col-12 col-md-6 order-md-2">
            <div class="search-container">
                <h2>Easy Navigation</h2>
                <p>Locate your perfect property.</p>
                <a href="viewProperty.php" class="btn btn-primary">Search Now</a>
            </div>
        </div>
    </div>

    <div class="row text-center my-4">
        <div class="col-12 col-md-4">
            <i class="feature-icon"></i> 
            <h3>Detailed Listings</h3>
            <p>Every home detail, from price to amenities, at a glance.</p>
        </div>
        <div class="col-12 col-md-4">
            <i class="feature-icon"></i>
            <h3>Custom Searches</h3>
            <p>Filter by location, price, or property type effortlessly.</p>
        </div>
        <div class="col-12 col-md-4">
            <i class="feature-icon"></i>
            <h3>Easy to use</h3>
            <p>Simple features make property viewing accessible to everyone.</p>
        </div>
    </div>

    <div class="commitment-section my-4 text-center">
        <h2>Our Commitment</h2>
        <p>Dedicated to simplifying your home-buying experience with the most up-to-date and verified data.</p>
    </div>
</div>

<footer class="footer py-3">
    <div class="container text-center">
        <span class="text-muted">© 2024 CavRealtors - All Rights Reserved.</span>
        <div class="float-right">
            <a href="#" class="text-muted">Privacy Policy</a> |
            <a href="#" class="text-muted">Terms of Use</a>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
