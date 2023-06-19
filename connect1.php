<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "responsive1";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the JSON data from the request body
$data = json_decode(file_get_contents('php://input'), true);

// Check if the data is valid
if (!isset($data['items']) || !is_array($data['items'])) {
    echo "Invalid data";
    exit;
}

// Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO nonveg (name, price, quantity) VALUES (?, ?, ?)");

// Bind parameters and execute the statement for each item
foreach ($data['items'] as $item) {
    $stmt->bind_param("sii", $item['name'], $item['price'], $item['quantity']);
    $stmt->execute();
}

$stmt->close();
$conn->close();

echo "Items saved to the database.";
?>
