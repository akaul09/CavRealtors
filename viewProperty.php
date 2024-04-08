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
    <?php foreach($properties as $p):?>
    <?php echo "$p[name]";?>
    <?php endforeach; ?>
</body>
</html>