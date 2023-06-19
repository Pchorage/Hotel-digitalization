<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "responsive1";
$table = "veg";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT id, name, price, quantity FROM $table";
$result = $conn->query($sql);

// Create an array to store the fetched data
$data = array();

// Process the fetched data
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Close the database connection
$conn->close();

// Set the response header to JSON
header('Content-Type: application/json');

// Return the data as JSON
echo json_encode($data);
?>

