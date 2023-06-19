<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create a new connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the data from the form
$name = $_POST['name'];
$mobile = $_POST['mobile'];

// Prepare and execute the SQL query
$sql = "INSERT INTO test1 (name, mobile) VALUES ('$name', '$mobile')";

if ($conn->query($sql) === TRUE) {
    echo "Data saved successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>