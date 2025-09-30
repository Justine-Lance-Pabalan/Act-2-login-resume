<?php
session_start();

// PostgreSQL connection
$host = "localhost";
$port = "5432";            
$dbname = "logindemo";    
$user = "postgres";        
$pass = "postgres";    

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass");

if (!$conn) {
    die("Error: Unable to connect to the database.");
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Validation: check empty fields
    if (empty($username) || empty($password)) {
        $message = "<p class='error'>All fields are required!</p>";
    } else {
        // Check user credentials from database
        $result = pg_query_params(
            $conn,
            "SELECT * FROM users WHERE username = $1 AND password = $2",
            array($username, $password)
        );

        if ($result && pg_num_rows($result) > 0) {
            $_SESSION["username"] = $username;
            // Show success message first
            $message = "<p class='success'>Login Successful! Redirecting...</p>";
            // Redirect after 2 seconds
            header("refresh:2; url=resume.php");
        } else {
            $message = "<p class='error'>Invalid Username or Password</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="login-container">
    <h2>Login</h2>
    <?php echo $message; ?>
    <form method="POST" action="">
        <label>Username:</label>
        <input type="text" name="username" placeholder="Enter username">

        <label>Password:</label>
        <input type="password" name="password" placeholder="Enter password">

        <button type="submit" class="login-btn">Login</button>
    </form>
</div>
</body>
</html>


