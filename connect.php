<?php
// Assuming you have a MySQL database connection established
// Replace DB_HOST, DB_USER, DB_PASSWORD, and DB_NAME with your actual database credentials

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'responsive1';

// Function to save items to the database
function saveItemsToDatabase($items, $host, $user, $password, $dbname)
{
  // Establish a connection to the database
  $conn = new mysqli($host, $user, $password, $dbname);
  
  // Check if the connection was successful
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  // Prepare the SQL statement to insert the items
  $stmt = $conn->prepare('INSERT INTO veg (name, price, quantity) VALUES (?, ?, ?)');

  // Bind the parameters to the prepared statement
  $stmt->bind_param('sii', $name, $price, $quantity);

  // Loop through each item and insert it into the database
  foreach ($items as $item) {
    $name = $item['name'];
    $price = $item['price'];
    $quantity = $item['quantity'];

    // Execute the prepared statement
    $stmt->execute();
  }

  // Close the statement and database connection
  $stmt->close();
  $conn->close();
}

// Get the JSON data from the POST request
$jsonData = file_get_contents('php://input');

// Decode the JSON data
$data = json_decode($jsonData, true);

// Check if the 'items' key exists in the decoded data
if (isset($data['items'])) {
  $items = $data['items'];

  // Call the function to save the items to the database
  saveItemsToDatabase($items, $host, $user, $password, $dbname);
}

// Send a response back to the client
$response = ['message' => 'Items saved successfully.'];
echo json_encode($response);
?>
