<?php
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "test"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$checkin = $_POST['checkin'];
$checkout = $_POST['checkout'];

// Validate data (you can add more validation as needed)
if (empty($name) || empty($email) || empty($phone) || empty($checkin) || empty($checkout)) {
    die("Please fill all the fields.");
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO bookings (name, email, phone, checkin, checkout) VALUES (?, ?, ?, ?, ?)");
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("sssss", $name, $email, $phone, $checkin, $checkout);

// Execute the query
if ($stmt->execute()) {
    echo "Booking successful!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the connection
$stmt->close();
$conn->close();
?>
