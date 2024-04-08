<?php
require("connect-db.php");    // include("connect-db.php");
require("request-db.php");
?>


<?php   // form handling

// var_dump($list_of_requests);   // debug

if ($_SERVER['REQUEST_METHOD'] == 'POST')   // GET
{
    if (!empty($_POST['AddProperty']))    // $_GET['....']
    {
        addProperty($_POST["Name"],);
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

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
            <form>

            </form>
        </div>


        <br /><br />


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>