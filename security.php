<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and clean input data
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Normally here you would retrieve the hashed password from your database and use password_verify() to compare.
    echo "<p>Username: " . htmlspecialchars($username) . "</p>";
    echo "<p>Hashed Password: " . htmlspecialchars($hashed_password) . "</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
</head>
<body>
    <h2>Login Form</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
</body>
</html>
