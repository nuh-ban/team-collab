<?php
// Database connection
$servername = "localhost";
$username = "root";  // Default username for XAMPP
$password = "";  // Default password for XAMPP
$dbname = "music_website";  // The database we're using

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process registration
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $confirm_pass = $_POST['confirm-password'];

    // Validate passwords match
    if ($pass != $confirm_pass) {
        echo "Passwords do not match.";
    } else {
        // Hash the password before storing it
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

        // SQL query to insert new user into the database
        $sql = "INSERT INTO user_music_accounts (username, email, password) VALUES ('$user', '$email', '$hashed_pass')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully. <a href='login.php'>Login</a>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register.css"> <!-- Linking to register.css -->
</head>
<body>
    <header>
        <h1>Music Emotion Recognition System</h1>
        <p>Analyze the emotional essence of your favorite songs!</p>
    </header>
    <main>
        <div class="register-container">
            <h2>Register</h2>
            <!-- The updated form with action to PHP script -->
            <form class="register-form" action="register.php" method="POST">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Choose a username" required>
                
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
                
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Create a password" required>
                
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password" required>
                
                <button type="submit">Register</button>
                <p class="login-link">Already have an account? <a href="login.php">Login here</a></p>
            </form>
        </div>
    </main>
    <footer>
        <p>© 2024 Music Emotion Recognition System</p>
    </footer>
</body>
</html>
