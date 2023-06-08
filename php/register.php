<?php
// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reciperadar";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the registration form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if the username already exists
    $checkQuery = "SELECT id FROM users WHERE username = '$username'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        echo "Username already exists. Please choose a different username.";
    } else {
        // Insert the new user into the database
        $insertQuery = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

        if ($conn->query($insertQuery) === TRUE) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
