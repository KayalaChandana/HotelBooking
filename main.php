<?php
$servername = "localhost";
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $message = $_POST['message'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO contacts (name, message) VALUES (?,?)");
    $stmt->bind_param("ss", $name, $message);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
